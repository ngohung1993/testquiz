<?php

namespace backend\controllers;

use common\models\AuditLog;
use common\models\base\Classroom;
use common\models\Category;
use common\models\Exam;
use common\models\Subject;
use common\models\Topic;
use common\models\TransactionHistory;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\models\LoginForm;
use common\models\SignupForm;
use common\helpers\ServiceHelper;

/**
 * Site controller
 */
class SiteController extends Controller {
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => [ 'index', 'logout', 'signup' ],
				'rules' => [
					[
						'actions' => [ 'signup' ],
						'allow'   => true,
						'roles'   => [ '?' ],
					],
					[
						'actions' => [ 'index', 'logout', 'profile' ],
						'allow'   => true,
						'roles'   => [ '@' ],
					]
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() {
        $now = date('Y-m-d H:i', time());
        $year = date('Y');
        $day = date('Y-m-d');

        $topics = Topic::find()->where(['<>','status',Topic::KHO_USER])->andWhere(['active'=> Topic::ACTIVE])->all();
        $exams = Exam::find()->joinWith('topic')->where(['topic.active'=> Topic::ACTIVE])->andWhere(['<>','exam.status',Exam::KHO_USER])->all();

        $arrayCurrentYear = [];
        $arrayLastYear = [];

        $currentYear = $this->totalMoneyMonth($year);
        $lastYear = $this->totalMoneyMonth($year - 1);

        $arrayCurrentYear = $this->getMonth($arrayCurrentYear);
        $arrayLastYear = $this->getMonth($arrayLastYear);

        $arrayCurrentYear = $this->arrayMoneyYear($currentYear,$arrayCurrentYear);
        $arrayLastYear = $this->arrayMoneyYear($lastYear,$arrayLastYear);

        $totalMoneyCurrentYear = $this->totalMoneyYear($currentYear);
        $totalMoneyLastYear = $this->totalMoneyYear($lastYear);

        $totalMoneyDay = $this->getMoneyDay($day);

        $user = User::find()->where(['permission'=>  User::ROLE_USER])->all();
        $category = Category::find()->where(['type'=> 1])->all();

        $topUserBuyExam = $this->topUserBuyOrSellExam(5, TransactionHistory::BY_EXAM);
        $topUserSellExam = $this->topUserBuyOrSellExam(5, TransactionHistory::SELL_EXAM);
        $topUserRecharge = $this->topUserRechargeOrWithdrawal(5, TransactionHistory::RECHARGE);
        $topUserWithdrawal = $this->topUserRechargeOrWithdrawal(5, TransactionHistory::WITHDRAWAL);

        $arrayBuyExamYear = [];
        $arrayBuyExamLastYear = [];

        $buyExamYear = $this->totalExamBuyOrSellMonth(TransactionHistory::BY_EXAM, $year);
        $buyExamLastYear = $this->totalExamBuyOrSellMonth(TransactionHistory::BY_EXAM, $year-1);

        $arrayBuyExamYear = $this->getMonthExam($arrayBuyExamYear, TransactionHistory::BY_EXAM);
        $arrayBuyExamLastYear = $this->getMonthExam($arrayBuyExamLastYear, TransactionHistory::BY_EXAM);

        $arrayBuySellExamYear = $this->countTotalExamByOrSell($buyExamYear,$arrayBuyExamYear);
        $arrayBuySellExamLastYear = $this->countTotalExamByOrSell($buyExamLastYear,$arrayBuyExamLastYear);

        $countExamYear = $this->countExamYearOrLastYear($year);
        $countExamLastYear = $this->countExamYearOrLastYear($year-1);
        $countExamDay = TransactionHistory::find()
            ->where(['OR', ['=', 'type', TransactionHistory::SELL_EXAM], ['=', 'type', TransactionHistory::BY_EXAM]])
            ->andWhere(['time'=> $day])
            ->count();

        return $this->render( 'index',[
            'user' => $user,
            'year'=> $year,
            'exams' => $exams,
            'topics' => $topics,
            'category' => $category,
            'countExamYear' => $countExamYear,
            'countExamLastYear' => $countExamLastYear,
            'countExamDay' => $countExamDay,
            'arrayCurrentYear' => $arrayCurrentYear,
            'arrayLastYear' => $arrayLastYear,
            'arrayBuySellExamYear' => $arrayBuySellExamYear,
            'arrayBuySellExamLastYear' => $arrayBuySellExamLastYear,
            'totalMoneyDay' =>$totalMoneyDay,
            'topUserBuyExam' => $topUserBuyExam,
            'topUserRecharge' => $topUserRecharge,
            'topUserWithdrawal'=> $topUserWithdrawal,
            'topUserSellExam' => $topUserSellExam,
            'totalMoneyLastYear' => $totalMoneyLastYear,
            'totalMoneyCurrentYear'=> $totalMoneyCurrentYear,
        ]);
	}

    /**
     * @param $year
     * @return int|string
     */
	private function countExamYearOrLastYear($year)
    {
        $query = TransactionHistory::find()
            ->where(['OR', ['=', 'type', TransactionHistory::SELL_EXAM], ['=', 'type', TransactionHistory::BY_EXAM]])
            ->andWhere('YEAR(time)= '.$year)
            ->count();

        return $query;
    }

    /**
     * @param $year
     * @param $array
     * @return mixed
     */
	private function countTotalExamByOrSell($year, $array)
    {
        foreach ($year as $key => $value) {
            $array[$this->getMonthOfTime($value['time'])][$value['type']]++;
        }
        return $array;
    }

    /**
     * @param $limit
     * @param $type
     * @return array|\yii\db\ActiveRecord[]
     */
	private function topUserRechargeOrWithdrawal($limit,$type)
    {
        $query = TransactionHistory::find()
            ->joinWith('user')
            ->where(['transaction_history.type'=> $type])
            ->select(['SUM(amount) as tong', 'user_id'])
            ->groupBy('user_id')
            ->asArray()
            ->orderBy('tong DESC')
            ->limit($limit)
            ->all();

        return $query;
    }
    /**
     * @param $limit
     * @param $type
     * @return array|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]|null
     */
	private function topUserBuyOrSellExam($limit,$type)
    {
        $query = TransactionHistory::find()
            ->joinWith('user')
            ->where(['transaction_history.type'=> $type])
            ->select(['COUNT(user_id)', 'user_id'])
            ->groupBy('transaction_history.user_id');
        if ($limit) {
            $query->limit($limit);
        }
        return $limit == 1 ? $query->one() : $query->orderBy('COUNT(user_id) DESC')->all();
    }

    /**
     * @param $year
     * @return array|\yii\db\ActiveRecord[]
     */
	private function totalMoneyMonth($year){
        $transaction = TransactionHistory::find()
            ->where(['status'=> TransactionHistory::SUCCESS])
            ->andWhere(['type'=> TransactionHistory::RECHARGE])
            ->andWhere('YEAR(time)= '.$year)
            ->all();
        return $transaction;
    }

    /**
     * @param $type
     * @param $year
     * @return array|\yii\db\ActiveRecord[]
     */
    private function totalExamBuyOrSellMonth($type, $year){
        $transaction = TransactionHistory::find()
            ->where(['status'=> TransactionHistory::SUCCESS])
            ->andWhere(['type'=> $type])
            ->andWhere('YEAR(time)= '.$year)
            ->all();
        return $transaction;
    }
    /**
     * @param $year
     * @return int
     */
    private function totalMoneyYear($year)
    {
        $total = 0;
        foreach ($year as $key => $value){
            $total += $value['amount'];
        }
        return $total;
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
     * @param $day
     * @return int|mixed
     */
    private function getMoneyDay($day){
        $totalMoney = 0;
        $data =  TransactionHistory::find()
            ->where(['status'=> TransactionHistory::SUCCESS])
            ->andWhere(['type'=> TransactionHistory::RECHARGE])
            ->andWhere(['time' => $day])
            ->all();

        foreach ($data as $key => $value) {
            $totalMoney += $value['amount'];
        }
        return $totalMoney;
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
     * @param $array
     * @return mixed
     */
    private function getMonthExam($array, $type){
        for ($month = 1; $month <= 12; $month++) {
            $array[$month][$type] = 0;
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
	 * @throws NotFoundHttpException
	 */
	public function actionProfile() {
		$model = new SignupForm();

		$user = null;

		if ( ! Yii::$app->user->isGuest ) {
			$user = $this->findModel( Yii::$app->user->identity->getId() );
		}

		$model->name = $user['name'];
		$model->phone      = $user['phone'];
		$model->address    = $user['address'];

		$model->username = $user['username'];
		$model->email    = $user['email'];

		if ( $model->load( Yii::$app->request->post() ) ) {

			$user['name'] = $model->name;
			$user['phone']      = $model->phone;
			$user['address']    = $model->address;

			$user->save();

			$this->refresh();
		}

		return $this->render( 'profile', [
			'model' => $model,
			'user'  => $user
		] );
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin() {
		$this->layout = 'login';
		if ( ! Yii::$app->user->isGuest ) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ( $model->load( Yii::$app->request->post() ) && $model->login() ) {

			$log = ServiceHelper::get_logs();

			$user = User::findByUsername( $model->username );

			$audit_log = new AuditLog();

			$audit_log->browser = $log['browser'];
			$audit_log->ip      = $log['ip'];
			$audit_log->user_id = $user->id;
			$audit_log->time    = $log['time'];

			$audit_log->save();

			return $this->goBack();
		} else {
			return $this->render( 'login', [
				'model' => $model,
			] );
		}
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout() {
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	private function findModel( $id ) {
		if ( ( $model = User::findOne( $id ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The requested page does not exist . ' );
		}
	}
}
