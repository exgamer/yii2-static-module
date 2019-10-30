<?php
namespace concepture\yii2static\services;

use concepture\yii2logic\forms\Form;
use concepture\yii2logic\services\Service;
use Yii;
use concepture\yii2logic\services\traits\StatusTrait;
use concepture\yii2logic\services\traits\LocalizedReadTrait;


/**
 * Class StaticBlockService
 * @package concepture\yii2static\service
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticBlockService extends Service
{
    use StatusTrait;
    use LocalizedReadTrait;

    protected function beforeCreate(Form $form)
    {
        $form->user_id = Yii::$app->user->identity->id;
    }
}
