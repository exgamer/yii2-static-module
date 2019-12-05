<?php

namespace concepture\yii2static\web\controllers;

use concepture\yii2user\enum\UserRoleEnum;
use concepture\yii2logic\controllers\web\localized\Controller;
use concepture\yii2logic\actions\web\localized\StatusChangeLocalizedAction;
use concepture\yii2logic\actions\web\localized\UndeleteLocalizedAction;

/**
 * Class StaticBlockController
 * @package concepture\yii2static\web\controllers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticBlockController extends Controller
{
    protected function getAccessRules()
    {
        return [
            [
                'actions' => ['index', 'view','create', 'update', 'delete', 'undelete', 'status-change'],
                'allow' => true,
                'roles' => [UserRoleEnum::ADMIN],
            ]
        ];
    }


    public function actions()
    {
        $actions = parent::actions();

        return array_merge($actions,[
            'status-change' => StatusChangeAction::class,
            'undelete' => UndeleteAction::class,
        ]);
    }
}
