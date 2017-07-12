<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

?>

	<div class="blog">
			<!-- container -->
			<div class="container">
			  <h3 class="tittle"><?= $article->title ?></h3>
				<div class="col-md-8 blog-top-left-grid">
					<div class="left-blog left-single">
						<div class="blog-left">
							<div class="single-left-left wow fadeInRight animated animated" data-wow-delay=".5s">
								<p>Статья от <a href="#">Admin</a> &nbsp;&nbsp; <?= $article->getDate() ?> &nbsp;&nbsp; <a href="#">Comments (10)</a></p>
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
							<h3 class="wow fadeInRight animated animated" data-wow-delay=".5s">Комментарии</h3>

							<!-- foreach -->

							<div class="media response-info">
								<div class="media-left response-text-left wow fadeInRight animated animated" data-wow-delay=".5s">
									<a href="#">
										<img class="media-object" src="GoEasyOn/images/t1.jpg" alt="">
									</a>
									<h5><a href="#">Admin</a></h5>
								</div>

								<div class="media-body response-text-right">
									<p class="wow fadeInRight animated animated" data-wow-delay=".5s">Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
										sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
									<ul class="wow fadeInRight animated animated" data-wow-delay=".5s">
										<li>Mar 24,2016</li>
										<li><a href="single.html">Ответить</a></li>
									</ul>


							<!-- foreach -->

									<div class="media response-info">
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
									</div>

							<!-- end foreach -->

								</div>

								<div class="clearfix"> </div>
							</div>

							<!-- end foreach -->

						</div>
						<div class="opinion">
							<h3 class="wow fadeInRight animated animated" data-wow-delay=".5s">Оставьте свой комментарий</h3>
							<form class="wow fadeInRight animated animated" data-wow-delay=".5s">
								<input type="text" placeholder="Name" required="">
								<input type="text" placeholder="Email" required="">
								<textarea placeholder="Message" required=""></textarea>
								<input type="submit" value="SEND">
							</form>
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
        <div class="categories">
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
        </div>
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
      </div>
      
      <div class="clearfix"> </div>
    </div>
  </div>
  <!-- //container -->
</div>
<!-- //blog -->
<!--//end-inner-content-->
	<!-- //blog -->