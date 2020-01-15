<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 9/8/2018
 * Time: 4:31 PM
 */

use common\models\CustomField;
use common\helpers\FunctionHelper;

?>

<style>
    .ui-select:focus {
        border: none;
    }

    .next-card {
        position: relative;
    }
</style>

<div>
    <?php foreach (FunctionHelper::get_custom_fields() as $key => $component): ?>
        <div class="theme-editor__panel" id="panel-<?= $component['id'] ?>" tabindex="-1">
            <header class="te-panel__header">
                <button class="ui-button btn--plain te-panel__header-action"
                        onclick="editor.main.close_section()" type="button">
                    <span class="fa fa-chevron-left"></span>
                </button>
                <h2 class="ui-heading theme-editor__heading"><?= $component['title'] ?></h2>
            </header>
            <div class="theme-editor__panel-body">
                <?php if ($component['type'] == CustomField::TYPE_SETTING): foreach (FunctionHelper::get_custom_fields_by_parent_id($component['id'], 1) as $children) : ?>
                    <section class="next-card theme-editor__card">
                        <section class="next-card__section">
                            <header class="next-card__header theme-setting theme-setting--header">
                                <h3 class="ui-subheading">
                                    <?= $children['title'] ?>
                                </h3>
                                <?php if ($children['description']): ?>
                                    <br>
                                    <span class="next-input__help-text">
                                    <?= $children['description'] ?>
                                </span>
                                <?php endif; ?>
                            </header>
                            <?php foreach (FunctionHelper::get_custom_fields_by_parent_id($children['id']) as $attribute): ?>
                                <?php if ($attribute['type'] == CustomField::TYPE_IMAGE): ?>
                                    <div class="theme-setting theme-setting--checkbox">
                                        <div class="next-input-wrapper">
                                            <div class="checkbox">
                                                <input title="" class="minimal" type="checkbox"
                                                       value="<?= $attribute['status'] ?>"
                                                       onchange="editor.main.override_theme_editor('<?= $attribute['key'] . '--status' ?>','type-checkbox',this)"
                                                       data-start-value="<?= $attribute['status'] ?>"
                                                       data-origin-value="<?= $attribute['status'] ?>"
                                                       id="custom-field-<?= $attribute['key'] ?>-status" <?= $attribute['status'] ? 'checked' : '' ?>>
                                                <label class="next-label next-label--switch">
                                                    Dùng <?= strtolower($attribute['title']) ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="theme-setting theme-setting--image">
                                        <label class="next-label">
                                            <?= $attribute['title'] ?>
                                        </label>
                                        <div class="next-grid next-grid--no-padding next-grid--vertically-centered">
                                            <div class="next-grid__cell theme-setting__image-preview">
                                                <div class="next-grid next-grid--no-padding next-grid--center-aligned next-grid--vertically-centered theme-setting__image-wrapper">
                                                    <div class="next-grid__cell next-grid__cell--no-flex"
                                                         style="background-color:#fafbfc;border: 1px solid #e6e8ea">
                                                        <img src="<?= $attribute['value'] ?>" style="width:100%"
                                                             id="custom-field-<?= $attribute['key'] ?>"
                                                             onchange="editor.main.override_theme_editor('<?= $attribute['key'] ?>--value','type-image',this)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="next-grid__cell">
                                                <div data-image-actions="" style="display:block;">
                                                    <a style="background: #fff!important;-webkit-appearance: none;"
                                                       href="/uploads/library/filemanager/dialog.php?type=1&field_id=custom-field-<?= $attribute['key'] ?>&relative_url=1"
                                                       class="btn btn--plain btn-replace-image thumbnail-custom-field-<?= $attribute['key'] ?> frame-btn"
                                                       type="button" name="button">
                                                        <span class="fa fa-edit"></span>
                                                        <span class="next-icon__text">Thay thế</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="next-input__help-text">
                                            <?= $attribute['description'] ?>
                                        </p>
                                        <div class="theme-setting theme-setting--text">
                                            <label class="next-label">
                                                Alt ảnh
                                            </label>
                                            <input title="" type="text" class="next-input"
                                                   onchange="editor.main.override_theme_editor('<?= $attribute['key'] . '--alt' ?>','type-text',this)"
                                                   id="custom-field-<?= $attribute['key'] ?>-alt"
                                                   data-start-value="<?= $attribute['alt'] ?>"
                                                   data-origin-value="<?= $attribute['alt'] ?>"
                                                   value="<?= $attribute['title'] ?>">
                                        </div>
                                        <div class="theme-setting theme-setting--text">
                                            <label class="next-label">
                                                Link
                                            </label>
                                            <input title="" type="text" class="next-input"
                                                   onchange="editor.main.override_theme_editor('<?= $attribute['key'] . '--link' ?>','type-text',this)"
                                                   id="custom-field-<?= $attribute['key'] ?>-link"
                                                   data-start-value="<?= $attribute['link'] ?>"
                                                   data-origin-value="<?= $attribute['link'] ?>"
                                                   value="<?= $attribute['link'] ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($attribute['type'] == CustomField::TYPE_CHECKBOX): ?>
                                    <div class="theme-setting theme-setting--checkbox">
                                        <div class="next-input-wrapper">
                                            <div class="checkbox">
                                                <input title="" type="checkbox" class="minimal"
                                                       onchange="editor.main.override_theme_editor('<?= $attribute['key'] ?>--status','type-checkbox',this)"
                                                       value="<?= $attribute['value'] ?>" <?= $attribute['status'] ? 'checked' : '' ?>
                                                       id="custom-field-<?= $attribute['key'] ?>-status">
                                                <label class="next-label next-label--switch">
                                                    <?= $attribute['title'] ?>
                                                </label>
                                                <?php if ($attribute['description']): ?>
                                                    <br>
                                                    <span class="next-input__help-text">
                                                    <?= $attribute['description'] ?>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($attribute['type'] == CustomField::TYPE_TEXT): ?>
                                    <div class="theme-setting theme-setting--text">
                                        <label class="next-label" for="setting-<?= $attribute['key'] ?>">
                                            <?= $attribute['title'] ?>
                                        </label>
                                        <input title="" type="text" class="next-input"
                                               onchange="editor.main.override_theme_editor('<?= $attribute['key'] ?>--value','type-text',this)"
                                               id="custom-field-<?= $attribute['key'] ?>-value"
                                               data-start-value="<?= $attribute['value'] ?>"
                                               data-origin-value="<?= $attribute['value'] ?>"
                                               value="<?= $attribute['value'] ?>">
                                    </div>
                                    <?php if ($attribute['description']): ?>
                                        <div class="next-input-wrapper theme-editor__settings__paragraph">
                                            <p>
                                                <?= $attribute['description'] ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($attribute['type'] == CustomField::TYPE_SELECT && $children['key'] == 'home-page-section'): ?>
                                    <div class="theme-setting theme-setting--text">
                                        <label class="next-label" for="setting-<?= $attribute['key'] ?>">
                                            <?= $attribute['title'] ?>
                                        </label>
                                        <div class="next-input-wrapper">
                                            <div class="ui-select__wrapper next-input--has-content">
                                                <select title="" id="setting-home-section" class="ui-select valid"
                                                        onchange="editor.main.override_theme_editor('<?= $attribute['key'] ?>--value','type-select',this)">
                                                    <option value="" selected="">
                                                        Không dùng
                                                    </option>
                                                    <?php foreach (FunctionHelper::get_custom_field_by_type(CustomField::TYPE_SECTION) as $key => $value): ?>
                                                        <option <?= $value['id'] == $attribute['value'] ? 'selected' : '' ?>
                                                                value="<?= $value['id'] ?>">
                                                            <?= $value['title'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <svg class="next-icon next-icon--size-12">
                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                         xlink:href="#next-chevron-down"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </section>
                    </section>
                <?php endforeach; endif; ?>
                <?php foreach (FunctionHelper::get_custom_fields_by_parent_id($component['id']) as $children): if ($children['type'] == CustomField::TYPE_SECTION) : ?>
                    <section class="next-card theme-editor__card">
                        <section class="next-card__section">
                            <header class="next-card__header theme-setting theme-setting--header">
                                <h3 class="ui-subheading">
                                    <?= $children['title'] ?>
                                </h3>
                            </header>
                            <div class="theme-setting theme-setting--checkbox">
                                <div class="next-input-wrapper">
                                    <div class="checkbox" id="setting-checkbox-<?= $children['key'] ?>-enable">
                                        <input title="" type="checkbox"
                                               onchange="editor.main.override_theme_editor('<?= $children['key'] ?>-description','text-checkbox',this)"
                                               class="minimal" <?= $children['status'] ? 'checked' : '' ?>
                                               value="<?= $children['title'] ?>"
                                               data-start-value="<?= $children['title'] ?>"
                                               data-origin-value="<?= $children['title'] ?>"
                                               id="setting-<?= $children['key'] ?>-enable">
                                        <label class="next-label next-label--switch">
                                            Hiển thị phần này
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-setting theme-setting--image">
                                <label class="next-label" for="setting-logo_png">
                                    Ảnh đại diện
                                </label>
                                <div class="next-grid next-grid--no-padding next-grid--vertically-centered"
                                     data-image-picker="">
                                    <div class="next-grid__cell theme-setting__image-preview">
                                        <div class="next-grid next-grid--no-padding next-grid--center-aligned next-grid--vertically-centered theme-setting__image-wrapper">
                                            <div class="next-grid__cell next-grid__cell--no-flex"
                                                 style="background-color:#fafbfc;border: 1px solid #e6e8ea">
                                                <img src="<?= $children['avatar'] ?>" style="width:100%"
                                                     id="img-setting-<?= $children['key'] ?>-png"
                                                     onchange="editor.main.override_theme_editor('<?= $children['key'] ?>--avatar','type-image',this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="next-grid__cell">
                                        <div data-image-actions="" style="display:block;">
                                            <a style="background: #fff!important;-webkit-appearance: none;"
                                               href="/uploads/library/filemanager/dialog.php?type=1&field_id=img-setting-<?= $children['key'] ?>-png&relative_url=1"
                                               class="btn btn--plain btn-replace-image thumbnail-img-setting-<?= $children['key'] ?>-png frame-btn"
                                               type="button" name="button">
                                                <span class="fa fa-sign-out"></span>
                                                <span class="next-icon__text">Thay thế</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="theme-setting theme-setting--text">
                                    <label class="next-label" for="<?= $children['key'] ?>-title">
                                        Tiêu đề
                                    </label>
                                    <input title="" type="text" class="next-input"
                                           onchange="editor.main.override_theme_editor('<?= $children['key'] ?>--title','type-text',this)"
                                           id="<?= $children['key'] ?>-title"
                                           data-start-value="<?= $children['title'] ?>"
                                           data-origin-value="<?= $children['title'] ?>"
                                           value="<?= $children['title'] ?>">
                                </div>
                                <div class="theme-setting theme-setting--text">
                                    <label class="next-label" for="<?= $children['key'] ?>-description">
                                        Mô tả
                                    </label>
                                    <textarea name="" id="<?= $children['key'] ?>-description" cols="30"
                                              onchange="editor.main.override_theme_editor('<?= $children['key'] ?>--description','type-text',this)"
                                              data-start-value="<?= $children['description'] ?>"
                                              data-origin-value="<?= $children['description'] ?>"
                                              rows="10"><?= $children['description'] ?></textarea>
                                </div>
                                <div class="theme-setting theme-setting--text">
                                    <label class="next-label" for="<?= $children['key'] ?>-frame">
                                        Mã nhúng (nếu có)
                                    </label>
                                    <textarea name="" id="<?= $children['key'] ?>-frame" cols="30"
                                              onchange="editor.main.override_theme_editor('<?= $children['key'] ?>--frame','type-text',this)"
                                              data-start-value="<?= $children['frame'] ?>"
                                              data-origin-value="<?= $children['frame'] ?>"
                                              rows="10"><?= $children['frame'] ?></textarea>
                                </div>
                                <div class="theme-setting theme-setting--text">
                                    <label class="next-label" for="setting-<?= $children['key'] ?>">
                                        Nội dung
                                    </label>
                                    <div data-image-actions="" style="display:block;text-align: center;">
                                        <a href="" style="background: #fff!important;-webkit-appearance: none;"
                                           onclick="editor.main.get_custom_field(<?= $children['id'] ?>)"
                                           class="btn btn--plain btn-replace-image" data-toggle="modal"
                                           data-target="#content-form"
                                           type="button" name="button">
                                            <span class="fa fa-edit"></span>
                                            <span class="next-icon__text">Chỉnh sửa nội dung</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php foreach (FunctionHelper::get_custom_fields_by_parent_id($children['id']) as $section): ?>
                            <section class="next-card theme-editor__card" style="margin:10px 5px;">
                                <section class="next-card__section">
                                    <header class="next-card__header theme-setting theme-setting--header">
                                        <h3 class="ui-subheading">
                                            <?= $section['title'] ?>
                                        </h3>
                                    </header>
                                    <div class="theme-setting theme-setting--checkbox">
                                        <div class="next-input-wrapper">
                                            <div class="checkbox" id="setting-checkbox-<?= $section['key'] ?>-enable">
                                                <input title="" type="checkbox"
                                                       class="minimal" <?= $section['status'] ? 'checked' : '' ?>
                                                       value="<?= $section['title'] ?>"
                                                       data-start-value="<?= $section['title'] ?>"
                                                       data-origin-value="<?= $section['title'] ?>"
                                                       id="setting-<?= $section['key'] ?>-enable">
                                                <label class="next-label next-label--switch">
                                                    Hiện phần này
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="theme-setting theme-setting--image">
                                        <label class="next-label" for="setting-logo_png">
                                            Ảnh đại diện
                                        </label>
                                        <div class="next-grid next-grid--no-padding next-grid--vertically-centered"
                                             data-image-picker="">
                                            <div class="next-grid__cell theme-setting__image-preview">
                                                <div class="next-grid next-grid--no-padding next-grid--center-aligned next-grid--vertically-centered theme-setting__image-wrapper">
                                                    <div class="next-grid__cell next-grid__cell--no-flex"
                                                         style="background-color:#fafbfc;border: 1px solid #e6e8ea">
                                                        <img src="<?= $section['avatar'] ?>" style="width:100%"
                                                             id="img-setting-<?= $section['key'] ?>-png"
                                                             onchange="editor.main.override_theme_editor('<?= $section['key'] ?>--avatar','type-image',this)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="next-grid__cell">
                                                <div data-image-actions="" style="display:block;">
                                                    <a style="background: #fff!important;-webkit-appearance: none;"
                                                       href="/uploads/library/filemanager/dialog.php?type=1&field_id=img-setting-<?= $section['key'] ?>-png&relative_url=1"
                                                       class="btn btn--plain btn-replace-image thumbnail-img-setting-<?= $section['key'] ?>-png frame-btn"
                                                       type="button" name="button">
                                                        <span class="fa fa-sign-out"></span>
                                                        <span class="next-icon__text">Thay thế</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="theme-setting theme-setting--text">
                                            <label class="next-label" for="<?= $section['key'] ?>-title">
                                                Tiêu đề
                                            </label>
                                            <input title="" type="text" class="next-input"
                                                   onchange="editor.main.override_theme_editor('<?= $section['key'] ?>--title','type-text',this)"
                                                   id="<?= $children['key'] ?>-title"
                                                   data-start-value="<?= $section['title'] ?>"
                                                   data-origin-value="<?= $section['title'] ?>"
                                                   value="<?= $section['title'] ?>">
                                        </div>
                                        <div class="theme-setting theme-setting--text">
                                            <label class="next-label" for="<?= $section['key'] ?>-description">
                                                Mô tả
                                            </label>
                                            <textarea name="" id="<?= $section['key'] ?>-description" cols="30"
                                                      onchange="editor.main.override_theme_editor('<?= $section['key'] ?>--description','type-text',this)"
                                                      data-start-value="<?= $section['description'] ?>"
                                                      data-origin-value="<?= $section['description'] ?>"
                                                      rows="10"><?= $section['description'] ?></textarea>
                                        </div>
                                        <div class="theme-setting theme-setting--text">
                                            <label class="next-label" for="<?= $section['key'] ?>-frame">
                                                Mã nhúng (nếu có)
                                            </label>
                                            <textarea name="" id="<?= $section['key'] ?>-frame" cols="30"
                                                      onchange="editor.main.override_theme_editor('<?= $section['key'] ?>--frame','type-text',this)"
                                                      data-start-value="<?= $section['frame'] ?>"
                                                      data-origin-value="<?= $section['frame'] ?>"
                                                      rows="10"><?= $section['frame'] ?></textarea>
                                        </div>
                                        <div class="theme-setting theme-setting--text">
                                            <label class="next-label" for="setting-<?= $section['key'] ?>">
                                                Nội dung
                                            </label>
                                            <div style="display:block;text-align: center;">
                                                <a href="" style="background: #fff!important;-webkit-appearance: none;"
                                                   onclick="editor.main.get_custom_field(<?= $section['id'] ?>)"
                                                   class="btn btn--plain btn-replace-image" data-toggle="modal"
                                                   data-target="#content-form">
                                                    <span class="fa fa-files-o"></span>
                                                    <span class="next-icon__text">Chỉnh sửa nội dung</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        <?php endforeach; ?>
                    </section>
                    <hr class="theme-editor__panel-separator">
                <?php endif; endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>