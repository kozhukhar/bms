<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Batches $model */

$this->title = 'Create Batches';
$this->params['breadcrumbs'][] = ['label' => 'Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="batches-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
