<?php

namespace common\models;

use yii\base\Model;

class TopicSearch extends Model
{
    public $id;
    public $title;
    public $key_name;
    public $status;
    public $active;

    public function rules()
    {
        return [
            [['active','status'], 'integer'],
            [['key_name','title','id'], 'string'],
        ];
    }

}