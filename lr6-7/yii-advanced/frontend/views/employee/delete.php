<?php

use yii\widgets\ActiveForm;
$this->title = 'Видалити фото';
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <button class="btn btn-outline-dark">Видалити</button>
<?php ActiveForm::end() ?>