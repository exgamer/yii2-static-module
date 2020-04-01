<?php
namespace concepture\yii2static\forms;


use concepture\yii2logic\traits\SeoPropertyTrait;
use kamaelkz\yii2admin\v1\forms\BaseForm;
use Yii;

/**
 * Class StaticPageForm
 * @package concepture\yii2static\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticPageForm extends BaseForm
{
    use SeoPropertyTrait;

    public $user_id;
    public $domain_id;
    public $locale;
    public $seo_name_md5_hash;
    public $header;
    public $content;
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
                    'header',
                    'content',
                    'locale',
                ],
                'required'
            ],
        ];
    }
}
