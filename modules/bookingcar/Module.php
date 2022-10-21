<?php

namespace app\modules\bookingcar;

/**
 * Bookingcar module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\bookingcar\controllers';
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->layout = 'main';
        parent::init();

        // custom initialization code goes here
    }
}
