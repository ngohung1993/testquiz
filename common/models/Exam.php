<?php

namespace common\models;

use common\models\base;
use yii\db\ActiveRecord;

class Exam extends base\Exam
{
    const CHO_DUYET = 0;
    const DUYET = 1;
    const KHONG_DUYET = 2;
    const KHO_USER = 3;
    const EXAM_ERROR = 4;
    const CUSTOM = 1;
    const UPLOAD = 2;
    const FREE_TIME_EXAM = 1;
    const TIME_EXAM = 2;
    const SET_TIME_EXAM = 3;
    const DISABLE = 0;
    const BLOCK = 1;
    const ADMIN_HIDE = 2;
    const ADMIN_SHOW = 1;

    public $fileUploadExam;
    public $fileUploadAnswer;

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

    public function getStatusLabel()
    {
        $key = $this->status;
        $arr = $this->statusLabel();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'N/A';
    }

    public function getStatusBg()
    {
        $key = $this->status;
        $arr = $this->statusBg();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'N/A';
    }

    public function getStatusIcon()
    {
        $key = $this->status;
        $arr = $this->statusIcon();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'N/A';
    }

    public function statusBg()
    {
        return [
            self::CHO_DUYET => 'bg-yellow',
            self::DUYET => 'bg-blue',
            self::KHONG_DUYET => 'bg-red',
            self::KHO_USER => 'bg-red',
            self::EXAM_ERROR => 'bg-red',
        ];
    }

    public function statusLabel()
    {
        return [
            self::CHO_DUYET => 'Chờ duyệt',
            self::DUYET => 'Duyệt',
            self::KHONG_DUYET => 'Không duyệt',
            self::KHO_USER => 'Lưu nháp',
            self::EXAM_ERROR => 'Đề thi lỗi'
        ];
    }

    public function statusIcon()
    {
        return [
            self::CHO_DUYET => 'fa fa-clock-o',
            self::DUYET => 'fa fa-check-square-o',
            self::KHONG_DUYET => 'fa fa-ban',
            self::KHO_USER => 'fa fa-bookmark-o',
            self::EXAM_ERROR => 'fa fa-exclamation'
        ];
    }

    public function getFileExam()
    {
        $path = 'https://docs.google.com/gview?url=' . $_SERVER['SERVER_NAME'] . $this->file_exam . '&embedded=true';

        return $path;
    }

    public function getFileAnswer()
    {
        $path = 'https://docs.google.com/gview?url=' . $_SERVER['SERVER_NAME'] . $this->file_answer . '&embedded=true';

        return $path;
    }

    public function getExtensionImg()
    {
        $extension = str_replace('.', '', substr($this->file_exam, -4));

        $img = '/uploads/advertises/icon-' . $extension . '.png';

        return $img;
    }

    public function getPrice()
    {
        return $this->price ? number_format($this->price, '0', ',', '.') . ' đ' : 'Miễn phí';
    }

    public function getPriceBg()
    {
        return $this->price ? '#ff9600' : '#5aab61';
    }

    public function getTimesExam()
    {
        return Room::find()->where(['exam_id' => $this->id])->count();
    }

    public function timeToMinutes()
    {
        $arr = explode(':', $this->time);
        $min = ($arr[0] * 60) + ($arr[1]) + ($arr[2] > 30 ? 1 : 0);
        return $min;
    }
}