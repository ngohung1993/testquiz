<?php

namespace common\models;

use common\models\base;
use yii\db\ActiveRecord;

class Question extends base\Question
{
    const TYPE_CHOOSE = 1;
    const TYPE_FILL = 2;
    const TYPE_MATCHING = 3;

    /**
     * @var UploadedFile|Null file attribute
     */
    public $content_media;
    public $explain_media;

    public $answer_a_media;
    public $answer_b_media;
    public $answer_c_media;
    public $answer_d_media;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => time()
            ],
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['content_media'], 'file'],
            [['explain_media'], 'file'],
            [['answer_a_media'], 'file'],
            [['answer_b_media'], 'file'],
            [['answer_c_media'], 'file'],
            [['answer_d_media'], 'file'],
        ]);
    }

    public function getTypeLabel()
    {
        $key = $this->type;
        $arr = $this->typeLabel();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'N/A';
    }

    public function typeLabel()
    {
        return [
            self::TYPE_CHOOSE => 'Chọn đáp án đúng',
            self::TYPE_FILL => 'Điền vào chỗ trống',
            self::TYPE_MATCHING => 'Sắp xếp câu'
        ];
    }

    public function getTypeView()
    {
        $key = $this->type;
        $arr = $this->typeView();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'N/A';
    }

    public function typeView()
    {
        return [
            self::TYPE_CHOOSE => '_choose_answer',
            self::TYPE_FILL => '_fill_blank',
            self::TYPE_MATCHING => '_matching'
        ];
    }

    /**
     * @param $key
     * @param bool $full_path
     * @return string
     */
    public function getMedia($key, $full_path = true)
    {
        $key = strtolower($key . '_media');

        $media = json_decode($this->media, true);

        $audioExts = ['mp3'];

        $result = '';
        if (isset($media[$key])) {
            $name = ($full_path ? '/uploads/media/' : '') . $media[$key]['name'] . '.' . $media[$key]['ext'];

            if ($full_path) {
                if (in_array($media[$key]['ext'], $audioExts)) {
                    $result .= '<audio controls><source src="' . $name . '" type="audio/mpeg"></audio>';
                } else {
                    $result .= '<p><img src="' . $name . '" alt="" style="max-width:100%;"></p>';
                }
            } else {
                $result = $name;
            }

            return $result;
        }

        return $result;
    }

    /**
     * @param $int
     * @return string
     */
    public function getNumber($int)
    {
        return $int >= 10 ? $int : '0' . $int;
    }

}