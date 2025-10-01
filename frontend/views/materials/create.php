<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Materials $model */

$this->title = 'Create Materials';
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
