<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

//Тестовые данные
$faker = Faker\Factory::create('en_US');

?>
<div class="site-signup">
    <div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <hr>
        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')
                    ->label('')
                    ->textInput([
                        'autofocus' => true, 
                        'placeholder' => 'Ваше имя',
                        'value' => $faker->username
                    ]) ?>

                <?= $form->field($model, 'email')
                    ->label('')
                    ->textInput([
                        'autofocus' => true, 
                        'placeholder' => 'Ваш email',
                        'value' => $faker->email
                    ]) ?>

                <?= $form->field($model, 'password')
                    ->label('')
                    // ->passwordInput(['placeholder' => 'Ваш пароль'])
                    ->passwordInput(['placeholder' => 'Ваш пароль', 'value' => $faker->password]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
