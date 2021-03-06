<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ChoiceItem */

$this->title = 'Update Choice Item: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Choice Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="choice-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
