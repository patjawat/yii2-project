<?php

namespace app\modules\booking;

/**
 * booking module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\booking\controllers';

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
