<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 11/5/2018
 * Time: 3:29 PM
 */

/* @var $this \yii\web\View */

?>

<style>
    .modal-header {
        padding: 1rem;
    }

    .modal-header .close {
        margin: -1rem -1rem -1rem auto;
    }
</style>

<div class="modal" id="content-form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa nội dung</h4>
            </div>
            <div class="modal-body">
                <div class="form">
                    <div class="form-body">
                        <input title="" type="hidden" id="custom-field-id">
                        <textarea title="" name="" id="content" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-actions row" style="margin-bottom: 0;">
                    <div class="col-sm-5 pull-right text-right">
                        <button class="btn btn-default btn-back close-modal" type="button" style="color: #fff;"
                                onclick="editor.main.update_content_custom_field()">
                            <span class="fa fa-check"></span>
                            Cập nhật
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>