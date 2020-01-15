<?php

namespace frontend\controllers;

use common\models\Topic;
use common\models\UserExam;
use Yii;
use common\models\Exam;
use common\models\Post;
use common\models\User;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\helpers\FunctionHelper;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\controllers\base\BaseController;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();
        switch ($client->name) {
            case 'facebook' :
                $email = $attributes['id'] . '@facebook.com';

                if ($user = User::findByUsername($email)) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                } else {
                    $password = Yii::$app->security->generateRandomString(6);

                    $user = new User([
                        'password' => $password,
                        'permission' => User::ROLE_USER,
                        'name' => $attributes['name']
                    ]);

                    $user->generateAuthKey();
                    $user->setPassword($password);

                    $user->username = $email;
                    $user->email = $email;

                    $user->auth = User::AUTH_FACEBOOK;
                    $user->avatar = $attributes['id'];
                    $user->save();
                    $user['code'] = '#000' . $user['id'];

                    if ($user->save() && Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
                return $this->redirect(['site/login']);
                break;
            case 'google':
                $email = $attributes['email'];
                if ($user = User::findByUsername($email)) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                } else {
                    $password = Yii::$app->security->generateRandomString(6);

                    $user = new User([
                        'password' => $password,
                        'permission' => User::ROLE_USER,
                        'name' => $attributes['name'],
                    ]);

                    $user->generateAuthKey();
                    $user->setPassword($password);

                    $user->username = $email;
                    $user->email = $email;

                    $user->auth = User::AUTH_GOOGLE;
                    $user->avatar = $attributes['picture'];
                    $user->save();
                    $user['code'] = '#000' . $user['id'];
                    if ($user->save() && Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
                return $this->redirect(['site/login']);
                break;
            default:
                return $this->redirect(['site/login']);
        }
    }

    /**
     * @param null $keyword
     * @return string
     */
    public function actionIndex($keyword = null)
    {

        if ($keyword) {
            $query = Exam::find()
                ->joinWith('topic')
                ->where(['exam.status' => Exam::DUYET])
                ->andWhere(['topic.active'=> Topic::ACTIVE])
                ->andWhere(['topic.display' => 1])
                ->andWhere(['exam.disable' => Exam::BLOCK])
                ->andWhere(['exam.admin_show_hide' => Exam::ADMIN_SHOW])
                ->andWhere(['like', 'exam.title', $keyword]);
            $pagination = new Pagination([
                'defaultPageSize' => 9,
                'totalCount' => $query->count(),
            ]);

            $search = $query->offset($pagination->offset)->limit($pagination->limit)
                ->orderBy('id DESC')
                ->all();
            return $this->render('index',
                [
                    'search' => $search,
                    'pages' => $pagination,
                ]);
        } else {
            return $this->render('index');
        }

    }

    /**
     * @param null $category_slug
     * @param null $content_slug
     * @param null $ct
     *
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionView($category_slug = null, $content_slug = null, $ct = null)
    {
        $category = FunctionHelper::get_category_by_slug($category_slug);

        if (!$category) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $post = FunctionHelper::get_post_by_slug($content_slug);
        $classified = FunctionHelper::get_classified_by_slug($content_slug);

        $page = '';
        $classs = null;
        $posts = null;
        $pagination = null;
        $search = $this->search($ct, $category['id']);

        switch ($category['page']['key']) {
            case 'news-page':
                if (!$post && $content_slug) {
                    throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
                }
                $query = Post::find()
                    ->where(['post.category_id' => $category['id']]);

                $pagination = new Pagination([
                    'defaultPageSize' => 9,
                    'totalCount' => $query->count(),
                ]);

                $page = !$post ? 'news-page' : 'detail-news-page';
                break;

            case 'classified-page':
                if (!$classified && $content_slug) {
                    throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
                }
                $query = Classified::find()
                    ->where(['classified.category_id' => $category['id']]);

                $pagination = new Pagination([
                    'defaultPageSize' => 9,
                    'totalCount' => $query->count(),
                ]);

                $classs = $query->offset($pagination->offset)->limit($pagination->limit)
                    ->orderBy('classified.id DESC')
                    ->orderBy('classified.featured DESC')
                    ->asArray()->all();

                $page = !$classified ? 'classified-page' : 'detail-classified-page';
                break;
            case 'single-page':
                $page = 'single-page';
                break;
            case 'posting-page':
                $page = 'posting-page';
                break;
            case 'project-page':
                break;
            case 'ad-page':
                break;
            case 'contact-page':
                $page = 'contact-page';
                break;
            case 'product-page':
                $page = 'product-page';
                break;
            case 'sidebar':
                $page = 'sidebar';
                break;
            case 'pricing-page':
                $page = 'pricing-page';
                break;
            default;
                return $this->redirect(['site/index']);
                break;
        }

        return $this->render($page, [
            'category' => $category,
            'post' => $post,
            'products' => $search['search'],
            'pages' => $search['pages'],
            'classified' => $classified,
            'classs' => $classs,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact-page', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'signup';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionLogin()
    {
        $this->layout = 'signup';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('signin', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string
     */
    public function actionAccountRecovery()
    {
        $this->layout = 'signup';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->render('send-notification');
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('recovery', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     *
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategory($slug)
    {
        $category = FunctionHelper::get_category_by_slug($slug);
        if ($category) {
            return $this->render('view-category', ['category' => $category]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionClass($slug)
    {
        $class = FunctionHelper::get_class_by_slug($slug);
        if ($class) {
            return $this->render('view-class', ['class' => $class]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSubject($slug)
    {
        $subject = FunctionHelper::get_subject_by_slug($slug);
        if ($subject) {
            return $this->render('view-subject', ['subject' => $subject]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionTopic($slug)
    {
        $topic = FunctionHelper::get_topic_by_slug($slug);
        if ($topic) {
            return $this->render('view-topic', ['topic' => $topic]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPost($slug)
    {
        $post = FunctionHelper::get_post_by_slug($slug);
        if ($post) {
            return $this->render('view-post', ['post' => $post]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }
    }

    /**
     * @return string
     */
    public function actionPosts()
    {
        return $this->render('view-posts');

    }

    /**
     * @param int $id
     * @return User|null
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }
    }
}
