# concepture-yii2static-module

    
Подключение

"require": {
    "concepture/yii2-static" : "*"
},
    

Миграции
 php yii migrate/up --migrationPath=@concepture/yii2static/console/migrations
 
Подключение модуля для админки

     'modules' => [
         'static' => [
             'class' => 'concepture\yii2static\Module'
         ],
     ],
     
Для переопределния контроллера добавялем в настройки модуля

     'modules' => [
         'static' => [
            'class' => 'concepture\yii2static\Module',
            'controllerMap' => [
                'static-block' => 'backend\controllers\StaticBlockController'
            ],
         ],
     ],

            
Для переопределния папки с представленяими добавялем в настройки модуля

     'modules' => [
         'static' => [
             'class' => 'concepture\yii2static\Module',
             'viewPath' => '@backend/views'
         ],
     ],
