<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\widgets\Pjax;
?>

<div class="post-category-form">
    <?php Pjax::begin(); ?>
    <div class="form-group">
        <?= Html::label(Yii::t('static', 'Версии'))?>
        <?php foreach (Yii::$app->localeService->getAllList('locale', 'locale') as $locale):?>
            <?= Html::a(
                $locale,
                \yii\helpers\Url::current(['locale' => $locale]),
                ['class' => 'btn btn-lg btn-primary ' . ($locale == $model->locale ? "active" : "")]
            ) ?>
        <?php endforeach;?>
    </div>



    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
            'allowedContent' => true,
        ],
    ]); ?>
    <?= $form->field($model, 'seo_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('static', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
