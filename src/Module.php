<?php
namespace concepture\yii2static;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'concepture\yii2static\web\controllers';

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['yii2static'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'ru-RU',
            'basePath' => '@vendor/concepture/yii2static/messages',
        ];

    }
}