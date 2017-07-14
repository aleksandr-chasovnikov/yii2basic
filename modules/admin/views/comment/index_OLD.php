<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<table class="table">
    <thead>
        <tr>
            <td>#</td>
            <td>Автор</td>
            <td>Текст</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($comments as $comment): ?>
        <tr>
            <td><?= $comment->id ?></td>
            <td><?= $comment->user->name ?></td>
            <td><?= $comment->text ?></td>
            <td>
                <form action="delete" class="form-group form" method="post">
                    <input type="hidden" name="id" value="<?= $comment->id ?>" />
                    <input class="btn btn-danger" type="submit" value="Удалить" />
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
</div>
