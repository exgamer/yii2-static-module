<?php

namespace concepture\yii2static\search;

use concepture\yii2static\models\StaticPage;
use yii\db\ActiveQuery;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class StaticPageSearch
 * @package concepture\yii2static\search
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticPageSearch extends StaticPage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'status',
                    'domain_id',
                    'is_deleted',
                ],
                'integer'
            ],
            [
                [
                    'header',
                    'seo_name'
                ],
                'safe'
            ],
        ];
    }

    public function extendQuery(ActiveQuery $query)
    {
        $query->andFilterWhere([
            static::tableName().'.id' => $this->id
        ]);
        $query->andFilterWhere([
            'status' => $this->status
        ]);
        $query->andFilterWhere([
            'domain_id' => $this->domain_id
        ]);
        $query->andFilterWhere([
            'is_deleted' => $this->is_deleted
        ]);
        $query->andFilterWhere(['like', static::localizationAlias() . ".seo_name", $this->seo_name]);
        $query->andFilterWhere(['like', static::localizationAlias() . ".header", $this->header]);
    }

    public function extendDataProvider(ActiveDataProvider $dataProvider)
    {
        $this->addSortByLocalizationAttribute($dataProvider, 'seo_name');
        $this->addSortByLocalizationAttribute($dataProvider, 'header');
    }
}
