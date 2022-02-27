<?php

namespace andreag\codicefiscale;
use yii\base\Module as BaseModule;

use Yii;
/**
 * core module definition class
 */
class Module extends BaseModule
{
    /**
     * @var string The controller Namespace
     */
    public $controllerNamespace = 'andreag\codicefiscale\controllers';

    /**
     * Initialize the module
     */
    public function init()
    {
        parent::init();
    }


}
