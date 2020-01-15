<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 11/5/2018
 * Time: 3:29 PM
 */

use common\helpers\FunctionHelper;

/* @var $this \yii\web\View */

?>

<style>
    .dd3-content .show-item-details {
        background-color: #ccc;
        right: 0 !important;
        left: unset;
        line-height: 30px;
        position: absolute;
        text-align: center;
        top: 0;
        width: 30px;
        color: #000;
        border-left: 1px solid #aaa;
    }
</style>

<div class="modal" id="sort-form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thay đổi thứ tự thành phần</h4>
                <button class="close close-modal" type="button">×</button>
            </div>
            <div class="modal-body">
                <div class="dd" id="tree-5aa383cc537d1">
                    <?php FunctionHelper::show_components_nestable(FunctionHelper::get_components_by_parent_id()) ?>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-actions row" style="margin-bottom: 0;">
                    <div class="col-sm-5 pull-right text-right">
                        <button class="btn btn-default btn-back close-modal" type="button">
                            <span class="fa fa-check"></span>
                            Cập nhật
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>