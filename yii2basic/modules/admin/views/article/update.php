<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

if ( !empty($model->id)):

$this->title = 'Изменить статью: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', compact('model', 'categories')) ?>

<?php else: 

$this->title = 'Создать статью';
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title
?>

<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create', compact('model', 'categories')) ?>

<?php endif ?>



</div>
