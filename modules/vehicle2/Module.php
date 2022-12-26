<?php

namespace app\modules\vehicle2;

/**
 * vehicle2 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\vehicle2\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->layout = 'blank';
        parent::init();

        // custom initialization code goes here
    }
}
