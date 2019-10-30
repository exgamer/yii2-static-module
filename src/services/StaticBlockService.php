<?php
namespace concepture\yii2static\services;

use concepture\yii2logic\forms\Form;
use concepture\yii2logic\services\Service;
use Yii;
use concepture\yii2logic\services\traits\StatusTrait;

/**
 * Class StaticBlockService
 * @package concepture\yii2static\service
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticBlockService extends Service
{
    use StatusTrait;

    protected function beforeCreate(Form $form)
    {
        $form->user_id = Yii::$app->user->identity->id;
    }
}
