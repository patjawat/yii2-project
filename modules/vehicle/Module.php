<?php

namespace app\modules\vehicle;

/**
 * vehicle module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\vehicle\controllers';

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
