<?php

/* @var $this yii\web\View */

$user = Yii::$app->user->identity;
$this->title = 'Trang giới thiệu';
$this->registerJsFile('@web/theme/js/function-js.min.js');
$this->registerJsFile('@web/components/tinymce/tinymce.min.js');
$this->registerJsFile('@web/create-exam/js/create.js');
?>
<link rel="stylesheet" href="/theme/css/bootstrap.min.css">
<script src="/theme/js/jquery-3.3.1.min.js"></script>
<script src="/theme/js/bootstrap.min.js"></script>
<div class="col-sm-9">
    <div class="tab-content">
        <h3 class="ad_user_name" style="margin-top: -30px">Giới thiệu về bản thân</h3>
        <div class="content_user_info">
            <div class="info_user_cnt" style="margin: 0 50px; width: 85%">
                <div class="edit_from_user">
                    <div class="title_user_info">
                        <?= $user['description'] ?>
                        <a href="javascript:;" class="icon_edit_title filter fa fa-pencil-square-o"
                           data-toggle="modal"
                           data-target="#myModal" style="font-size: 15px">
                            Sửa
                        </a>
                    </div>
                    <div class="user_result">
                        <h3 class="ad_user_name edit_name"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #1fb6ff ;color: #fff">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-size: 18px;text-align: center">Giới Thiệu Bản Thân</h4>
            </div>
            <div class="modal-body" style="font-size: 18px">
                <textarea name="" id="introduce" cols="30" rows="10">
                    <?= $user['description'] ?>
                </textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" style="background-color: #1fb6ff "
                        onclick="save_description_in_user()">Lưu
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    .tox-statusbar {
        display: none !important;
    }

    @media (max-width: 768px) {
        .ad_user_name{
            margin-top: 0!important;
        }
    }
    .hidden{display:none;}
</style>