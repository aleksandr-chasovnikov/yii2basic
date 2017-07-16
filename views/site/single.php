<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use app\models\Article;
use yii\helpers\Html;

//Тестовые данные
$faker = Faker\Factory::create('en_US');
?>

<div class="blog">
	<!-- container -->
	<div class="container">
		<h3 class="title"><?= $model->title ?></h3>
		<div class="col-md-8 blog-top-left-grid">
			<div class="left-blog left-single">
				<div class="blog-left">
					<div class="single-left-left wow fadeInRight animated animated" data-wow-delay=".5s">
						<p>Статья от <a href="#"><?= $model->user->name ?></a> &nbsp;&nbsp; <?= $model->getDate() ?> &nbsp;&nbsp; <a href="#comments">(Комментариев: <?//= $model->getComment()->count() ?>)</a></p>
						<img src="<?= $model->getImage(); ?>" alt="image" />
					</div>

					<!-- foreach -->

					<div class="blog-left-bottom wow fadeInRight animated animated" data-wow-delay=".5s">
						<p><?= $model->content ?>
						</p>
					</div>

					<!-- end foreach -->

				</div>
				<div class="response">
					<h3 class="wow fadeInRight animated animated" data-wow-delay=".5s"><a name="comments">Комментарии</a></h3>
<?php echo \yii2mod\comments\widgets\Comment::widget([
    'model' => $model,
]); ?>
					<?php // if(!empty($comments)): ?>
						<?php //foreach($comments as $comment): ?>

							<div class="media response-info">
								<div class="media-left response-text-left wow fadeInRight animated animated" data-wow-delay=".5s">
									<img width="50" class="media-object" src="

									<?php if(!empty($comment->user->image)): ?>
										<?= $comment->user->image; ?>
									<?php else: ?>
										<?= '/no-image.png' ?>
									<?php endif ?>

									" alt="image">

									<h5><?//= $comment->user->name; ?></h5>
								</div>

								<div class="media-body response-text-right">
									<p class="wow fadeInRight animated animated" data-wow-delay=".5s"><?//= $comment->text; ?></p>
									<ul class="wow fadeInRight animated animated" data-wow-delay=".5s">
										<li><?//= $comment->getDate(); ?></li>

										<?php if(  !\Yii::$app->user->isGuest): ?>

											<li><a href="#com">Ответить</a></li>
											
											<!-- Если пользоваетль не гость и является владельцем данного комментария или данный пользователь - это админ, то он имеет право удалить комментарий -->
											<?php //if( $comment->user->name == \Yii::$app->user->identity->name  
											//|| !empty( Yii::$app->user->identity->isAdmin ) ): ?>

											
											<?/*= Html::a('Удалить', ['comment/delete', 'id' => $comment->id], [
												'class' => 'btn btn-danger',
												'data' => [
												'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
												'method' => 'post',
												],
												]) ?>
											<?php endif ?>
										<?php endif */?>				</ul>


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

						<?php //endforeach; ?>
					<?php endif ?>

				</div>

				<?php if(  !\Yii::$app->user->isGuest): ?>

					<div class="opinion">
						<h3 class="wow fadeInRight animated animated" data-wow-delay=".5s"><a name="com">Оставьте свой комментарий</a></h3>

						<?php if( Yii::$app->session->getFlash('comment') ): ?>
							<div class="alert alert-success" role="alert">
								<?= Yii::$app->session->getFlash('comment') ?>
							</div>
						<?php endif ?>
						
						<?php $form = \yii\widgets\ActiveForm::begin([
							'action' =>['site/comment', 'id' => $article->id],
							'options' =>['class' => 'wow fadeInRight animated animated', 'role' => 'form']]); ?>

							<?php if ( \Yii::$app->user->isGuest ) : ?>

								<?= $form->field($commentForm, 'name')
								->label('')
								->textInput(['placeholder' => 'Имя', 'value' => $faker->name]) ?>

								<?= $form->field($commentForm, 'email')
								->label('')
								->textInput(['placeholder' => 'Ваш Email', 'value' => $faker->email]) ?>

							<?php endif ?>

							<?= $form->field($commentForm, 'comment')
							->label('')
							->textarea(['rows' => 6, 'placeholder' => 'Комментарий', 'value' => $faker->realText(50)]) ?>

							<input type="submit" value="Отправить">

							<?php \yii\widgets\ActiveForm::end(); ?>

						</div>

					<?php endif ?>

				</div>
			</div>
			<div class="col-md-4 blog-top-right-grid">
				<div class="categories">
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

