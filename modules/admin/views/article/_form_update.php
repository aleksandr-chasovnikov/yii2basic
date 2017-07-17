<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */

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
            ],
            'value' => $model->title
        ]);?>

    <?= $form->field($model, 'description')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 100,
                'plugins' => [
                    'clips',
                    'fullscreen'
                ]
            ],
            'value' => $model->description
        ]); ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen'
                ]
            ],
            'value' => $model->content
        ]);?>

    <?= $form->field($model, 'viewed')
        ->textInput(['value' => $model->viewed]) ?>

    <?= $form->field($model, 'user_id')->textInput(['disabled' => 'disabled', 'value' => $model->user_id]) ?>

    <?= $form->field($model, 'status')
        ->label('Видна всем? Да: 1, Нет: 0')
        ->textInput(['value' => $model->status]) ?>
                
    <?/*= $form->field($model, 'tags')->listBox(
            ArrayHelper::map($tags, 'id', 'title'),
            [
                'multiple' => true
            ]
        ) */?>

    <?= $form->field($model, 'category_id')
        ->label('Категория')
        ->dropDownList($categories, $options = [] ) ?>

<?php if ( empty($model->date) ) : ?>

    <?= $form->field($model, 'date')
    ->label('Дата создания')
    ->textInput(['value' => $model->date]) ?>

<?php endif ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
