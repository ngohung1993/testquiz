<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Utilities */

$this->title = 'Create Utilities';
$this->params['breadcrumbs'][] = ['label' => 'Utilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
