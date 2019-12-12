<?php
namespace concepture\yii2static\services;

use yii\db\ActiveQuery;
use concepture\yii2logic\forms\Model;
use concepture\yii2logic\services\Service;
use Yii;
use concepture\yii2logic\services\traits\StatusTrait;
use concepture\yii2logic\services\traits\LocalizedReadTrait;
use concepture\yii2logic\enum\StatusEnum;
use concepture\yii2logic\enum\IsDeletedEnum;
use concepture\yii2handbook\services\traits\ModifySupportTrait as HandbookModifySupportTrait;
use concepture\yii2handbook\services\traits\ReadSupportTrait as HandbookReadSupportTrait;
use concepture\yii2handbook\services\traits\EntityTypeSupportTrait;
use concepture\yii2user\services\traits\UserSupportTrait;

/**
 * Class StaticPageService
 * @package concepture\yii2static\service
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticPageService extends Service
{
    use StatusTrait;
    use LocalizedReadTrait;
    use HandbookModifySupportTrait;
    use HandbookReadSupportTrait;
    use EntityTypeSupportTrait;
    use UserSupportTrait;

    protected function beforeCreate(Model $form)
    {
        $this->setCurrentUser($form);
        $this->setCurrentDomain($form);
    }

    /**
     * Возвращает активную статическую страницу для текущего url по хешу md5 url
     *
     * @param null $url
     * @return array
     */
    public function getPageForCurrentUrl($url = null)
    {
        $current = Yii::$app->getRequest()->getPathInfo();
        if ($url){
            $current = $url;
        } else {
            $current = trim($current, '/');
        }
        $md5 = md5($current);
        $modelClass = $this->getRelatedModelClass();
        $localizedAlias = $modelClass::localizationAlias();
//        $modelClass::$search_by_locale_callable = function($q, $localizedAlias) use ($md5) {
//            $q->andWhere(["{$localizedAlias}.seo_name_md5_hash" => $md5]);
//        };

        return $this->getOneByCondition(function(ActiveQuery $query) use ($localizedAlias, $md5){
            $query->andWhere(["{$localizedAlias}.seo_name_md5_hash" => $md5]);
            $query->andWhere("status = :status", [':status' => StatusEnum::ACTIVE]);
            $query->andWhere("is_deleted = :is_deleted", [':is_deleted' => IsDeletedEnum::NOT_DELETED]);
        });
    }

    /**
     * Метод для расширения find()
     * !! ВНимание эти данные будут поставлены в find по умолчанию все всех случаях
     *
     * @param ActiveQuery $query
     * @see \concepture\yii2logic\services\Service::extendFindCondition()
     */
    protected function extendQuery(ActiveQuery $query)
    {
        $this->applyDomain($query);
    }
}
