<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */


//Тестовые данные
$faker = Faker\Factory::create('en_US');

?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')
        ->textInput(['maxlength' => true, 'value' => $faker->realText(50)]) ?>

    <?= $form->field($model, 'description')
        ->textarea(['rows' => 4, 'value' => $faker->realText(400)]) ?>

    <?= $form->field($model, 'content')
        ->textarea(['rows' => 8, 'value' => $faker->realText(2000)]) ?>

    <?= $form->field($model, 'viewed')
        ->textInput(['value' => 0]) ?>

    <?= $form->field($model, 'user_id')->textInput(['disabled' => 'disabled', 'value' => \Yii::$app->user->identity->id]) ?>

    <?= $form->field($model, 'status')
        ->label('Виден всем? Да: 1, Нет: 0')
        ->textInput(['value' => 1]) ?>

    <?= $form->field($model, 'category_id')
        ->label('Категория')
        ->dropDownList( ArrayHelper::getColumn( $categories, 'title'), $options = ['value' => 2] ) ?>

<?php if ( empty($model->date) ) : ?>

    <?= $form->field($model, 'date')
    ->label('Дата создания')
    ->textInput(['value' => date('Y-m-d')]) ?>

<?php endif ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
