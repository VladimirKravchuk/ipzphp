<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

?>
<?php Pjax::begin([
    'id' => 'world-form-container'
]); ?>
<?php $form = ActiveForm::begin([
    'options' => ['data' => ['pjax' => true],],
    'id' => 'world-form'
]); ?>

<?= $form->field($model, 'continent_id')->dropDownList(ArrayHelper::map($continents, 'continent_id', 'name'), [
    'id' => 'field-continent-id',
    'onchange' => '$("#world-form").submit()',
    'prompt' => 'choose'
]) ?>
    <h2>Твоє місцезнаходження: <?= $continent->name ?></h2>

<?php if ($country) : ?>
    <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::map($country, 'country_id', 'name'), ['id' => 'field-country-id',
        'onchange' => '$("#world-form").submit()',
        'prompt' => 'choose']) ?>
    <h2>Твоє місцезнаходження: <?= $country1->name ?></h2>
<?php endif ?>
<?php if ($regionLang1) : ?>
    <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map($regionLang1, 'region_id', 'name_language'), ['id' => 'field-region_language-id',
        'onchange' => '$("#world-form").submit()',
        'prompt' => 'choose']) ?>

    <h2>Твоє місцезнаходження: <?= $regionLang->name_language ?></h2>
<?php endif ?>
<?php if ((!empty($regionLang1) && (!empty($country)) && (!empty($cityLang1)))) : ?>
    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map($cityLang1, 'city_id', 'name_language'), ['id' => 'field-city_language-id',
        'onchange' => '$("#world-form").submit()',
        'prompt' => 'choose']) ?>
    <h2>Твоє місцезнаходження: <?= $cityLang->name_language ?></h2>
<?php endif ?>
<?php ActiveForm::end(); ?>
    <br>
    <br>
    <br>
<?php if ((!empty($regionLang1) && (!empty($country)) && (!empty($cityLang1)) && (!empty($cityLang->name_language)))): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Погода в місті</th>
            <th scope="col">Темпуратура</th>
            <th scope="col">Вологість</th>
            <th scope="col">Вітер</th>
        </tr>
        </thead>
        <tr>
            <th scope="col"><?= $dataJson->name; ?></th>
            <th scope="col"><?= $dataJson->main->temp_min; ?>°C</th>
            <th scope="col"><?= $dataJson->main->humidity; ?> %</th>
            <th scope="col"><?= $dataJson->wind->speed; ?> км/г</th>
        </tr>
    </table>
<?php endif ?>
<?php Pjax::end(); ?>