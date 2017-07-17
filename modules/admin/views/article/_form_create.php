<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use \vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */


//Тестовые данные
// $faker = Faker\Factory::create('en_US');

?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 10,
                'plugins' => [
                    'clips',
                    'fullscreen'
                ]
            ]
        ]);?>

    <?= $form->field($model, 'description')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 100,
                'plugins' => [
                    'clips',
                    'fullscreen'
                ]
            ]
        ]); ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen'
                ]
            ]
        ]);?>

    <?= $form->field($model, 'viewed')
        ->textInput(['value' => 0]) ?>

    <?= $form->field($model, 'user_id')->textInput(['disabled' => 'disabled', 'value' => \Yii::$app->user->identity->id]) ?>

    <?= $form->field($model, 'status')
        ->label('Видна всем? Да: 1, Нет: 0')
        ->textInput(['value' => 1]) ?>
        
    <?/*= $form->field($model, 'tags')->listBox(
            ArrayHelper::map($tags, 'id', 'title'),
            [
                'multiple' => true
            ]
        ) */?>

    <?= $form->field($model, 'category_id')
        ->label('Категория')
        ->dropDownList($categories, $options = ['value' => 1] ) ?>

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
