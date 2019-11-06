<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model concepture\article\models\PostCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('static', 'Статические страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', Yii::t('static', 'Редактировать')), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', Yii::t('static', 'Удалить')), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="form-group">
        <?= Html::label(Yii::t('static', 'Версии'))?>
        <?php foreach ($model->locales() as $key => $locale):?>
            <?= Html::a(
                $locale,
                \yii\helpers\Url::current(['locale' => $key]),
                ['class' => 'btn btn-lg btn-primary ' . ($key == $model->locale ? "active" : "")]
            ) ?>
        <?php endforeach;?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute'=>'Версии',
                'value'=>function($model) {

                    return implode(",", $model->locales());
                }
            ],
            'seo_name',
            'url',
            'seo_h1',
            'seo_title',
            'seo_description',
            'seo_keywords',
            [
                'attribute'=>'status',
                'value'=>$model->statusLabel(),
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
