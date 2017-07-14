<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\MyAsset;

MyAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
  <?php $this->beginBody() ?>

  <div class="container demo-2" id="home">
    <!--carbonads-container-->
    <div class="content">
     <div class="w3_agile_menu">
       <div class="agileits_w3layouts_nav">
        <div id="toggle_m_nav">
          <div id="m_nav_menu" class="m_nav">
            <div class="m_nav_ham w3_agileits_ham" id="m_ham_1"></div>
            <div class="m_nav_ham" id="m_ham_2"></div>
            <div class="m_nav_ham" id="m_ham_3"></div>
          </div>
        </div>
        <div id="m_nav_container" class="m_nav wthree_bg">
          <nav class="menu menu--sebastian">
            <ul id="m_nav_list" class="m_nav menu__list">
              <li class="m_nav_item active" id="m_nav_item_1">
               <a href="/" class="link link--kumya">
                 <i class="fa fa-home" aria-hidden="true"></i>
                 <span data-letters="Главная">Главная</span>
               </a>
             </li>
             <li class="m_nav_item" id="moble_nav_item_2"> <a href="/site/about" class="link link--kumya scroll"><span data-letters="О проекте">О проекте</span></a></li>
             <li class="m_nav_item" id="moble_nav_item_3"> <a href="/site/about" class="link link--kumya scroll"><span data-letters="Контакты">Контакты</span></a></li>

         <?php if (\Yii::$app->user->isGuest): ?>

               <li class="m_nav_item" id="moble_nav_item_5"> <a href="/auth/login" class="link link--kumya scroll"><span data-letters="Вход">Вход&nbsp;</span></a></li>
               <li class="m_nav_item" id="moble_nav_item_6"> <a href="/auth/signup" class="link link--kumya scroll"><span data-letters="Регистрация">Регистрация</span></a></li>


         <?php else: ?>

          <?php if (\Yii::$app->user->identity->isAdmin): ?>
               <li class="m_nav_item" id="moble_nav_item_6"> <a href="/admin/default/index" class="link link--kumya scroll"><span data-letters="Админ">Админ-апнель</span></a></li>
          <?php endif ?>

              <li class="m_nav_item" id="moble_nav_item_6">
                <a href="#" class="link link--kumya scroll">
                  <span data-letters="<?= \Yii::$app->user->identity->name; ?>">Привет, <?= \Yii::$app->user->identity->name; ?></span>
                </a>
              </li>
              <li class="m_nav_item" id="moble_nav_item_6">
                <a href="/auth/logout" class="link link--kumya scroll">
                  <span data-letters="Выход">Выход</span>
                </a>
              </li>

                <?php endif; ?>

              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>



    <?= $content ?>


    <!-- footer-section -->
<footer class="footer">
    <div class="bottom-middle">
      <div class="bottom-middle-top">
        <div class="container">
          <div class="col-md-6 bottom-grid wow fadeInUp animated animated" data-wow-delay=".5s">
            <h5>NewsLetter</h5>
            <p>Lorem ipsum dolor sit amet, tristique nec libero. Proin vitae convallis odio. Morbi nec enim nisi. Aliquam erat volutpat. </p>
            <form>                   
              <input type="text" placeholder="Enter Email..." required="" />

              <input type="submit" value="Submit">
              <div class="clearfix"></div>
            </form>
          </div>
          <div class="col-md-6 bottom-grid wow fadeInUp animated animated" data-wow-delay=".5s">
            <h5>Twitter Feed</h5>
            <p>Check out th best designs online in the world <br>at <a href="mail-to:mail@example.com">http://example.com </a></p>
            <span>1 day ago</span>
            <p><a href="#">Twitter</a>, may be the more visual platform for education group.</p>
            <span>4 day ago</span>
          </div>

          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <!-- //footer-section -->
    <div class="map-bottom">
      <div class="col-md-4 adrs-left wow fadeInUp animated animated" data-wow-delay=".5s">
        <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
        <p>San Francisco, CA 94107.</p>
      </div>
      <div class="col-md-4 adrs-left adrs-middle wow fadeInUp animated animated" data-wow-delay=".5s">
        <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
        <p>+655 8654 7799 , +055 726 3845</p>
      </div>
      <div class="col-md-4 adrs-left adrs-right wow fadeInUp animated animated" data-wow-delay=".5s">
        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
        <p><a href="mailto:example@email.com">mail@example.com</a></p>
      </div>
      <div class="clearfix"></div>
    </div>
    <!--//map-->
    <!--//contact-->

    <!--copy-right-->
    <div class="copy">
      <p class="wow fadeInUp animated animated" data-wow-delay=".5s">&copy; 2016 Go Easy On . All Rights Reserved | Design by <a href="http://w3layouts.com/">W3layouts</a> </p>
    </div>
    <!--//copy-right-->
    <!--//footer-->
    <a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"></span></a>

    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
  </footer>

  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
