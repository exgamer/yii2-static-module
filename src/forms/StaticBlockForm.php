<?php
namespace concepture\yii2static\forms;


use concepture\yii2logic\forms\Form;
use concepture\yii2logic\enum\StatusEnum;
use Yii;

/**
 * Class StaticBlockForm
 * @package concepture\yii2static\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class StaticBlockForm extends Form
{
    public $user_id;
    public $domain_id;
    public $locale = "ru";
    public $content;
    public $alias;
    public $alias_md5_hash;
    public $status = StatusEnum::INACTIVE;

    /**
     * @see Form::formRules()
     */
    public function formRules()
    {
        return [
            [
                [
                    'content',
                    'locale',
                    'alias',
                ],
                'required'
            ],
        ];
    }
}
