<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 5/31/2018
 * Time: 3:42 PM
 */

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = Yii::t( 'backend', 'Library' );

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item active">Thư viện</li>
    </ol>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <iframe width="100%" height="450" frameborder="0"
                    src="/uploads/library/filemanager/dialog.php">
            </iframe>
        </div>
    </div>
</div>