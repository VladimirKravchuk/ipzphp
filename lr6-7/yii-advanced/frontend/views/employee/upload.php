<?php

use yii\widgets\ActiveForm;
$this->title = 'Редагування фото';
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'imageFile')->fileInput(); ?>

    <button class="btn btn-outline-dark">Змінити</button>

<?php ActiveForm::end() ?>