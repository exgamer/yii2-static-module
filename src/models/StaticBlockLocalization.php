<?php
namespace concepture\yii2static\models;

use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\TranslitValidator;

/**
 * StaticBlockLocalization model
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $sort
 * @property integer $locale
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $seo_name
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property integer $status
 * @property datetime $created_at
 * @property datetime $updated_at
 *
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticBlockLocalization extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{static_block_localization}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'entity_id',
                ],
                'integer'
            ],
            [
                [
                    'locale'
                ],
                'integer'
            ],
            [
                [
                    'content'
                ],
                'string'
            ],
            [
                [
                    'title',
                    'seo_name',
                ],
                'string',
                'max'=>1024
            ],
            [
                [
                    'seo_title',
                    'seo_description',
                    'seo_keywords',
                ],
                'string',
                'max'=>175
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('static','#'),
            'locale' => Yii::t('static','Язык'),
            'title' => Yii::t('static','Название'),
            'content' => Yii::t('static','Контент'),
            'seo_name' => Yii::t('static','SEO название'),
            'seo_title' => Yii::t('static','SEO title'),
            'seo_description' => Yii::t('static','SEO description'),
            'seo_keywords' => Yii::t('static','SEO keywords'),
            'created_at' => Yii::t('static','Дата создания'),
            'updated_at' => Yii::t('static','Дата обновления'),
        ];
    }
}
