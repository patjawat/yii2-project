<?php

namespace app\modules\bookipd;

/**
 * bookipd module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\bookipd\controllers';

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
