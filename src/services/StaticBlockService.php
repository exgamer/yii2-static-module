<?php
namespace concepture\yii2static\services;

use yii\db\ActiveQuery;
use concepture\yii2logic\forms\Model;
use concepture\yii2logic\services\Service;
use Yii;
use concepture\yii2logic\services\traits\StatusTrait;
use concepture\yii2logic\services\traits\LocalizedReadTrait;
use concepture\yii2handbook\services\traits\ModifySupportTrait as HandbookModifySupportTrait;
use concepture\yii2handbook\services\traits\ReadSupportTrait as HandbookReadSupportTrait;
use concepture\yii2user\services\traits\UserSupportTrait;

/**
 * Class StaticBlockService
 * @package concepture\yii2static\service
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticBlockService extends Service
{
    use StatusTrait;
    use LocalizedReadTrait;
    use HandbookModifySupportTrait;
    use HandbookReadSupportTrait;
    use UserSupportTrait;

    protected function beforeCreate(Model $form)
    {
        $this->setCurrentUser($form);
        $this->setCurrentDomain($form);
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

    /**
     * Возвращает статические блоки по альясу
     *
     * @param string|array $alias
     *
     * @return ActiveRecord| array
     */
    public function getByAlias($alias)
    {
        $md5 = [];
        if (is_array($alias)){
            foreach ($alias as $ally){
                $md5[] = md5($ally);
            }
        }else{
            $md5[] = md5($alias);
        }

        $result = $this->getAllByCondition(function(ActiveQuery $query) use ($md5){
            $query->andWhere(["alias_md5_hash" => $md5]);
            $query->andWhere("status = :status", [':status' => StatusEnum::ACTIVE]);
            $query->andWhere("is_deleted = :is_deleted", [':is_deleted' => IsDeletedEnum::NOT_DELETED]);
            $query->indexBy('alias');
        });

        if (! $result){
            return null;
        }

        if (! is_array($alias)){

            return $result[$alias];
        }

        return $result;
    }
}
