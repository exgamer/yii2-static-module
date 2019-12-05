<?php

namespace concepture\yii2static\web\controllers;

use concepture\yii2user\enum\UserRoleEnum;
use concepture\yii2logic\controllers\web\localized\Controller;
use concepture\yii2logic\controllers\web\localized\StatusChangeAction;
use concepture\yii2logic\controllers\web\localized\UndeleteAction;

/**
 * Class StaticPageController
 * @package concepture\yii2static\web\controllers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticPageController extends Controller
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
