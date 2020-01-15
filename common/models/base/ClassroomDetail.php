<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "classroom_detail".
 *
 * @property int $id
 * @property int $classroom_id
 * @property int $subject_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Classroom $classroom
 * @property Subject $subject
 * @property Topic[] $topics
 */
class ClassroomDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'classroom_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['classroom_id', 'subject_id'], 'required'],
            [['classroom_id', 'subject_id', 'created_at', 'updated_at'], 'integer'],
            [['classroom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classroom::className(), 'targetAttribute' => ['classroom_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'classroom_id' => Yii::t('app', 'Classroom ID'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassroom()
    {
        return $this->hasOne(Classroom::className(), ['id' => 'classroom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topic::className(), ['classroom_detail_id' => 'id']);
    }
}
