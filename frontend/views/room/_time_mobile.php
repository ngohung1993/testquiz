<?php

use common\models\Exam;

/* @var $exam Exam */

?>

<div class="fix-wrapper anchor hidden-md hidden-lg">
    <div class="fix-container">
        <div class="time-ver clock">
            <span ng-bind="hour">--</span>:<span ng-bind="minute">--</span>:<span ng-bind="second">--</span>
        </div>
        <div class="do-done">
            <span></span><span></span><span class="count-finish" ng-bind="answered">0</span>
            <span><?= $exam->number_question ?></span>
        </div>
        <div class="choseNumber">
            <a data-toggle="modal" data-target="#game-answer-panel-mobile"><span>Chọn câu</span></a>
        </div>
        <div class="end-exam">
            <a class="tp-btn bgred-btn" data-toggle="modal" data-target="#myModal">Nộp bài</a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<style>

    .modal-dialog {
        padding: 0 10px;
    }

    .modal-content {
        border-radius: unset !important;
    }

    .fix-wrapper.anchor {
        top: auto;
        bottom: 100px;
    }

    .fix-wrapper {
        position: fixed;
        width: 80px;
        height: auto;
        right: 10px;
        z-index: 10;
    }

    .fix-container {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .time-ver {
        background: #428bca;
        width: 100%;
        height: 30px;
        line-height: 30px;
        -webkit-border-radius: 3px;
        color: #fff;
        text-align: center;
        font-weight: 700;
        letter-spacing: .05em;
        opacity: .8;
        margin-bottom: 5px;
    }

    .do-done {
        width: 100%;
        height: 30px;
        line-height: 30px;
        -webkit-border-radius: 3px;
        position: relative;
        overflow: hidden;
        opacity: .8;
        margin-bottom: 5px;
    }

    .do-done span:nth-of-type(1) {
        background: #428bca;
        width: 100%;
        height: 100%;
        text-align: center;
    }

    .do-done span {
        position: absolute;
        display: inline-block;
        color: #fff;
        font-weight: 700;
        top: 0;
    }

    .do-done span:nth-of-type(2) {
        background: #cef3fc;
        transform: skewX(-22deg);
        left: 50%;
        width: 100%;
        height: 100%;
    }

    .do-done span:nth-of-type(3) {
        width: 50%;
        height: 100%;
        left: 0;
        text-align: center;
    }

    .do-done span:nth-of-type(4) {
        width: 50%;
        height: 100%;
        left: 50%;
        text-align: center;
        color: #000;
    }

    .choseNumber {
        background: #fff;
        width: 100%;
        height: 30px;
        line-height: 30px;
        -webkit-border-radius: 3px;
        position: relative;
        overflow: hidden;
        opacity: .8;
        margin-bottom: 30px;
        padding: 0;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .5);
    }

    .choseNumber span:nth-of-type(1) {
        top: 0;
        left: 0;
    }

    .choseNumber span {
        display: inline-block;
        width: 100%;
        position: absolute;
        height: 30px;
        -webkit-transition: all, .3s;
        transition: all, .3s;
        text-align: center;
        font-weight: 700;
    }

    .end-exam {
        opacity: .8;
    }

    .end-exam a {
        width: 100%;
        height: 30px;
        line-height: 30px;
        -webkit-border-radius: 3px;
        text-transform: uppercase;
        text-align: center;
        color: #fff;
        padding: 0;
        font-weight: 700;
        font-size: 12px;
    }

    .bgred-btn {
        background: #428bca;
    }

    .tp-btn {
        position: relative;
        overflow: hidden;
        display: inline-block;
        cursor: pointer;
    }
</style>