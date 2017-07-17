<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="container">
        <div class="row">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.
        </div>

    <?php else: ?>
        <br>
    <div class="text-info">          
Если у вас есть деловые вопросы или другие вопросы, пожалуйста, заполните следующую форму, чтобы связаться с нами.
            Спасибо.
    </div>
        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')
                            ->label('')
                            ->textInput(['autofocus' => true, 'placeholder' => 'Ваше имя']) ?>

                    <?= $form->field($model, 'email')
                            ->label('')
                            ->textInput(['placeholder' => 'Ваш e-mail']) ?>

                    <?= $form->field($model, 'subject')
                            ->label('')
                            ->textInput(['placeholder' => 'Тема письма']) ?>

                    <?= $form->field($model, 'body')->label('')->textarea(['rows' => 6, 'placeholder' => 'Текст']) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
    </div>
    </div>
</div>
