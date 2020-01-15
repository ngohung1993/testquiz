<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 9/8/2018
 * Time: 4:15 PM
 */

use common\helpers\FunctionHelper;

?>

<ul class="theme-editor-action-list theme-editor-action-list--divided theme-editor-action-list--rounded">
    <?php foreach (FunctionHelper::get_custom_fields_by_parent_id(null,1) as $key => $value): ?>
        <li title="<?= $value['title'] ?>">
            <button class="btn theme-editor-action-list__item" type="button"
                    onclick="editor.main.open_section(<?= $value['id'] ?>)">
            <span class="ui-stack ui-stack--alignment-center ui-stack--spacing-none">
                <span class="ui-stack-item stacked-menu__item-icon stacked-menu__item-icon--small">
                    <span class="theme-editor__icon">
                        <span class="<?= $value['icon'] ?>"></span>
                    </span>
                </span>
                <span class="ui-stack-item ui-stack-item--fill stacked-menu__item-text">
                    <?= $value['title'] ?>
                </span>
            </span>
            </button>
        </li>
    <?php endforeach; ?>
</ul>