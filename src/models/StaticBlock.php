<?php
namespace concepture\yii2static\models;

use concepture\yii2user\models\User;
use concepture\yii2logic\validators\UniquePropertyValidator;
use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\TranslitValidator;
use concepture\yii2logic\models\traits\HasLocalizationTrait;
use concepture\yii2logic\models\traits\StatusTrait;
use concepture\yii2handbook\converters\LocaleConverter;
use concepture\yii2handbook\models\traits\DomainTrait;
use concepture\yii2user\models\traits\UserTrait;
use concepture\yii2logic\models\traits\IsDeletedTrait;
use concepture\yii2logic\validators\MD5Validator;

/**
 * StaticBlock model
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $locale
 * @property string $title
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
class StaticBlock extends ActiveRecord
{
    public $allow_physical_delete = false;

    use HasLocalizationTrait;
    use StatusTrait;
    use IsDeletedTrait;
    use DomainTrait;
    use UserTrait;

    public $locale;
    public $content;

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:label()
     *
     * @return string
     */
    public static function label()
    {
        return Yii::t('static', 'Статические блоки');
    }

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:toString()
     * @return string
     */
    public function toString()
    {
        return $this->alias;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{static_block}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'status',
                    'user_id',
                    'domain_id',
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
                    'alias'
                ],
                'string',
                'max' => 50
            ],
            [
                [
                    'alias_md5_hash',
                ],
                MD5Validator::className(),
                'source' => 'alias'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('static','#'),
            'user_id' => Yii::t('static','Пользователь'),
            'domain_id' => Yii::t('static','Домен'),
            'alias' => Yii::t('static','Альяс'),
            'status' => Yii::t('static','Статус'),
            'locale' => Yii::t('static','Язык'),
            'content' => Yii::t('static','Контент'),
            'created_at' => Yii::t('static','Дата создания'),
            'updated_at' => Yii::t('static','Дата обновления'),
            'is_deleted' => Yii::t('banner','Удален'),
        ];
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

    public function afterFind()
    {
        $this->setLocalizations();

       return parent::afterFind();
    }

    public static function getLocaleConverterClass()
    {
        return LocaleConverter::class;
    }
}
