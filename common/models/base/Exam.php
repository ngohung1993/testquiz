<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property double $price
 * @property double $price_discount
 * @property string $description
 * @property int $status
 * @property string $reason_reject
 * @property int $type
 * @property int $topic_id
 * @property int $seo_tool_id
 * @property string $slug
 * @property string $tags
 * @property string $file_exam
 * @property string $file_answer
 * @property int $number_question
 * @property string $answer
 * @property int $count_bought
 * @property int $download
 * @property int $classify
 * @property int $user_id
 * @property string $time
 * @property int $created_at
 * @property int $updated_at
 * @property int $disable
 * @property int $views
 * @property int $set_date_time
 * @property int $set_date_time_end
 * @property int $admin_show_hide
 *
 * @property SeoTool $seoTool
 * @property Topic $topic
 * @property User $user
 * @property ExamQuestion[] $examQuestions
 * @property Room[] $rooms
 * @property Tab[] $tabs
 * @property TransactionHistory[] $transactionHistories
 * @property UserExam[] $userExams
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'topic_id', 'classify', 'user_id'], 'required'],
            [['price', 'price_discount'], 'number'],
            [['description', 'answer'], 'string'],
            [['status', 'type', 'topic_id', 'seo_tool_id', 'number_question', 'count_bought', 'download', 'classify', 'user_id', 'created_at', 'updated_at', 'disable', 'views', 'set_date_time', 'set_date_time_end', 'admin_show_hide'], 'integer'],
            [['time'], 'safe'],
            [['title', 'avatar', 'reason_reject', 'slug', 'tags', 'file_exam', 'file_answer'], 'string', 'max' => 255],
            [['seo_tool_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoTool::className(), 'targetAttribute' => ['seo_tool_id' => 'id']],
            [['topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Topic::className(), 'targetAttribute' => ['topic_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'avatar' => 'Avatar',
            'price' => 'Price',
            'price_discount' => 'Price Discount',
            'description' => 'Description',
            'status' => 'Status',
            'reason_reject' => 'Reason Reject',
            'type' => 'Type',
            'topic_id' => 'Topic ID',
            'seo_tool_id' => 'Seo Tool ID',
            'slug' => 'Slug',
            'tags' => 'Tags',
            'file_exam' => 'File Exam',
            'file_answer' => 'File Answer',
            'number_question' => 'Number Question',
            'answer' => 'Answer',
            'count_bought' => 'Count Bought',
            'download' => 'Download',
            'classify' => 'Classify',
            'user_id' => 'User ID',
            'time' => 'Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'disable' => 'Disable',
            'views' => 'Views',
            'set_date_time' => 'Set Date Time',
            'set_date_time_end' => 'Set Date Time End',
            'admin_show_hide' => 'Admin Show Hide',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoTool()
    {
        return $this->hasOne(SeoTool::className(), ['id' => 'seo_tool_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(Topic::className(), ['id' => 'topic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamQuestions()
    {
        return $this->hasMany(ExamQuestion::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabs()
    {
        return $this->hasMany(Tab::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionHistories()
    {
        return $this->hasMany(TransactionHistory::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserExams()
    {
        return $this->hasMany(UserExam::className(), ['exam_id' => 'id']);
    }
}
