<?php
namespace concepture\yii2static\services;

use concepture\yii2logic\forms\Form;
use concepture\yii2logic\services\Service;
use Yii;
use concepture\yii2logic\services\traits\StatusTrait;
use concepture\yii2logic\services\traits\LocalizedReadTrait;

/**
 * Class StaticPageService
 * @package concepture\yii2static\service
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticPageService extends Service
{
    use StatusTrait;
    use LocalizedReadTrait;

    protected function beforeCreate(Form $form)
    {
        $form->user_id = Yii::$app->user->identity->id;
    }

    /**
     * Возвращает статическую страницу для текущего url по хешу md5 url
     *
     * @return array
     */
    public function getPageCurrentUrl()
    {
        $current = Yii::$app->getRequest()->getPathInfo();
        $md5 = md5($current);
        $modelClass = $this->getRelatedModelClass();
        $modelClass::$search_by_locale_callable = function($q, $localizedAlias) use ($md5) {
            $q->andWhere(["{$localizedAlias}.url_md5_hash" => $md5]);
        };

        return $this->getOneByCondition(function(ActiveQuery $query) {
            $query->andWhere("status = :status", [':status' => StatusEnum::ACTIVE]);
        });
    }
}
