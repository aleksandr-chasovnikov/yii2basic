
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