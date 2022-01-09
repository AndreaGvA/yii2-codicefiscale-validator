<?php

namespace andreag\codicefiscale;
use yii\web\AssetBundle;

class CodiceFiscaleAsset extends AssetBundle
{
    public $sourcePath = '@vendor/andreag/yii2-codicefiscale-validator/src/js';
    public $css = [
        //'jquery-cron.css',
    ];

    public $js = [
        'cf.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        parent::init();
        $this->publishOptions['forceCopy'] = true;
    }
}