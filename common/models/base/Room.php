<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property string $completion_time
 * @property string $questions
 * @property string $answers
 * @property int $scores
 * @property int $exam_id
 * @property int $user_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Exam $exam
 * @property User $user
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['completion_time'], 'safe'],
            [['questions', 'answers'], 'string'],
            [['scores', 'exam_id', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['exam_id', 'user_id'], 'required'],
            [['exam_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exam::className(), 'targetAttribute' => ['exam_id' => 'id']],
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
            'completion_time' => 'Completion Time',
            'questions' => 'Questions',
            'answers' => 'Answers',
            'scores' => 'Scores',
            'exam_id' => 'Exam ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExam()
    {
        return $this->hasOne(Exam::className(), ['id' => 'exam_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
