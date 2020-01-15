<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property string $sub_photo
 * @property int $serial
 * @property string $link
 * @property string $describe
 * @property int $featured
 * @property string $content
 * @property int $post_id
 * @property int $category_id
 * @property int $setting_id
 * @property int $tab_id
 * @property int $status
 * @property string $code
 *
 * @property Post $post
 * @property Setting $setting
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avatar'], 'required'],
            [['serial', 'featured', 'post_id', 'category_id', 'setting_id', 'tab_id', 'status'], 'integer'],
            [['describe', 'content', 'code'], 'string'],
            [['title', 'avatar', 'sub_photo', 'link'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Setting::className(), 'targetAttribute' => ['setting_id' => 'id']],
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
            'sub_photo' => 'Sub Photo',
            'serial' => 'Serial',
            'link' => 'Link',
            'describe' => 'Describe',
            'featured' => 'Featured',
            'content' => 'Content',
            'post_id' => 'Post ID',
            'category_id' => 'Category ID',
            'setting_id' => 'Setting ID',
            'tab_id' => 'Tab ID',
            'status' => 'Status',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetting()
    {
        return $this->hasOne(Setting::className(), ['id' => 'setting_id']);
    }
}
