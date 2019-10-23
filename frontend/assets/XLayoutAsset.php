<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class XLayoutAsset extends  AssetBundle {
   // public $baseUrl = '@web/modules/adminx/assets';
    public $sourcePath = '@app/assets';
    public $publishOptions = ['forceCopy' => true];
    public $css = [
        'css/adminx.css',
        'css/site.css'
    ];
    public $js = [
        'js/layout.js',
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