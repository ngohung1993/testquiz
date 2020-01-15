<?php

namespace backend\controllers;

use common\models\Classroom;
use common\models\ExamQuestion;
use common\models\Question;
use common\models\ReportQuestion;
use common\models\TransactionHistory;
use common\models\Utilities;
use frontend\controllers\base\BaseController;
use Yii;
use yii\web\Response;
use yii\web\Controller;
use common\models\Album;
use common\models\Category;
use common\models\Post;
use common\models\Supporter;
use common\models\User;
use common\models\Setting;
use common\models\Page;
use common\models\SeoTool;
use common\helpers\FunctionHelper;
use common\models\Tab;
use common\models\Trademark;
use PHPMailer\PHPMailer\PHPMailer;
use common\models\Exam;
use common\models\Message;
use common\models\Subject;
use common\models\Topic;
use common\models\Image;

/**
 * AjaxController
 */
class AjaxController extends BaseController
{
    /**
     * @param $action
     *
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    /**
     * @return bool
     */
    public function actionReleased()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['table']) && isset($post['api'])) {
            $model = null;

            switch ($post['table']) {
                case 'page':
                    $model = Page::findOne($post['id']);
                    break;

                case 'subject':
                    $model = Subject::findOne($post['id']);
                    break;

                case 'setting':
                    $model = Setting::findOne($post['id']);
                    break;

                case 'user':
                    $model = User::findOne($post['id']);
                    break;

                case 'classroom':
                    $model = Classroom::findOne($post['id']);
                    break;

                default:
                    break;
            }

            if ($model == 'user') {
                $model->status = $model['status'] ? 0 : 10;
            }else{
                $model->status = $model->status ? 0 : 1;
            }

            return $model->save();

        }

        return false;
    }

    /**
     * @return bool
     */
    public function actionEnableColumn()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['table']) && isset($post['api']) && isset($post['column'])) {
            $model = null;

            switch ($post['table']) {
                case 'category':
                    $model = Category::findOne($post['id']);

                    break;
                case 'post':
                    $model = Post::findOne($post['id']);

                    break;
                case 'setting':
                    $model = Setting::findOne($post['id']);

                    break;

                case 'supporter':
                    $model = Supporter::findOne($post['id']);
                    break;

                case 'trademark':
                    $model = Trademark::findOne($post['id']);
                    break;
                default:
                    break;
            }

            if ($model) {
                $model[$post['column']] = $model[$post['column']] ? 0 : 1;

                return $model->save();
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function actionUploadImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['images']) && isset($post['id']) && isset($post['column_parent_id'])) {
            $images = json_decode($post['images']);

            foreach ($images as $key => $value) {
                $image = new Image();

                $image->title = $value;
                $image->avatar = '/uploads/advertises/' . $value;
                $image->status = 1;
                $image[$post['column_parent_id']] = $post['id'];

                $image->save();
            }

            return true;

        }

        return false;

    }

    /**
     * @return bool|false|int
     * @throws \Throwable
     */
    public function actionDeleteImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $image = Image::findOne($post['id']);

            return $image->delete();
        }

        return false;

    }

    /**
     * @return bool
     */
    public function actionSerial()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['serialize'])) {
            $serialize = json_decode($post['serialize']);

            foreach ($serialize as $key => $item) {
                $this->save_serial($item, $key + 1, null);
            }

            return true;
        }

        return false;
    }

    /**
     * @param $item
     * @param $serial
     * @param $parent
     */
    private function save_serial($item, $serial, $parent)
    {
        $array = get_object_vars($item);

        $category = Category::findOne($array['id']);

        $category->serial = $serial;

        $category->parent_id = $parent;

        $category->save();

        if (count($array) == 2) {
            foreach ($array['children'] as $key_c => $item_c) {
                $this->save_serial($item_c, $key_c + 1, $array['id']);
            }
        }
    }

    /**
     * @param $page_id
     */
    public function actionGetCategoriesByPageId($page_id)
    {
        $categories = Category::find()
            ->where(['page_id' => $page_id])
            ->orderBy('id DESC')
            ->all();

        echo "<option value=''>" . Yii::t('backend', '-- Select category --') . "</option>";

        if (!empty($categories)) {
            FunctionHelper::show_categories_select($categories);
        }
    }

    /**
     * @return array|bool|mixed
     */
    public function actionEditColumn()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['name']) && isset($post['pk']) && isset($post['value'])) {
            $table_column = explode('#', $post['name']);

            if (count($table_column) === 2) {
                $table = $table_column[0];
                $column = $table_column[1];

                $model = null;

                switch ($table) {
                    case 'category':
                        $model = Category::findOne($post['pk']);
                        break;
                    case 'post':
                        $model = Post::findOne($post['pk']);
                        break;
                    case 'setting':
                        $model = Setting::findOne($post['pk']);
                        break;
                    case 'image':
                        $model = Image::findOne($post['pk']);
                        break;
                    case 'supporter':
                        $model = Supporter::findOne($post['pk']);
                        break;
                    case 'utilities':
                        $model = Utilities::findOne($post['pk']);
                        break;
                    case 'tab':
                        $model = Tab::findOne($post['pk']);
                        break;
                    default:
                        break;
                }

                if ($model) {
                    $model[$column] = $post['value'];

                    return $model->save();
                }

            }
        }

        return $post;
    }

    /**
     * @return array|bool
     */
    public function actionGetProductById()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $product = Product::find()->joinWith('images0')->where([
                '=',
                'product.id',
                $post['id']
            ])->asArray()->one();

            if ($product) {
                $albums = Album::find()->joinWith('images')->where([
                    '=',
                    'album.product_id',
                    $post['id']
                ])->asArray()->all();

                return [$product, $albums];
            }
        }

        return false;
    }

    /**
     * @return bool|null|object
     */
    public function actionGetContentImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $image = Image::findOne($post['id']);

            return $image;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function actionEditContentImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['content'])) {
            $image = Image::findOne($post['id']);

            $image->content = $post['content'];

            return $image->save();
        }

        return false;
    }

    /**
     * @return bool|string
     */
    public function actionChangePassword()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (!Yii::$app->user->isGuest) {
            if (isset($post['password_old']) && isset($post['password']) && isset($post['re_password'])) {

                $user = User::findOne(Yii::$app->user->identity->getId());

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
     * @return bool
     */
    public function actionUpdatePost()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['title']) && isset($post['category_id']) && isset($post['avatar']) && isset($post['featured']) && isset($post['display_homepage']) && isset($post['seo_title']) && isset($post['meta_keywords']) && isset($post['meta_description'])) {
            $post_find = Post::findOne($post['id']);

            $post_find->title = $post['title'];
            $post_find->category_id = (int)$post['category_id'];
            $post_find->avatar = $post['avatar'];
            $post_find->featured = $post['featured'];
            $post_find->display_homepage = $post['display_homepage'];

            if ($post_find->save()) {
                $seo = SeoTool::findOne($post_find->seo_tool_id);

                $seo->seo_title = $post['seo_title'];
                $seo->meta_keywords = $post['meta_keywords'];
                $seo->meta_description = $post['meta_description'];
                $seo->save();

                return true;
            }
        }

        return false;
    }

    public function actionCountView($id, $view)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $classified = Classified::findOne($id);
        $classified->view = $view;
        return $classified->save();
    }

    public function actionSendMail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['title']) && isset($post['email_root']) && isset($post['email_guest']) && isset($post['content'])) {
            $mail = new PHPMailer(true);

            $mail->CharSet = 'UTF-8';

            $mail->isSMTP();

            $mail->SMTPDebug = 0;

            $mail->Host = 'smtp.gmail.com';

            $mail->Port = 587;

            $mail->SMTPSecure = 'tls';

            $mail->SMTPAuth = true;

            $mail->Username = "cskhtigerweb@gmail.com";

            $mail->Password = "270295thai";

            $mail->setFrom('cskhtigerweb@gmail.com', 'TIGERWEB.VN');

            $mail->addReplyTo($post['email_guest']);

            $mail->addAddress($post['email_root']);

            $mail->Subject = $post['title'];

            $mail->msgHTML($post['content']);

            $mail->AltBody = 'This is a plain-text message body';

            if ($mail->send()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function actionChangeTopicStatus()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['status']) && isset($post['active'])) {
            $topic = Topic::findOne($post['id']);

            if ($post['status'] == Topic::DUYET && $post['active'] == Topic::ACTIVE) {
                $topic->status = $post['status'];
                $topic->active = $post['active'];
            }

            if ($post['status'] == Topic::DUYET && $post['active'] == Topic::ACTIVE) {
                $topic->active = $post['active'];
            }
            $topic->save();

            return true;
        }
        return false;
    }

    /**
     * @param $message
     * @return bool
     */
    public function actionSaveMessage($content, $user)
    {
        $message = new Message();

        $message->message = $content;
        $message->user_id = $user;
        $message->type = Message::SEND_USER;

        return $message->save();

    }

    /**
     * @return bool
     */
    public function actionCreateReasonChangeStatusTheme()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['id']) && isset($post['user_id']) && isset($post['status'])) {
            $topic = Topic::findOne($post['id']);
            if ($topic) {
                if ($post['status'] == Topic::KHONG_DUYET) {
                    $topic->status = Topic::KHONG_DUYET;
                }
                if ($post['status'] == Topic::NO_ACTIVE) {
                    $topic->active = Topic::NO_ACTIVE;
                }
                $topic->save();

                $content = 'Chủ đề :' . $post['title'] . '. Lý do:' . $post['reason'];

                $this->actionSaveMessage($content, $post['user_id']);
            }

            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function actionCancelTransaction()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['id'])) {
            $transaction = TransactionHistory::findOne($post['id']);

            if ($transaction) {
                $user = User::find()->where(['id' => $transaction['user_id']])->one();
                $user->wallet += $transaction['amount'];
                $user->save();
            }
            $transaction->note = $post['note'];
            $transaction->status = TransactionHistory::FAILURE;

            $transaction->save(false);

            $content = 'Giao dịch thất bại : Số tiền <span>' . number_format($transaction['amount'], 0, ",", ".") . '</span> đ đã được cộng trở lại tài khoản của bạn. Lý do hủy:' . $post['note'];

            $this->actionSaveMessage($content, $user['id']);

            return true;
        }
        return false;
    }

    public function actionCancelTransactionRecharge()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['id'])) {
            $transaction = TransactionHistory::findOne($post['id']);
            $transaction->note = $post['note'];
            $transaction->status = TransactionHistory::FAILURE;
            $user = User::findOne($transaction['user_id']);

            $transaction->save(false);

            $content = 'Giao dịch thất bại : Số tiền ' . $transaction['amount'] . ' Admin chưa xác thực được. Vui lòng kiểm tra lại';

            $this->actionSaveMessage($content, $user['id']);

            return true;
        }
        return false;
    }

    public function actionChangeStatusMessage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['id'])) {
            $message = Message::findOne($post['id']);
            if ($message) {
                $message->status = 1;
                $message->save();
            }
            return $message;
        }
        return false;
    }

    public function actionChangeStatusExamApprove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['data']) && isset($post['topic_id'])) {
            $topic = Topic::findOne($post['topic_id']);
            $array_id_exam = json_decode(stripslashes($_POST['data']));
            foreach ($array_id_exam as $key => $value) {
                $exam = Exam::findOne($value);
                if ($exam->status == Exam::CHO_DUYET) {
                    $exam->status = Exam::DUYET;
                    $exam->save();
                }
            }
            $content = count($array_id_exam) . ' đề thi của chủ đề <span style="color: #5bc0de">' . $topic->title . '</span> đã được duyệt thành công';

            $this->actionSaveMessage($content, $topic->user_id);

            return true;
        }
        return false;
    }

    public function actionGetTotalMoney()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['start_time']) && isset($post['end_time'])) {
            $data = TransactionHistory::find()
                ->where(['status' => TransactionHistory::SUCCESS])
                ->andWhere(['type' => TransactionHistory::RECHARGE])
                ->andWhere(['AND', ['>=', 'time', $post['start_time']], ['<=', 'time', $post['end_time']]])
                ->all();

            $total = 0;
            foreach ($data as $value) {
                $total += $value['amount'];
            }
            return $total;
        }
        return false;
    }

    public function actionGetTotalExam()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['start_time']) && isset($post['end_time'])) {
            $data = TransactionHistory::find()
                ->where(['status' => TransactionHistory::SUCCESS])
                ->andWhere(['OR', ['=', 'type', TransactionHistory::BY_EXAM], ['=', 'type', TransactionHistory::SELL_EXAM]])
                ->andWhere(['AND', ['>=', 'time', $post['start_time']], ['<=', 'time', $post['end_time']]])
                ->count();

            return $data;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function actionChangeStatusReportQuestion()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if(isset($post['id'])){
            $query = ReportQuestion::findOne($post['id']);

            if($query->status == ReportQuestion::STATUS_ERROR){
                $query->status = ReportQuestion::STATUS_SUCCESS;
                $query->save();
            }

            return true;
        }
        return false;
    }

    public function actionNotifyTheCreator()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if(isset($post['id']) && isset($post['question_id'])){
            $query = Question::findOne([$post['question_id']]);

            $this->copyQuestion($query);

            $reportQuestion = ReportQuestion::findOne($post['id']);
            $reportQuestion->status = ReportQuestion::STATUS_WARNING_HENDLE;
            $reportQuestion->save();

            $examQuestion = ExamQuestion::find()->where(['question_id' => $post['question_id']])->one();

            $exam = Exam::findOne($examQuestion['exam_id']);
            $exam->status = Exam::EXAM_ERROR;
            $exam->save();

            $content = 'Câu hỏi '.$query->content.' của đề thi '.$exam->title.' lỗi. <a href="/exam/edit-question?id='.$exam->id.'">Vui lòng kiểm tra và sửa lại</a>';
            $this->actionSaveMessage($content,$exam->user_id);

            return true;
        }

        return false;
    }

    /**
     * @param $query
     * @return bool
     */
    private function copyQuestion($query)
    {
        $question = new Question();
        $question->answer = $query['answer'];
        $question->content = $query['content'];
        $question->answer_correct = $query['answer_correct'];
        $question->status = $query['status'];
        $question->explain = $query['explain'];
        $question->user_id = $query['user_id'];
        $question->topic_id = $query['topic_id'];
        $question->type = $query['type'];
        $question->media = $query['media'];
        $question->parent_id = $query['id'];
        $question->save(false);
        
        return true;
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionReplaceQuestionError()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if(isset($post['id_new']) && isset($post['id_old']) && isset($post['id_report'])){
            $questionNew = Question::findOne($post['id_new']);

            $questionOld = Question::findOne($post['id_old']);

            $this->ReplaceQuestion($questionOld,$questionNew);

            $report = ReportQuestion::findOne($post['id_report']);
            $report->status = ReportQuestion::STATUS_SUCCESS;
            $report->save();

            if($questionNew){
                $questionNew->delete();
            }

            return true;
        }
        return false;
    }

    /**
     * @param $questionOld
     * @param $query
     * @return mixed
     */
    private function ReplaceQuestion($questionOld,$query)
    {
        $questionOld->answer = $query['answer'];
        $questionOld->content = $query['content'];
        $questionOld->answer_correct = $query['answer_correct'];
        $questionOld->status = $query['status'];
        $questionOld->explain = $query['explain'];
        $questionOld->user_id = $query['user_id'];
        $questionOld->topic_id = $query['topic_id'];
        $questionOld->type = $query['type'];
        $questionOld->media = $query['media'];
        $questionOld->save();

        return true;

    }

    /**
     * @return bool
     */
    public function actionResenEditQuestionError()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if(isset($post['id'])){
            $query = ReportQuestion::findOne($post['id']);
            $query->status = ReportQuestion::STATUS_WARNING_HENDLE;
            return $query->save();
        }
        return false;
    }

    public function actionAdminDisableExam()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if(isset($post['id']) && isset($post['reason'])){
            $exam = Exam::findOne($post['id']);

            if($exam->status == Exam::DUYET){
                $exam->reason_reject = $post['reason'];
                $exam->admin_show_hide = 2;

                $content = 'Đề thi <span style="color: #0d88c1">'.$exam->title.'</span> ngừng hoạt động. Lý do: '.$post['reason'];

                $this->actionSaveMessage($content, $exam->user_id);

                $exam->save();
            }

            return true;
        }

        return false;
    }
}