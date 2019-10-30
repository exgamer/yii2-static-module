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