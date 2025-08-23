<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Batches $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="batches-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'batch_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brew_date')->textInput() ?>

    <?= $form->field($model, 'quantity_produced')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
