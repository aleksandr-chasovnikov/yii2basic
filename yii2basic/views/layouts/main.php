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
             <li class="m_nav_item" id="moble_nav_item_3"> <a href="/site/contact" class="link link--kumya scroll"><span data-letters="Контакты">Контакты</span></a></li>

         <?php if (\Yii::$app->user->isGuest): ?>

               <li class="m_nav_item" id="moble_nav_item_5"> <a href="/auth/login" class="link link--kumya scroll"><span data-letters="Вход">Вход&nbsp;</span></a></li>
               <li class="m_nav_item" id="moble_nav_item_6"> <a href="/auth/signup" class="link link--kumya scroll"><span data-letters="Регистрация">Регистрация</span></a></li>


         <?php else: ?>

          <?php if (\Yii::$app->user->identity->isAdmin): ?>
               <li class="m_nav_item" id="moble_nav_item_6"> <a href="/admin/article/index" class="link link--kumya scroll"><span data-letters="Админ">Админ-панель</span></a></li>
          <?php endif ?>

              <li class="m_nav_item" id="moble_nav_item_6">
                <a href="#" class="link link--kumya scroll">
                  <span data-letters="<?= \Yii::$app->user->identity->username; ?>">Привет, <?= \Yii::$app->user->identity->username; ?></span>
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

    <!--copy-right-->
    <div class="copy">
      <p class="wow fadeInUp animated animated" data-wow-delay=".5s">&copy; <?= date('Y') ?> DomKvartirka . Все права защищены </p>
    </div>
    <!--//copy-right-->
    <!--//footer-->
    <a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"></span></a>

    <div class="container">
        <p class="pull-left">Создатель: <a href="/site/contact">Александр Часовников</a></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
  </footer>


  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();die; ?>
