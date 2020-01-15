<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 11/14/2018
 * Time: 3:25 PM
 */

/* @var $children common\models\CustomField */

?>

<button type="button" class="btn btn--plain btn-replace-image" style="float: right;"
        onclick="editor.main.copy_custom_field(<?= $children['id'] ?>,event)" title="Sao chép">
    <span class="fa fa-copy"></span>
</button>
<button type="button" class="btn btn--plain btn-replace-image btn-trash"
        title="Xóa" onclick="editor.main.delete_custom_field(<?= $children['id'] ?>,event)">
    <span class="fa fa-trash"></span>
</button>