<?php
namespace concepture\yii2static\models;

use concepture\yii2handbook\converters\LocaleConverter;
use concepture\yii2logic\models\traits\SeoTrait;
use concepture\yii2logic\traits\SeoPropertyTrait;
use concepture\yii2logic\validators\SeoNameValidator;
use concepture\yii2logic\validators\UniqueLocalizedValidator;
use concepture\yii2user\models\User;
use concepture\yii2logic\validators\UniquePropertyValidator;
use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\TranslitValidator;
use concepture\yii2logic\models\traits\HasLocalizationTrait;
use concepture\yii2logic\models\traits\StatusTrait;
use concepture\yii2handbook\models\traits\DomainTrait;
use concepture\yii2user\models\traits\UserTrait;
use concepture\yii2logic\validators\MD5Validator;
use concepture\yii2logic\models\traits\IsDeletedTrait;
use yii\helpers\ArrayHelper;

/**
 * StaticPage model
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $locale
 * @property string $header
 * @property string $content
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
class StaticPage extends ActiveRecord
{
    public $allow_physical_delete = false;

    use HasLocalizationTrait;
    use StatusTrait;
    use DomainTrait;
    use UserTrait;
    use IsDeletedTrait;
//    use SeoPropertyTrait;
    use SeoTrait;

//    public $locale;
//    public $seo_name_md5_hash;
//    public $title;
//    public $content;
//    public $can_comment;

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:label()
     *
     * @return string
     */
    public static function label()
    {
        return Yii::t('static', 'Статические страницы');
    }

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:toString()
     * @return string
     */
    public function toString()
    {
        return $this->header;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{static_page}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(
            $this->seoRules(),
            [
            [
                [
                    'status',
                    'user_id',
                    'domain_id',
                    'locale',
                    'can_comment'
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
                    'header',
                    'seo_name_md5_hash',
                ],
                'string',
                'max'=>1024
            ],
            [
                [
                    'seo_name_md5_hash',
                ],
                MD5Validator::class,
                'source' => 'seo_name'
            ],
            [
                [
                    'seo_name'
                ],
                UniqueLocalizedValidator::class,
                'fields' => ['domain_id'],
                'localizedFields' => ['seo_name', 'locale']
            ]
            ]
        );
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(
            $this->seoAttributeLabels(),
            [
                'id' => Yii::t('static','#'),
                'user_id' => Yii::t('static','Пользователь'),
                'domain_id' => Yii::t('static','Домен'),
                'status' => Yii::t('static','Статус'),
                'locale' => Yii::t('static','Язык'),
                'header' => Yii::t('static','Заголовок (H1)'),
                'content' => Yii::t('static','Контент'),
                'created_at' => Yii::t('static','Дата создания'),
                'updated_at' => Yii::t('static','Дата обновления'),
                'is_deleted' => Yii::t('static','Удален'),
                'can_comment' => Yii::t('static','Комментарии'),
            ]
        );
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->saveLocalizations();

        return parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
        $this->deleteLocalizations();

        return parent::beforeDelete();
    }

    public static function getLocaleConverterClass()
    {
        return LocaleConverter::class;
    }
}
