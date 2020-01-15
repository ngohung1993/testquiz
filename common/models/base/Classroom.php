<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "classroom".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property string $description
 * @property int $serial
 * @property int $parent_id
 * @property int $status
 * @property int $seo_tool_id
 * @property string $slug
 * @property string $icon
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category $parent
 * @property SeoTool $seoTool
 * @property ClassroomDetail[] $classroomDetails
 */
class Classroom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'classroom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['serial', 'parent_id', 'status', 'seo_tool_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'avatar', 'slug', 'icon'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['seo_tool_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoTool::className(), 'targetAttribute' => ['seo_tool_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'avatar' => Yii::t('app', 'Avatar'),
            'description' => Yii::t('app', 'Description'),
            'serial' => Yii::t('app', 'Serial'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app', 'Status'),
            'seo_tool_id' => Yii::t('app', 'Seo Tool ID'),
            'slug' => Yii::t('app', 'Slug'),
            'icon' => Yii::t('app', 'Icon'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
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
    public function getClassroomDetails()
    {
        return $this->hasMany(ClassroomDetail::className(), ['classroom_id' => 'id']);
    }
}
