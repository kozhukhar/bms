<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Breweries $model */

$this->title = 'Create Breweries';
$this->params['breadcrumbs'][] = ['label' => 'Breweries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breweries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
