<?php

/* @var $this yii\web\View */

use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
  <div class="testing-test">
    <h3>
      Сайт в режиме
      <br> тестирования!
    </h3>
  </div>


<div id="large-header" class="large-header">
  <canvas id="demo-canvas"></canvas>
  <h1 class="main-title"><a class="link link--takiri" href="#iakor">DomKvartirka<span class="wow fadeInUp animated animated" data-wow-delay=".5s">Люби жизнь такой, какая она есть (&copy;)</span></a></h1>

</div>

</div>
<!--/start-inner-content-->
<!-- blog -->
<div class="blog">
  <!-- container -->
  <div class="container">


    <?php if($categoryOne): ?>

      <div class="blog-info wow fadeInDown animated animated" data-wow-delay=".5s">
       <h2 class="tittle">Категория: <?= $categoryOne->title ?></h2>
     </div>

   <?php endif; ?>


   <div class="blog-top-grids">
    <div class="col-md-4 blog-top-right-grid">
      <div class="categories">
          <h4 class="wow fadeInLeft animated animated" data-wow-delay=".5s">Курс валют: RUR/UAH: <?= get_course() ?></h4>
          <br>
        <h3 class="wow fadeInLeft animated animated" data-wow-delay=".5s">Категории</h3>
        <ul>

          <?php foreach($categories as $category): ?>

            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s">
              <a href="<?= Url::toRoute(['/', 'id' => $category->id]) ?>"><?= $category->title ?></a>
              <span class="post-count pull-right">(<?= $category->getArticles()->count() ?>)</span>
            </li>

          <?php endforeach; ?>

        </ul>
      </div>
    </div>

    <div class="col-md-8 blog-top-left-grid">
      <div class="left-blog">

        <?php foreach ($articles as $article) : ?>

          <div class="blog-left">

            <div class="blog-left-left wow fadeInRight animated animated" data-wow-delay=".5s">
              <p>Статья от <a name="iakor" href="#"><?= $article->user->username ?></a> &nbsp;&nbsp; <?= $article->getDate() ?> &nbsp;&nbsp; <a href="#">(Комментариев: <?= $article->getComment()->count() ?>)</a></p>
              <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>"><img src="<?= $article->getImage(); ?>" alt="image" /></a>
            </div>

            <div class="blog-left-right wow fadeInRight animated animated" data-wow-delay=".5s">
              <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>"> <?= $article->title ?></a>
              <p>
                <?= $article->description ?>
              </p>
            </div>

            <ul class="text-center pull-right">
              <li><i class="fa fa-yey">Количество просмотров&nbsp;&nbsp;</i><?= (int)$article->viewed ?></li>
            </ul>

            <div class="clearfix"> </div>
          </div>

        <?php endforeach; ?>

      </div>
<?php if ($pagination):?>
      <?= LinkPager::widget([
        'pagination' => $pagination,
        ]); ?>
<?php endif ?>

        <hr>
        <hr>
      </div>


      <div class="col-md-4 blog-top-right-grid">
        <div class="comments">
          <h3 class="wow fadeInLeft animated animated" data-wow-delay=".5s">Популярные статьи</h3>

          <?php foreach($popular as $article): ?>

            <div class="comments-text wow fadeInLeft animated animated" data-wow-delay=".5s">
              <div class="col-md-3 comments-left">
                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>">
                  <img src="<?= $article->getImage(); ?>" alt="image" />
                </a>
              </div>
              <div class="col-md-9 comments-right">
                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>"><?= $article->title ?></a> 
                <p><?= $article->getDate() ?></p>
              </div>
              <div class="clearfix"> </div>
            </div>

          <?php endforeach; ?>

        </div>
        <div class="comments">
          <h3 class="wow fadeInLeft animated animated" data-wow-delay=".5s">Последние статьи</h3>

          <?php foreach($recent as $article): ?>

            <div class="comments-text wow fadeInLeft animated animated" data-wow-delay=".5s">
              <div class="col-md-3 comments-left">
                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>">
                  <img src="<?= $article->getImage(); ?>" alt="image" />
                </a>
              </div>
              <div class="col-md-9 comments-right">
                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>"><?= $article->title ?></a> 
                <p><?= $article->getDate() ?></p>
              </div>
              <div class="clearfix"> </div>
            </div>

          <?php endforeach; ?>

        </div>
        <div class="comments">
          <h3 class="wow fadeInLeft animated animated" data-wow-delay=".5s">Облако тегов</h3>

          <div class="tags">
            <?php foreach($tags as $tag) : ?>
              <a href="<?= Url::toRoute(['tags', 'id' => $tag['id']]) ?>"><?= $tag['title'] ?></a> |
            <?php endforeach; ?>
          </div>

        </div>
      </div>
      
      <div class="clearfix"> </div>
    </div>
  </div>
  <!-- //container -->
</div>
<!-- //blog -->
<!--//end-inner-content-->

