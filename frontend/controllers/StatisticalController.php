<?php

namespace frontend\controllers;

use common\models\TransactionHistory;
use frontend\controllers\base\BaseController;

class StatisticalController extends BaseController
{
    public function actionIndex()
    {
        $this->layout = 'profile';
        $year = date('Y');
        $day = date('Y-m-d');

        $arraySellExam = [];
        $arrayBuyExam = [];
        $arrayRecharge = [];
        $arrayWithdrawal = [];

        $sellExam = $this->totalMoneyMonth($year, TransactionHistory::BY_EXAM);
        $buyExam = $this->totalMoneyMonth($year, TransactionHistory::SELL_EXAM);
        $recharge = $this->totalMoneyMonth($year, TransactionHistory::RECHARGE);
        $withdrawal = $this->totalMoneyMonth($year, TransactionHistory::WITHDRAWAL);

        $arraySellExam = $this->getMonth($arraySellExam);
        $arrayBuyExam = $this->getMonth($arrayBuyExam);
        $arrayRecharge = $this->getMonth($arrayRecharge);
        $arrayWithdrawal = $this->getMonth($arrayWithdrawal);

        $arraySellExam = $this->arrayMoneyYear($sellExam,$arraySellExam);
        $arrayBuyExam = $this->arrayMoneyYear($buyExam,$arrayBuyExam);
        $arrayRecharge = $this->arrayMoneyYear($recharge,$arrayRecharge);
        $arrayWithdrawal = $this->arrayMoneyYear($withdrawal,$arrayWithdrawal);

        $topExam = $this->topExamBuy(10);

        return $this->render('index',[
            'year' => $year,
            'topExam' => $topExam,
            'arraySellExam' => $arraySellExam,
            'arrayBuyExam' => $arrayBuyExam,
            'arrayRecharge' => $arrayRecharge,
            'arrayWithdrawal' => $arrayWithdrawal
        ]);
    }

    private function topExamBuy($limit)
    {
        $query = TransactionHistory::find()
            ->andWhere(['status'=> TransactionHistory::SUCCESS])
            ->andWhere(['type'=> TransactionHistory::SELL_EXAM])
            ->andWhere(['user_id' => $this->user->id])
            ->select(['COUNT(exam_id) as count','exam_id'])
            ->groupBy('exam_id');

        if ($limit) {
            $query->limit($limit);
        }
        return $limit == 1 ? $query->one() : $query->orderBy('count DESC')->all();
    }

    /**
     * @param $year
     * @param $array
     * @return mixed
     */
    private function arrayMoneyYear($year, $array)
    {
        foreach ($year as $key => $value) {
            $array[$this->getMonthOfTime($value['time'])] += $value['amount'];
        }
        return $array;
    }

    /**
     * @param $time
     * @return int
     */
    private function getMonthOfTime($time)
    {
        return (int)(date("m", strtotime($time)));
    }

    /**
     * @param $array
     * @return mixed
     */
    private function getMonth($array){
        for ($month = 1; $month <= 12; $month++) {
            $array[$month] = 0;
        }
        return $array;
    }

    /**
     * @param $year
     * @return array|\yii\db\ActiveRecord[]
     */
    private function totalMoneyMonth($year, $type){
        $transaction = TransactionHistory::find()
            ->where(['user_id'=> $this->user->id])
            ->andWhere(['status'=> TransactionHistory::SUCCESS])
            ->andWhere(['type'=> $type])
            ->andWhere('YEAR(time)= '.$year)
            ->all();
        return $transaction;
    }

}
