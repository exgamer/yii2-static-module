<?php
namespace concepture\yii2static\forms;


use concepture\yii2logic\forms\Form;
use Yii;

/**
 * Class StaticBlockForm
 * @package concepture\yii2static\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticBlockForm extends Form
{
    public $user_id;
    public $locale = "ru";
    public $title;
    public $content;
    public $seo_name;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
    public $status = 0;

    /**
     * @see Form::formRules()
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
