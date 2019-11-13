<?php
namespace concepture\yii2banner\services;

use concepture\yii2logic\forms\Form;
use concepture\yii2logic\services\Service;
use Yii;
use concepture\yii2logic\services\traits\StatusTrait;
use concepture\yii2logic\services\traits\LocalizedReadTrait;
use yii\db\ActiveQuery;
use concepture\yii2logic\enum\StatusEnum;

/**
 * Class BannerService
 * @package concepture\yii2banner\service
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerService extends Service
{
    use StatusTrait;
    use LocalizedReadTrait;

    protected function beforeCreate(Form $form)
    {
        $form->user_id = Yii::$app->user->identity->id;
    }

    /**
     * Возвращает баннеры для текущего url по хешу md5 url
     *
     * @return array
     */
    public function getBannersForCurrentUrl()
    {
        $current = Yii::$app->getRequest()->getPathInfo();
        $md5 = md5($current);

        return $this->getAllByCondition(function(ActiveQuery $query) use($md5) {
            $query->innerJoinWith('urlLinks');
            $query->andWhere("u.url_md5_hash = :url_md5_hash", [':url_md5_hash' => $md5]);
            $query->andWhere("status = :status", [':status' => StatusEnum::ACTIVE]);
        });
    }
}
