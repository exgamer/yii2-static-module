<?php

namespace concepture\yii2static\web\controllers;

use concepture\yii2user\enum\UserRoleEnum;
use concepture\yii2static\web\controllers\Controller;
use concepture\yii2logic\actions\web\localized\StatusChangeAction;
use concepture\yii2logic\actions\web\localized\UndeleteAction;
use yii\helpers\ArrayHelper;

/**
 * Class StaticBlockController
 * @package concepture\yii2static\web\controllers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticBlockController extends Controller
{
    protected function getAccessRules()
    {
        return ArrayHelper::merge(
            parent::getAccessRules(),
            [
                [
                    'actions' => ['index', 'view','create', 'update', 'delete', 'undelete', 'status-change'],
                    'allow' => true,
                    'roles' => [UserRoleEnum::ADMIN],
                ]
            ]
        );
    }


    public function actions()
    {
        $actions = parent::actions();

        return ArrayHelper::merge($actions,[
            'status-change' => StatusChangeAction::class,
            'undelete' => UndeleteAction::class,
        ]);
    }
}
