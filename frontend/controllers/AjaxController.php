<?php

namespace frontend\controllers;

use common\models\ExamQuestion;
use common\models\Message;
use common\models\ReportQuestion;
use common\models\UserExam;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use common\models\Exam;
use common\models\Topic;
use common\models\SeoTool;
use common\models\Category;
use common\models\Question;
use common\models\ClassroomDetail;
use frontend\controllers\base\BaseController;
use yii\web\NotFoundHttpException;

class AjaxController extends BaseController
{
    /**
     * @param $action
     *
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'show-subject',
                    'show-topic',
                    'insert-topic',
                    'save-profile',
                    'save-avatar-user',
                    'change-password',
                    'send-admin-topic',
                    'remove-topic-admin',
                    'insert-question',
                    'delete-question',
                    'show-category',
                    'send-admin-exam',
                    'delete-exam-user',
                    'change-display-topic-user',
                    'remove-exam-down',
                    'get-question',
                    'hidden-topic-user',
                    'delete-exam-save'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'show-subject',
                            'show-topic',
                            'insert-topic',
                            'save-profile',
                            'save-avatar-user',
                            'change-password',
                            'send-admin-topic',
                            'remove-topic-admin',
                            'insert-question',
                            'delete-question',
                            'show-category',
                            'send-admin-exam',
                            'delete-exam-user',
                            'change-display-topic-user',
                            'remove-exam-down',
                            'get-question',
                            'hidden-topic-user',
                            'delete-exam-save',
                            'delete-topic-user',
                            'change-message-status',
                            'remove-exam-duyet',
                            'report-question'
                        ],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ]
            ]
        ];
    }

    /**
     * @return bool|string
     */
    public function actionShowSubject()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['id'])) {
            $classroomDetails = ClassroomDetail::find()->where(['classroom_id' => $post['id']])->all();
            $data = '<option value="">Chọn môn thi</option>';

            foreach ($classroomDetails as $classroomDetail) {
                $data .= '<option value="' . $classroomDetail['subject']['id'] . '">' . $classroomDetail['subject']['title'] . '</option>';
            }
            return $data;
        }
        return false;
    }

    /**
     * @return bool|string
     */
    public function actionShowTopic()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['subject_id']) && isset($post['classroom_id'])) {
            $classroomDetail = ClassroomDetail::find()
                ->where(['classroom_id' => $post['classroom_id']])
                ->andWhere(['subject_id' => $post['subject_id']])
                ->one();
            $topics = Topic::find()
                ->where(['classroom_detail_id' => $classroomDetail['id']])
                ->andWhere(['user_id' => $this->user->id])
                ->andWhere(['active' => Topic::ACTIVE])
                ->all();
            $data = '<option value="">Chọn chủ đề</option>';

            foreach ($topics as $topic) {
                $data .= '<option value="' . $topic['id'] . '">' . $topic['title'] . '</option>';
            }
            return $data;
        }
        return false;
    }

    public function actionInsertTopic()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['title']) && isset($post['status']) && isset($post['category_id'])) {

            $seo = new SeoTool();
            $seo->save();

            $classroomDetail = ClassroomDetail::find()
                ->where(['classroom_id' => $post['classroom']])
                ->andWhere(['subject_id' => $post['subject']])->one();
            $topic = new Topic();
            $topic->title = $post['title'];
            $topic->avatar = $post['avatar'];
            $topic->description = $post['description'];
            $topic->user_id = $this->user->id;
            $topic->classroom_detail_id = $classroomDetail->id;
            $topic->seo_tool_id = $seo->id;
            $topic->status = $post['status'];

            $topic->category_id = $post['category_id'];
            if ($topic->save(false)) {
                return $topic;
            }
        }
        return false;
    }

    public function actionSaveProfile()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['name'])) {
            if ($this->user->auth != null) {
                throw new NotFoundHttpException(Yii::t('app', 'Bạn không có quyền chỉnh sửa thông tin này!'));
            } else {
                $this->user->name = $post['name'];
                return $this->user->save();
            }
        }
        if (isset($post['birthday']) && isset($post['phone']) && isset($post['address'])) {
            if ($this->user->auth != null) {
                throw new NotFoundHttpException(Yii::t('app', 'Bạn không có quyền chỉnh sửa thông tin này!'));
            } else {
                $this->user->birthday = $post['birthday'];
                $this->user->phone = $post['phone'];
                $this->user->address = $post['address'];
                return $this->user->save();
            }
        }
        if (isset($post['description'])) {
            $this->user->description = $post['description'];
            return $this->user->save();
        }
        return false;
    }

    public function actionSaveAvatarUser()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['avatar'])) {
            if ($this->user->auth != null) {
                throw new NotFoundHttpException(Yii::t('app', 'Bạn không có quyền chỉnh sửa thông tin này!'));
            } else {
                $this->user->avatar = $post['avatar'];
                $this->user->save();
                return true;
            }
        }
        return false;
    }

    public function actionChangePassword()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (!Yii::$app->user->isGuest) {
            if (isset($post['password_old']) && isset($post['password']) && isset($post['re_password'])) {
                $user = $this->user;

                if ($user) {
                    if (Yii::$app->security->validatePassword($post['password_old'], $user->password_hash)) {
                        if ($post['password'] == $post['re_password']) {
                            if (strlen($post['password']) >= 6) {
                                $user->setPassword($post['password']);

                                return $user->save();
                            } else {
                                return 'Mật khẩu mới nhỏ hơn 6 kí tự';
                            }
                        } else {
                            return 'Mật khẩu mới không giống nhau';
                        }
                    } else {
                        return 'Mật khẩu cũ không đúng';
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param $content
     * @return bool
     */
    private function actionSaveMessage($content)
    {
        $message = new Message();

        $message->message = $content;
        $message->user_id = $this->user->id;
        $message->type = Message::SEND_ADMIN;

        return $message->save();
    }

    /**
     * @return bool
     */
    public function actionSendAdminTopic()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $topic = Topic::find()->where(['id' => $post['id']])->andWhere(['user_id' => $this->user->id])->one();
            $topic->status = Topic::CHO_DUYET;
            $topic->save(false);

            $content = 'Duyệt chủ đề : Chủ đề <span style="color: #5bc0de">' . $topic->title . '</span> của thành viên <span style="color: blue">' . $this->user->name . '</span> <a style="text-decoration: underline;" href ="/admin/topic/view?id=' . $topic->id . '">chờ duyêt</a>';

            $this->actionSaveMessage($content);

            return true;
        }
        return false;
    }

    public function actionRemoveTopicAdmin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();

        if (isset($post['id'])) {
            $topic = Topic::find()->where(['id' => $post['id']])->andWhere(['user_id' => $this->user->id])->one();
            if ($topic->status == Topic::CHO_DUYET) {
                $topic->status = Topic::KHO_USER;

                $topic->save(false);

                $content = 'Gỡ Chủ đề : Chủ đề <span style="color: #5bc0de">' . $topic->title . '</span> đã được gỡ xuống';

                $this->actionSaveMessage($content);
            }


            return true;
        }
        return false;
    }

    public function actionShowCategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();

        if (isset($post['topic_id'])) {
            $topic = Topic::findOne($post['topic_id']);

            $category = Category::findOne($topic['category_id']);

            $data = '<option value="' . $category['id'] . '">' . $category['title'] . '</option>';

            return $data;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function actionSendAdminExam()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $exam = Exam::find()->where(['id' => $post['id']])->andWhere(['user_id' => $this->user->id])->one();

            if ($exam->status == Exam::KHO_USER || $exam->status == Exam::KHONG_DUYET) {
                $exam->status = Exam::CHO_DUYET;
                $exam->save(false);

                $content = 'Duyệt đề thi : Đề thi <span style="color: #5bc0de">' . $exam->title . '</span> của thành viên <span style="color: blue">' . $this->user->name . '</span> <a style="text-decoration: underline;" href ="/admin/exam/view?id=' . $exam->id . '">chờ duyêt</a>';
                $this->actionSaveMessage($content);
            }


            return true;
        }
        return false;
    }

    function actionDeleteExamUser()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $exam = Exam::find()->where(['id' => $post['id']])->andWhere(['user_id' => $this->user->id])->one();
            if ($exam->status == Exam::KHO_USER) {
                return $exam->delete(false);
            }
        }
        return false;
    }

    /**
     * @return bool|false|int
     * @throws Throwable
     * @throws StaleObjectException
     */
    function actionDeleteTopicUser()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $topic = Topic::find()->where(['id' => $post['id']])
                ->andWhere(['user_id' => $this->user->id])
                ->one();
            if ($topic->status == Topic::KHO_USER || $topic->status == Topic::KHONG_DUYET) {

                return $topic->delete(false);
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function actionChangeDisplayTopicUser()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['display'])) {
            $topic = Topic::find()->where(['id' => $post['id']])->andWhere(['user_id' => $this->user->id])->one();
            if ($topic->status == Topic::DUYET) {
                if ($post['display'] == 0) {
                    $topic->display = 1;
                    $content = 'Hoạt động : Thành viên <span style="color: blue">' . $this->user->name . '</span> đã bật lại hoạt động chủ đề <span style="color: #5bc0de">' . $topic->title . '</span> <a href ="#"></a>';

                    $this->actionSaveMessage($content);
                } else {
                    $topic->display = 0;
                    $content = 'Ngừng hoạt động : Thành viên <span style="color: blue">' . $this->user->name . '</span> đã ngừng hoạt động chủ đề <span style="color: #5bc0de">' . $topic->title . '</span> <a href ="#"></a>';

                    $this->actionSaveMessage($content);
                }
            }

            return $topic->save(false);
        }
        return false;
    }

    /**
     * @return bool
     */
    public function actionSendAdminExamAll()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['status'])) {
            $exams = Exam::find()->where(['user_id' => $this->user->id])->andWhere(['status' => $post['status']])->all();

            foreach ($exams as $key => $value) {

                $exam = Exam::findOne($value['id']);
                $exam->status = Exam::CHO_DUYET;

                $exam->save();
            }

            $content = 'Duyệt đề : ' . count($exams) . ' đề thi của thành viên ' . $this->user->name . ' <a href ="#">chờ duyêt</a>';

            $this->actionSaveMessage($content);

            return true;
        }
        return false;

    }

    /**
     * @return bool
     */
    public function actionSendAdminExamTopicAll()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['topic_id']) && isset($post['title'])) {
            $exams = Exam::find()->where(['user_id' => $this->user->id])->andWhere(['topic_id' => $post['topic_id']])->all();

            foreach ($exams as $key => $value) {

                $exam = Exam::findOne($value['id']);
                $exam->status = Exam::CHO_DUYET;

                $exam->save();
            }

            $content = 'Duyệt đề : ' . count($exams) . ' đề thi thuộc chủ đề :' . $post['title'] . ' của thành viên ' . $this->user->name . ' <a href ="#">chờ duyêt</a>';

            $this->actionSaveMessage($content);

            return true;
        }
        return false;
    }

    public function actionRemoveExamDown()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $exam = Exam::find()->where(['id' => $post['id']])->andWhere(['user_id' => $this->user->id])->one();
            if ($exam->status == Exam::CHO_DUYET) {
                $exam->status = Exam::KHO_USER;

                $exam->save(false);

                $content = 'Gỡ đề thi : Thành viên <span style="color: blue"> ' . $this->user->name . '</span> đã gỡ đề thi <span style="color: #5bc0de">' . $exam->title . '</span> xuống';

                $this->actionSaveMessage($content);
            }

            return true;
        }

        return false;
    }

    public function actionGetQuestion($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $question = Question::findOne($id);

        if ($question && $question['user_id'] == $this->user->id) {
            return $question;
        }

        return false;
    }

    /**
     * @return bool|false|int
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionRemoveExamUserBuy()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $user_exam_buy = UserExam::find()->where(['id' => $post['id']])->andWhere(['user_id' => $this->user->id])->andWhere(['type' => UserExam::BOUGHT])->one();

            if ($user_exam_buy) {
                return $user_exam_buy->delete(false);
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function actionCountView()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['exam_id'])) {
            $exam = Exam::findOne($post['exam_id']);
            if ($exam) {
                $exam['view'] += 1;
                return $exam->save();
            } else {
                return false;
            }
        }
        return false;
    }

    public function actionChangeMessageStatus()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {

            $message = Message::find()->where(['id' => $post['id']])->andWhere(['user_id' => $this->user->id])->one();
            if ($message) {
                $message->status = 1;
                $message->save();
            }
            return $message;
        }
        return false;
    }

    public function actionHiddenTopicUser()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $topic = Topic::find()->where(['id' => $post['id']])->andWhere(['user_id' => $this->user->id])->one();
            if ($topic->status == Topic::DUYET) {
                $topic->active = Topic::NO_ACTIVE;

                $content = 'Xóa chủ đề : Thành viên <span style="color: blue"> ' . $this->user->name . '</span> đã xóa chủ đề  <span style="color: #5bc0de">' . $topic->title . '</span>';

                $this->actionSaveMessage($content);

                $topic->save();
            }
            return true;
        }
        return false;
    }

    /**
     * @return bool|false|int
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDeleteExamSave()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['exam_id']) && isset($post['user_id'])) {
            $exam_save = UserExam::find()->where(['exam_id' => $post['exam_id']])->andWhere(['user_id' => $post['user_id']])->andWhere(['type' => UserExam::BOUGHT])->one();
            return $exam_save->delete();
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function actionReportQuestion()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['question_id']) && isset($post['content_report'])) {
            $reportQuestion = new ReportQuestion();

            $reportQuestion->question_id = $post['question_id'];
            $reportQuestion->user_id = $this->user->id;
            $reportQuestion->content_report = $post['content_report'];
            $reportQuestion->status = ReportQuestion::STATUS_ERROR;
            $reportQuestion->save();

            $question = Question::findOne($post['question_id']);
            $examQuestion = ExamQuestion::find()->where(['question_id'=>$post['question_id']])->one();
            $exam = Exam::findOne($examQuestion['exam_id']);

            $content = 'Báo lỗi câu hỏi : Câu hỏi <span style="color: blue"> ' . $question->content . '</span> của đề thi  <span style="color: #5bc0de">' . $exam->title . '</span> bị lỗi. <a href="/exam/detail-error?id='.$exam->id.'">Kiểm tra</a>';

            $this->actionSaveMessage($content);

            return true;
        }

        return false;
    }

    public function actionRemoveExamDuyet()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $exam = Exam::findOne($post['id']);

            if ($exam->status == Exam::DUYET) {
                $exam->disable = 0;

                $content = 'Xóa đề thi : Thành viên <span style="color: blue"> ' . $this->user->name . '</span> đã xóa đề thi <span style="color: #5bc0de">' . $exam->title . '</span>';

                $this->actionSaveMessage($content);

                $exam->save();
            }
            return true;
        }

        return false;
    }

    public function actionSaveExam()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['exam_id'])) {

            if (!$this->user) {
                return 0;
            } else {
                $favorite_old = UserExam::find()->where(['user_id' => $this->user->id])->andWhere(['=', 'exam_id', $post['exam_id']])->andWhere(['type' => UserExam::SAVE])->one();
                if (!$favorite_old) {
                    $favorite = new UserExam();
                    $data = [];
                    $favorite['exam_id'] = $post['exam_id'];
                    $favorite['user_id'] = $this->user->id;
                    $favorite['type'] = UserExam::SAVE;
                    $favorite->save();
                    $count = UserExam::find()->where(['=', 'exam_id', $post['exam_id'],])->andWhere(['type' => UserExam::SAVE])->count();
                    $temp = 1;
                    array_push($data, $temp, $count);
                    return $data;
                }
                if ($favorite_old) {
                    $favorite_old->delete();
                    $data = [];
                    $count = UserExam::find()->where(['=', 'exam_id', $post['exam_id'],])->andWhere(['type' => UserExam::SAVE])->count();
                    $temp = 0;
                    array_push($data, $temp, $count);
                    return $data;
                }
            }
        }
        return false;
    }
}