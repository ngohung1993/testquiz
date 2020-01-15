<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property string $description
 * @property int $status
 * @property int $active
 * @property int $classroom_detail_id
 * @property int $hot
 * @property int $seo_tool_id
 * @property string $slug
 * @property string $tags
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $category_id
 * @property int $display
 * @property string $reason_reject
 *
 * @property Exam[] $exams
 * @property Question[] $questions
 * @property Category $category
 * @property ClassroomDetail $classroomDetail
 * @property SeoTool $seoTool
 * @property User $user
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'classroom_detail_id', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['status', 'active', 'classroom_detail_id', 'hot', 'seo_tool_id', 'user_id', 'created_at', 'updated_at', 'category_id', 'display'], 'integer'],
            [['title', 'avatar', 'slug', 'tags', 'reason_reject'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['classroom_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClassroomDetail::className(), 'targetAttribute' => ['classroom_detail_id' => 'id']],
            [['seo_tool_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoTool::className(), 'targetAttribute' => ['seo_tool_id' => 'id']],
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
            'description' => 'Description',
            'status' => 'Status',
            'active' => 'Active',
            'classroom_detail_id' => 'Classroom Detail ID',
            'hot' => 'Hot',
            'seo_tool_id' => 'Seo Tool ID',
            'slug' => 'Slug',
            'tags' => 'Tags',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'category_id' => 'Category ID',
            'display' => 'Display',
            'reason_reject' => 'Reason Reject',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExams()
    {
        return $this->hasMany(Exam::className(), ['topic_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['topic_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassroomDetail()
    {
        return $this->hasOne(ClassroomDetail::className(), ['id' => 'classroom_detail_id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
