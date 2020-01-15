<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property string $describe
 * @property int $serial
 * @property int $parent_id
 * @property string $content
 * @property int $status
 * @property int $seo_tool_id
 * @property string $slug
 * @property string $key
 * @property string $code
 * @property string $link
 * @property string $icon
 * @property int $page_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $type
 *
 * @property Page $page
 * @property Category $parent
 * @property Category[] $categories
 * @property SeoTool $seoTool
 * @property Classroom[] $classrooms
 * @property Post[] $posts
 * @property Tab[] $tabs
 * @property Topic[] $topics
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['describe', 'content', 'code'], 'string'],
            [['serial', 'parent_id', 'status', 'seo_tool_id', 'page_id', 'created_at', 'updated_at', 'type'], 'integer'],
            [['title', 'avatar', 'slug', 'key', 'link', 'icon'], 'string', 'max' => 255],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
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
            'id' => 'ID',
            'title' => 'Title',
            'avatar' => 'Avatar',
            'describe' => 'Describe',
            'serial' => 'Serial',
            'parent_id' => 'Parent ID',
            'content' => 'Content',
            'status' => 'Status',
            'seo_tool_id' => 'Seo Tool ID',
            'slug' => 'Slug',
            'key' => 'Key',
            'code' => 'Code',
            'link' => 'Link',
            'icon' => 'Icon',
            'page_id' => 'Page ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
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
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
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
    public function getClassrooms()
    {
        return $this->hasMany(Classroom::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabs()
    {
        return $this->hasMany(Tab::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topic::className(), ['category_id' => 'id']);
    }
}
