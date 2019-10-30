<?php
namespace concepture\yii2static\traits;

use concepture\yii2static\services\StaticBlockService;
use concepture\yii2static\services\StaticPageService;
use Yii;

/**
 * Trait ServicesTrait
 * @package concepture\yii2static\traits
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
trait ServicesTrait
{
    /**
     * @return StaticBlockService
     */
    public function staticBlockService()
    {
        return Yii::$app->staticBlockService;
    }

    /**
     * @return StaticPageService
     */
    public function staticPageService()
    {
        return Yii::$app->staticPageService;
    }
}

