<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "widgets".
 *
 * @property int $id
 * @property int $position
 * @property string $background_color
 * @property string $title_color
 * @property string $text_color
 * @property string $button_color
 * @property string $button_text
 * @property string $title
 * @property string $description
 * @property string $email
 */
class Widgets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widgets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position'], 'integer'],
            [['background_color', 'title_color', 'text_color', 'button_color', 'button_text', 'title', 'description', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position' => 'Position',
            'background_color' => 'Background Color',
            'title_color' => 'Title Color',
            'text_color' => 'Text Color',
            'button_color' => 'Button Color',
            'button_text' => 'Button Text',
            'title' => 'Title',
            'description' => 'Description',
            'email' => 'Email',
        ];
    }
}
