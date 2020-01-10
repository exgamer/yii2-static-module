<?php
namespace concepture\yii2static\forms;


use kamaelkz\yii2admin\v1\forms\BaseForm;
use Yii;

/**
 * Class StaticPageForm
 * @package concepture\yii2static\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticPageForm extends BaseForm
{
    public $user_id;
    public $domain_id;
    public $locale;
    public $seo_name_md5_hash;
    public $title;
    public $content;
    public $seo_name;
    public $seo_h1;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
    public $status = 0;
    public $can_comment = 1;

    /**
     * @see CForm::formRules()
     */
    public function formRules()
    {
        return [
            [
                [
                    'title',
                    'content',
                    'locale',
                ],
                'required'
            ],
        ];
    }
}
