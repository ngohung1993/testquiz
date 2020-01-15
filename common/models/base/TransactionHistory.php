<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "transaction_history".
 *
 * @property int $id
 * @property string $images
 * @property string $code
 * @property int $amount
 * @property string $message
 * @property int $status
 * @property int $type
 * @property string $note
 * @property int $user_id
 * @property int $account_id
 * @property string $time
 * @property int $created_at
 * @property int $updated_at
 * @property int $exam_id
 *
 * @property AccountBank $account
 * @property Exam $exam
 * @property User $user
 */
class TransactionHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'status', 'type', 'user_id', 'account_id', 'created_at', 'updated_at', 'exam_id'], 'integer'],
            [['message'], 'string'],
            [['user_id'], 'required'],
            [['time'], 'safe'],
            [['images', 'code', 'note'], 'string', 'max' => 255],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccountBank::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['exam_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exam::className(), 'targetAttribute' => ['exam_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'images' => 'Images',
            'code' => 'Code',
            'amount' => 'Amount',
            'message' => 'Message',
            'status' => 'Status',
            'type' => 'Type',
            'note' => 'Note',
            'user_id' => 'User ID',
            'account_id' => 'Account ID',
            'time' => 'Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'exam_id' => 'Exam ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(AccountBank::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExam()
    {
        return $this->hasOne(Exam::className(), ['id' => 'exam_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
