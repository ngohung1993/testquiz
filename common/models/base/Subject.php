<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property string $description
 * @property int $serial
 * @property int $status
 * @property string $slug
 * @property string $icon
 * @property int $created_at
 * @property int $updated_at
 * @property int $seo_tool_id
 * @property int $disable
 *
 * @property ClassroomDetail[] $classroomDetails
 * @property SeoTool $seoTool
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['serial', 'status', 'created_at', 'updated_at', 'seo_tool_id', 'disable'], 'integer'],
            [['title', 'avatar', 'slug', 'icon'], 'string', 'max' => 255],
            [['seo_tool_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoTool::className(), 'targetAttribute' => ['seo_tool_id' => 'id']],
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
            'serial' => 'Serial',
            'status' => 'Status',
            'slug' => 'Slug',
            'icon' => 'Icon',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'seo_tool_id' => 'Seo Tool ID',
            'disable' => 'Disable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassroomDetails()
    {
        return $this->hasMany(ClassroomDetail::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoTool()
    {
        return $this->hasOne(SeoTool::className(), ['id' => 'seo_tool_id']);
    }
}
