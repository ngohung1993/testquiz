<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class Message extends base\Message
{
    const SEND_ADMIN = 0;
    const SEND_USER = 1;
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
    public function cutString($string='',$size=50,$link='...')
    {
        $string = strip_tags(trim($string));
        $strlen = strlen($string);
        $str = substr($string,$size,20);
        $exp = explode(" ",$str);
        $sum =  count($exp);
        $yes= "";
        for($i=0;$i<$sum;$i++)
        {
            if($yes==""){
                $a = strlen($exp[$i]);
                if($a==0){ $yes="no"; $a=0;}
                if(($a>=1)&&($a<=12)){ $yes = "no"; $a;}
                if($a>12){ $yes = "no"; $a=12;}
            }
        }
        $sub = substr($string,0,$size+$a);
        if($strlen-$size>0){ $sub.= $link;}
        return $sub;
    }
}
