<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Breweries $model */

$this->title = 'Update Breweries: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Breweries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="breweries-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
