<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use app\models\Article;

?>

	<div class="blog">
			<!-- container -->
			<div class="container">
			  <h3 class="tittle"><?= $article->title ?></h3>
				<div class="col-md-8 blog-top-left-grid">
					<div class="left-blog left-single">
						<div class="blog-left">
							<div class="single-left-left wow fadeInRight animated animated" data-wow-delay=".5s">
								<p>Статья от <a href="#"><?= $article->user->name ?></a> &nbsp;&nbsp; <?= $article->getDate() ?> &nbsp;&nbsp; <a href="#comments">(Комментариев: <?= $article->getComment()->count() ?>)</a></p>
								<img src="<?= $article->getImage(); ?>" alt="image" />
							</div>

							<!-- foreach -->

							<div class="blog-left-bottom wow fadeInRight animated animated" data-wow-delay=".5s">
								<p><?= $article->content ?>
								</p>
							</div>

							<!-- end foreach -->

						</div>
						<div class="response">
							<h3 class="wow fadeInRight animated animated" data-wow-delay=".5s"><a name="comments">Комментарии</a></h3>

					<?php if(!empty($comments)): ?>
						<?php foreach($comments as $comment): ?>

							<div class="media response-info">
								<div class="media-left response-text-left wow fadeInRight animated animated" data-wow-delay=".5s">
									<img width="50" class="media-object" src="<?= $comment->user->image; ?>" alt="">
									<h5><?= $comment->user->name; ?></h5>
								</div>

								<div class="media-body response-text-right">
									<p class="wow fadeInRight animated animated" data-wow-delay=".5s"><?= $comment->text; ?></p>
									<ul class="wow fadeInRight animated animated" data-wow-delay=".5s">
										<li><?= $comment->getDate(); ?></li>
										<li><a href="#com">Ответить</a></li>

			<?php if( (($comment->user->name) 
						== (\Yii::$app->user->identity->name)) 
							|| Yii::$app->user->identity->isAdmin ): ?>

										<li><a href="#com" class="btn btn-danger">Удалить</a></li>
			<?php endif ?>
									</ul>


							<!-- end foreach -->

						<!-- 			<div class="media response-info">
										<div class="media-left response-text-left wow fadeInRight animated animated" data-wow-delay=".5s">
											<a href="#">
												<img class="media-object" src="GoEasyOn/images/t2.jpg" alt="">
											</a>
											<h5><a href="#">Admin</a></h5>
										</div>
										<div class="media-body response-text-right wow fadeInRight animated animated" data-wow-delay=".5s">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
												sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
											<ul>
												<li>Mar 28,2016</li>
												<li><a href="single.html">Ответить</a></li>
											</ul>		
										</div>
										<div class="clearfix"> </div>
									</div> -->

							<!-- end foreach -->

								</div>

								<div class="clearfix"> </div>
							</div>

					<?php endforeach; ?>
					<?php endif ?>

						</div>
						<div class="opinion">
							<h3 class="wow fadeInRight animated animated" data-wow-delay=".5s"><a name="com">Оставьте свой комментарий</a></h3>
							
<?php $form = \yii\widgets\ActiveForm::begin([
	'action' =>['site/comment', 'id' => $article->id],
	'options' =>['class' => 'wow fadeInRight animated animated', 'role' => 'form']]); ?>

    <?php if ( \Yii::$app->user->isGuest ) : ?>

    	<?= $form->field($commentForm, 'name')
			    	->label('')
			    	->textInput(['placeholder' => 'Имя']) ?>

	    <?= $form->field($commentForm, 'email')
				    ->label('')
				    ->textInput(['placeholder' => 'Ваш Email']) ?>

	<?php endif ?>

	    <?= $form->field($commentForm, 'comment')
				    ->label('')
				    ->textarea(['rows' => 6, 'placeholder' => 'Комментарий']) ?>

    <input type="submit" value="Отправить">

<?php \yii\widgets\ActiveForm::end(); ?>

						</div>
					</div>
				</div>
      <div class="col-md-4 blog-top-right-grid">
        <div class="categories">
          <h3 class="wow fadeInLeft animated animated" data-wow-delay=".5s">Категории</h3>
          <ul>

            <?php foreach($categories as $category): ?>

              <li class="wow fadeInLeft animated animated" data-wow-delay=".5s">
              <a href="<?= Url::toRoute(['site/category', 'id' => $category->id]) ?>"><?= $category->title ?></a>
                <span class="post-count pull-right">(<?= $category->getArticles()->count() ?>)</span>
              </li>

            <?php endforeach; ?>

          </ul>
        </div>
<!--         <div class="categories">
          <h3 class="wow fadeInLeft animated animated" data-wow-delay=".5s">Архив</h3>
          <ul class="marked-list offs1">
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">May 2016 (7)</a></li>
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">April 2016 (11)</a></li>
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">March 2016 (12)</a></li>
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">February 2016 (14)</a> </li>
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">January 2016 (10)</a></li>    
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">December 2014 (12)</a></li>
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">November 2014 (8)</a></li>
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">October 2014 (7)</a> </li>
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">September 2014 (8)</a></li>
            <li class="wow fadeInLeft animated animated" data-wow-delay=".5s"><a href="#">August 2014 (6)</a></li>                          
          </ul>
        </div> -->
        <div class="comments">
          <h3 class="wow fadeInLeft animated animated" data-wow-delay=".5s">Популярные статьи</h3>

          <?php foreach($popular as $article): ?>

            <div class="comments-text wow fadeInLeft animated animated" data-wow-delay=".5s">
              <div class="col-md-3 comments-left">
                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>">
                  <img src="<?= (new Article)->getImage($article->image); ?>" alt="image" />
                </a>
              </div>
              <div class="col-md-9 comments-right">
                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>"><?= $article->title ?></a> 
                <p><?= (new Article)->getDate($article->date) ?></p>
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
                  <img src="<?= (new Article)->getImage($article->image); ?>" alt="image" />
                </a>
              </div>
              <div class="col-md-9 comments-right">
                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>"><?= $article->title ?></a> 
                <p><?= (new Article)->getDate($article->date) ?></p>
              </div>
              <div class="clearfix"> </div>
            </div>

          <?php endforeach; ?>

        </div>
      </div>
      
      <div class="clearfix"> </div>
    </div>
  </div>
  <!-- //container -->
</div>
<!-- //blog -->
<!--//end-inner-content-->

