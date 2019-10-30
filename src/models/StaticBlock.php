<?php
namespace concepture\yii2static\models;

use concepture\yii2user\models\User;
use concepture\yii2logic\validators\UniquePropertyValidator;
use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\TranslitValidator;
use concepture\yii2logic\models\traits\HasLocalizationTrait;
use concepture\yii2logic\models\traits\StatusTrait;

/**
 * StaticBlock model
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $locale
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
    use HasLocalizationTrait;
    use StatusTrait;

    public $locale;
    public $title;
    public $content;
    public $seo_name;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;


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
                    'user_id'
                ],
                'integer'
            ],
            [
                [
                    'locale'
                ],
                'string',
                'max'=>2
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
                    'seo_name',
                ],
                TranslitValidator::className(),
                'source' => 'title'
            ],
            [
                [
                    'seo_name',
                ],
                UniquePropertyValidator::class
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
            'user_id' => Yii::t('static','Пользователь'),
            'status' => Yii::t('static','Статус'),
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

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->saveLocalizations();

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
       $this->deleteLocalizations();

       return parent::afterDelete();
    }

    public function afterFind()
    {
        $this->setLocalizations();

       return parent::afterFind();
    }
}
