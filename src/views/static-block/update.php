<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model concepture\article\models\PostCategory */

$this->title = Yii::t('backend', 'Редактировать блок: {name}', [
    'name' => $model->alias,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('static', 'Статические блоки'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->alias, 'url' => ['view', 'id' => $originModel->id]];
$this->params['breadcrumbs'][] = Yii::t('static', 'Редактировать');
?>
<div class="post-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
