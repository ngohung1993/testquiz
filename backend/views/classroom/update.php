<?php

use yii\helpers\Url;
use common\models\Subject;
use common\models\Classroom;
use common\models\ClassroomDetail;

/* @var $this yii\web\View */
/* @var $subjects Subject */
/* @var $model Classroom */
/* @var $classroomDetailTopic  */
/* @var $seo \common\models\SeoTool */
/* @var $classroomDetails ClassroomDetail
   @var $seo common\models\SeoTool
 */

$this->title = Yii::t('app', 'Chỉnh sửa');

?>
<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to(['classroom/index']) ?>">Danh sách lớp</a></li>

        <li class="breadcrumb-item active">Chỉnh sửa</li>
    </ol>
    <div class="clearfix"></div>

    <?= $this->render('__form', [
        'model' => $model,
        'subjects' => $subjects,
        'classroomDetails' => $classroomDetails,
        'seo' => $seo,
        'classroomDetailTopic' => $classroomDetailTopic
    ]) ?>
</div>
