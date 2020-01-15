<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "utilities".
 *
 * @property int $id
 * @property string $title
 * @property string $path
 * @property int $serial
 * @property int $parent_id
 * @property int $released
 * @property int $status
 */
class Utilities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['serial', 'parent_id', 'released', 'status'], 'integer'],
            [['title', 'path'], 'string', 'max' => 255],
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
            'path' => 'Path',
            'serial' => 'Serial',
            'parent_id' => 'Parent ID',
            'released' => 'Released',
            'status' => 'Status',
        ];
    }
}
