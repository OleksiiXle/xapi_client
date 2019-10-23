<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class SeansAsset extends  AssetBundle {
   // public $baseUrl = '@web/modules/adminx/assets';
    public $sourcePath = '@app/assets';
    public $publishOptions = ['forceCopy' => true];
    public $css = [
        'css/seans.css',
    ];
    public $js = [
        'js/seans.js',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}