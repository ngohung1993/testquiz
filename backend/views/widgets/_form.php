<?php

use backend\assets\WidgetsAsset;

WidgetsAsset::register( $this );

/* @var $this yii\web\View */
/* @var $model common\models\Widgets */
/* @var $form yii\widgets\ActiveForm */

?>

<style>

    .color-palette-list {
        list-style: none;
        margin: -10px 0 0 -10px;
        padding: 0;
        overflow: hidden;
    }

    .color-palette-i {
        float: left;
        margin: 10px 0 0 10px;
        border-radius: 5px;
    }

    .custom-widget {
        position: relative;
        height: 36px;
    }

    .color-selector {
        position: absolute;
        top: 0;
        left: 0;
        width: 36px;
        height: 36px;
    }

    .color-selector div {
        position: absolute;
        top: 4px;
        left: 4px;
        width: 28px;
        height: 28px;
    }

</style>

<ul class="nav nav-tabs">
    <li class="active">
        <a href="#appearance" data-toggle="tab" aria-expanded="false">
            Appearance
        </a>
    </li>
    <li class="" style="border-left: 1px solid #ddd;">
        <a href="#tab_note" data-toggle="tab" aria-expanded="false">Thứ tự</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="appearance">
        <div class="dashboard-panel__body dashboard-panel__body_minheight">
            <div class="widget-editor__left widget-appearance">
                <div class="form-group form-group_sparse">
                    <label class="control-label">Position</label>
                    <ul class="layout-list">
                        <li class="layout-list__i">
                            <span class="layout-icon layout-icon_modal"></span>
                        </li>
                        <li class="layout-list__i">
                                <span class="layout-icon layout-icon_leftFlyby">
                                </span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_rightFlyby"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_topBar"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_bottomBar"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_leftSide"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_rightSide"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_bottomLeftPanel"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_bottomRightPanel layout-icon_active"></span>
                        </li>
                    </ul>
                </div>
                <div class="form-group form-group_sparse">
                    <fieldset class="style-color">
                        <div class="style-color__body">
                            <div class="style-color__colorpalette"><label class="control-label">Colors</label>
                                <div class="colorpalette">
                                    <ul class="color-palette-list">
                                        <li class="color-palette-i">
                                            <div class="custom-widget">
                                                <button type="button" class="btn btn_default-bis btn_xs btn_color">
                                                        <span id="color-selector-background"
                                                              class="btn-color-swatch color-selector"></span>
                                                    Background
                                                </button>
                                            </div>
                                        </li>
                                        <li class="color-palette-i">
                                            <div class="custom-widget">
                                                <button type="button" class="btn btn_default-bis btn_xs btn_color">
                                                        <span id="color-selector-header-text"
                                                              class="btn-color-swatch color-selector"></span>
                                                    Header text
                                                </button>
                                            </div>
                                        </li>
                                        <li class="color-palette-i">
                                            <div class="custom-widget">
                                                <button type="button" class="btn btn_default-bis btn_xs btn_color">
                                                        <span id="color-selector-text"
                                                              class="btn-color-swatch color-selector"></span>
                                                    Text
                                                </button>
                                            </div>
                                        </li>
                                        <li class="color-palette-i">
                                            <div class="custom-widget">
                                                <button type="button" class="btn btn_default-bis btn_xs btn_color">
                                                        <span id="color-selector-button"
                                                              class="btn-color-swatch color-selector"></span>
                                                    Button
                                                </button>
                                            </div>
                                        </li>
                                        <li class="color-palette-i">
                                            <div class="custom-widget">
                                                <button type="button" class="btn btn_default-bis btn_xs btn_color">
                                                        <span id="color-selector-button-text"
                                                              class="btn-color-swatch color-selector"></span>
                                                    Button text
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="clearfix"></div>
                <div class="form-group ng-isolate-scope">
                    <fieldset class="style-font">
                        <label class="control-label">Font</label>
                        <div class="select">
                            <select title="" class="form-control">
                                <option label="Helvetica Neue, Helvetica, Arial, sans-serif"
                                        value="string:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif"
                                        selected="selected">Helvetica Neue, Helvetica, Arial, sans-serif
                                </option>
                                <option label="Georgia, Times New Roman, Times, serif"
                                        value="string:Georgia, &quot;Times New Roman&quot;, Times, serif">Georgia,
                                    Times New Roman, Times, serif
                                </option>
                                <option label="Inherit" value="string:inherit">Inherit</option>
                            </select>
                            <span class="select__arrow"></span>
                        </div>
                    </fieldset>
                </div>
                <div class="form-group">
                    <fieldset class="style-animation">
                        <label class="control-label">Animation</label>
                        <div class="select">
                            <select title="" class="form-control" name="animation">
                                <option label="None" value="string:none">None</option>
                                <option label="Slide" value="string:slideIn" selected="selected">Slide</option>
                            </select>
                            <span class="select__arrow"></span>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="widget-editor__right widget-editor__right_pd">
                <div class="widget-preview">
                    <div class="desktop-preview">
                        <div class="desktop-preview__site-url ng-binding">chungcuhanoiplus.com</div>
                        <div class="preview-frame">
                            <iframe src="javascript:void(0)" frameborder="0"
                                    style="transform: scale(0.5); transform-origin: 0 0 0; width: 892px; height: 612px;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="tab_note">
        <div class="dashboard-panel__body dashboard-panel__body_minheight">
            <div class="widget-editor__left widget-text">
                <div class="form-group">
                    <label class="control-label">Position</label>
                    <ul class="layout-list">
                        <li class="layout-list__i">
                            <span class="layout-icon layout-icon_modal"></span>
                        </li>
                        <li class="layout-list__i">
                                <span class="layout-icon layout-icon_leftFlyby">
                                </span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_rightFlyby"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_topBar"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_bottomBar"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_leftSide"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_rightSide"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_bottomLeftPanel"></span>
                        </li>
                        <li class="layout-list__i ng-scope">
                            <span class="layout-icon layout-icon_bottomRightPanel layout-icon_active"></span>
                        </li>
                    </ul>
                </div>
                <div class="widget-contact-content">
                    <h4 class="form-heading">Form settings
                        <a role="button" class="form-heading__link">
                            Choose template
                            <b class="caret"></b>
                        </a>
                    </h4>
                    <div class="form-group">
                        <label class="control-label">Title</label>
                        <input title="" class="form-control" name="title" type="text">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea style="border-top: 1px solid #ddd;" title="" class="form-control"></textarea>
                    </div>
                    <div class="widget-contact-content__form-editor ">
                        <div class="form-editor">
                            <div class="form-group dropdown">
                                <a role="button" class="btn btn_default dropdown-toggle">
                                    + Add field
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-menu__i">
                                        <a class="dropdown-menu__a">
                                            Radio buttons
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-field-list">
                                <div class="ng-animate-enabled form-field-list__i form-field-list-animation">
                                    <div class="form-field-list__type form-field-type">
                                        <div class="form-field-type__title">
                                            <span class="form-field-type__caret caret"></span>
                                            Email
                                            <span class="form-field-type__divider"></span>
                                        </div>
                                        <div class="form-field-type__error-icon info-icon info-icon_error"></div>
                                        <div class="form-field-type__handle">
                                            <i class="fa fa-list-ol"></i>
                                        </div>
                                        <div class="form-field-type__dropdown">
                                            <a role="button" class="form-field-type__dropdown-toggle dropdown-toggle">
                                                <span class="fa fa-cog"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-menu__i">
                                                    <a tabindex="-1" role="menuitem" class="dropdown-menu__a">
                                                        Rename
                                                    </a>
                                                </li>
                                                <li class="dropdown-menu__i">
                                                    <a tabindex="-1" role="menuitem" class="dropdown-menu__a">
                                                        Clone
                                                    </a>
                                                </li>
                                                <li class="dropdown-menu__i">
                                                    <a tabindex="-1" role="menuitem" class="dropdown-menu__a">
                                                        Remove
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- end ngIf: !ctrl.nameEditing[field.name] -->
                                    <!-- ngIf: ctrl.nameEditing[field.name] -->
                                    <div class="form-field-list__field ng-isolate-scope ng-hide"
                                         ng-show="field.name == ctrl.activeField.name &amp;&amp; ctrl.isFieldEditorOpened"
                                         gsc-form-field-editor="field">
                                        <div class="form-field ng-pristine ng-valid ng-scope ng-valid-required"
                                             ng-form="ctrl.ngForm">
                                            <div class="form-group"
                                                 ng-class="{'has-error': ctrl.ngForm[ctrl.field.name].needHighlight }">
                                                <label class="control-label">Field label</label> <input type="text"
                                                                                                        class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required"
                                                                                                        name="email"
                                                                                                        ng-model="ctrl.field.label"
                                                                                                        required=""
                                                                                                        gsc-control-validation=""
                                                                                                        tooltip-placement="top-left"
                                                                                                        gsc-inplace-preview-control="form.fields.email.label">
                                            </div>
                                            <div class="form-group form-group_sparse"><label class="control-label">Placeholder</label>
                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty"
                                                       name="placeholder" type="text" ng-model="ctrl.field.placeholder"
                                                       gsc-inplace-preview-control="form.fields.email.placeholder">
                                            </div>
                                            <div class="checkbox-group">
                                                <div class="checkbox _custom"><label> <input type="checkbox"
                                                                                             ng-model="ctrl.field.required"
                                                                                             class="ng-pristine ng-untouched ng-valid ng-not-empty"><span
                                                                class="custom-input"></span> Required </label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end ngRepeat: field in ctrl.form.fields track by field.name -->
                                <div class="ng-animate-enabled form-field-list__i form-field-list-animation ng-scope"
                                     ng-repeat="field in ctrl.form.fields track by field.name">
                                    <!-- ngIf: !ctrl.nameEditing[field.name] -->
                                    <div class="form-field-list__type form-field-type ng-scope"
                                         ng-if="!ctrl.nameEditing[field.name]"
                                         ng-class="{'form-field-type_active': field.name == ctrl.activeField.name &amp;&amp; ctrl.isFieldEditorOpened, 'form-field-type_error': ctrl.fieldEditors[field.name].ngForm.$invalid}">
                                        <div class="form-field-type__title ng-binding"
                                             ng-click="ctrl.selectField(field)"><span
                                                    class="form-field-type__caret caret"></span>Message <span
                                                    class="form-field-type__divider"></span></div>
                                        <div class="form-field-type__error-icon info-icon info-icon_error"></div>
                                        <div class="form-field-type__handle"><i class="icon icon_handle"></i></div>
                                        <div class="form-field-type__dropdown"><a role="button"
                                                                                  class="form-field-type__dropdown-toggle dropdown-toggle">
                                                <span class="icon icon_settings"></span> </a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-menu__i"><a tabindex="-1" role="menuitem"
                                                                                class="dropdown-menu__a"
                                                                                ng-click="ctrl.beginNameEditing(field)">
                                                        Rename </a></li>
                                                <li class="dropdown-menu__i"><a tabindex="-1" role="menuitem"
                                                                                class="dropdown-menu__a"
                                                                                ng-click="ctrl.cloneField(field)">
                                                        Clone </a></li>
                                                <li class="dropdown-menu__i"><a tabindex="-1" role="menuitem"
                                                                                class="dropdown-menu__a"
                                                                                ng-click="ctrl.removeField(field)">
                                                        Remove </a></li>
                                            </ul>
                                        </div>
                                    </div><!-- end ngIf: !ctrl.nameEditing[field.name] -->
                                    <!-- ngIf: ctrl.nameEditing[field.name] -->
                                    <div class="form-field-list__field ng-isolate-scope ng-hide"
                                         ng-show="field.name == ctrl.activeField.name &amp;&amp; ctrl.isFieldEditorOpened"
                                         gsc-form-field-editor="field">
                                        <div class="form-field ng-pristine ng-valid ng-scope ng-valid-required"
                                             ng-form="ctrl.ngForm">
                                            <div class="form-group"
                                                 ng-class="{'has-error': ctrl.ngForm[ctrl.field.name].needHighlight }">
                                                <label class="control-label">Field label</label> <input type="text"
                                                                                                        class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required"
                                                                                                        name="message"
                                                                                                        ng-model="ctrl.field.label"
                                                                                                        required=""
                                                                                                        gsc-control-validation=""
                                                                                                        tooltip-placement="top-left"
                                                                                                        gsc-inplace-preview-control="form.fields.message.label">
                                            </div>
                                            <div class="form-group form-group_sparse"><label class="control-label">Placeholder</label>
                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty"
                                                       name="placeholder" type="text" ng-model="ctrl.field.placeholder"
                                                       gsc-inplace-preview-control="form.fields.message.placeholder">
                                            </div>
                                            <div class="checkbox-group">
                                                <div class="checkbox _custom"><label> <input type="checkbox"
                                                                                             ng-model="ctrl.field.required"
                                                                                             class="ng-pristine ng-untouched ng-valid ng-not-empty"><span
                                                                class="custom-input"></span> Required </label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end ngRepeat: field in ctrl.form.fields track by field.name --> </div>
                        </div>
                    </div>
                    <div class="form-group ng-scope"
                         ng-class="{'has-error': form.contentForm.buttonText.needHighlight }"><label
                                class="control-label">Button text</label> <input
                                class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required"
                                name="buttonText" type="text" ng-model="widget.data.buttonText"
                                gsc-inplace-preview-control="" required="" gsc-control-validation=""></div>
                    <div class="form-group ng-scope"><label class="control-label">Note</label>
                        <div class="form-control ng-pristine ng-untouched ng-valid ng-isolate-scope ta-root ng-empty"
                             text-angular="" name="note" rows="3" ng-model="widget.data.note"
                             gsc-inplace-preview-control="">
                            <div text-angular-toolbar="" name="textAngularToolbar4383292779343450"
                                 class="ng-scope ng-isolate-scope ta-toolbar editor-toolbar">
                                <div class="editor-toolbar__group">
                                    <button type="button" class="btn btn_default btn_sm ng-scope" name="bold"
                                            unselectable="on" ng-disabled="isDisabled()" tabindex="-1"
                                            ng-click="executeAction()" ng-class="displayActiveToolClass(active)"
                                            title="Bold" disabled="disabled"><i
                                                class="toolbar-icon toolbar-icon_bold"></i></button>
                                    <button type="button" class="btn btn_default btn_sm ng-scope" name="italics"
                                            unselectable="on" ng-disabled="isDisabled()" tabindex="-1"
                                            ng-click="executeAction()" ng-class="displayActiveToolClass(active)"
                                            title="Italic" disabled="disabled"><i
                                                class="toolbar-icon toolbar-icon_italic"></i></button>
                                    <button type="button" class="btn btn_default btn_sm ng-scope" name="underline"
                                            unselectable="on" ng-disabled="isDisabled()" tabindex="-1"
                                            ng-click="executeAction()" ng-class="displayActiveToolClass(active)"
                                            title="Underline" disabled="disabled"><i
                                                class="toolbar-icon toolbar-icon_underline"></i></button>
                                    <button type="button" class="btn btn_default btn_sm ng-scope" name="insertLink"
                                            unselectable="on" ng-disabled="isDisabled()" tabindex="-1"
                                            ng-click="executeAction()" ng-class="displayActiveToolClass(active)"
                                            title="Insert link" disabled="disabled"><i
                                                class="toolbar-icon toolbar-icon_link"></i></button>
                                    <button type="button" class="btn btn_default btn_sm ng-scope" name="clear"
                                            unselectable="on" ng-disabled="isDisabled()" tabindex="-1"
                                            ng-click="executeAction()" ng-class="displayActiveToolClass(active)"
                                            title="Clear formatting" disabled="disabled"><i
                                                class="toolbar-icon toolbar-icon_eraser"></i></button>
                                </div>
                            </div>
                            <div class="tooltip tooltip-ex right" style="display: none">
                                <div class="tooltip-inner"></div>
                            </div>
                            <div class="ta-scroll-window ng-scope ta-text ta-editor editor-control" ng-hide="showHtml">
                                <div id="taTextElement4383292779343450" contenteditable="true" ta-bind="ta-bind"
                                     ng-model="html" ta-default-wrap="div"
                                     class="ng-pristine ng-untouched ng-valid ng-isolate-scope ta-bind ng-empty">
                                    <div><br></div>
                                </div>
                            </div>
                            <textarea id="taHtmlElement4383292779343450" ng-show="showHtml" ta-bind="ta-bind"
                                      ng-model="html"
                                      class="ng-pristine ng-untouched ng-valid ng-scope ng-isolate-scope ta-bind ta-html ta-editor editor-control ng-empty ng-hide"></textarea><input
                                    type="hidden" tabindex="-1" style="display: none;" name="note" value=""></div>
                    </div> <!-- ngIf: widget.hasLayout('side') --> <!-- ngIf: widget.hasLayout('bar') -->
                    <!-- ngIf: !widget.hasLayout('modal', 'flyby') --></div>
            </div>
        </div>
    </div>
</div>

<div class="widget-editor dashboard-panel">
    <div class="dashboard-panel__footer">
        <button class="btn btn_default-bis" type="button">OK</button>
        <button class="btn btn_default-bis" type="button">Cancel
        </button>
    </div>
    <div class="widget-ribbon widget-ribbon_contact"></div>
</div>
