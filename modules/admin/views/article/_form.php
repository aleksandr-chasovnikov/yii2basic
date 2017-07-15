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

    <?= $form->field($model, 'title')->label('Заголовок')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->label('Краткое описание')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'content')->label('Текст')->textarea(['rows' => 8]) ?>
    <?= $form->field($model, 'viewed')->label('Количество просмотров')->textInput(['value' => 0]) ?>
    <?//= $form->field($model, 'user_id')->label('ID автора')->textInput(['value' => \Yii::$app->user->identity->id]) ?>
    <?= $form->field($model, 'status')->label('Виден всем? Да: 1, Нет: 0')->textInput(['value' => 1]) ?>
    <?= $form->field($model, 'category_id')->label('Категория')->dropDownList( ArrayHelper::getColumn( $categories, 'title'), $options = [] ) ?>

<?php if ( empty($model->date) ) : ?>
    <?= $form->field($model, 'date')->label('Дата создания')->textInput(['value' => date('d-m-Y')]) ?>
<?php endif ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
