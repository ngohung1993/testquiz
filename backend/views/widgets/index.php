<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\base\WidgetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Widgets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widgets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Widgets', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'position',
            'background_color',
            'title_color',
            'text_color',
            //'button_color',
            //'button_text',
            //'title',
            //'description',
            //'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
