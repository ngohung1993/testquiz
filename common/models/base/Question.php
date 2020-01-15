<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $answer
 * @property string $content
 * @property string $answer_correct
 * @property int $status
 * @property string $explain
 * @property int $user_id
 * @property int $topic_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $type
 * @property string $media
 * @property int $parent_id
 *
 * @property ExamQuestion[] $examQuestions
 * @property Topic $topic
 * @property User $user
 * @property ReportQuestion[] $reportQuestions
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['answer', 'content', 'explain', 'media'], 'string'],
            [['status', 'user_id', 'topic_id', 'created_at', 'updated_at', 'type', 'parent_id'], 'integer'],
            [['answer_correct'], 'string', 'max' => 255],
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
            'answer' => 'Answer',
            'content' => 'Content',
            'answer_correct' => 'Answer Correct',
            'status' => 'Status',
            'explain' => 'Explain',
            'user_id' => 'User ID',
            'topic_id' => 'Topic ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type' => 'Type',
            'media' => 'Media',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamQuestions()
    {
        return $this->hasMany(ExamQuestion::className(), ['question_id' => 'id']);
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
    public function getReportQuestions()
    {
        return $this->hasMany(ReportQuestion::className(), ['question_id' => 'id']);
    }
}
