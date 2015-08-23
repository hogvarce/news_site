<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Pages;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        NavBar::begin([
              'brandLabel' => 'Мой сайт',
              'brandUrl' => Yii::$app->homeUrl,
              'options' => [
                  'class' => 'navbar-inverse navbar-fixed-top',
              ],
          ]);
          // $menuItems = [
          //     ['label' => 'Home', 'url' => ['/main/index']],
          //     ['label' => 'About', 'url' => ['/main/about']],
          //     ['label' => 'Contact', 'url' => ['/main/contact']],
          // ];
          // if (Yii::$app->user->isGuest) {
          //     $menuItems[] = ['label' => 'Login', 'url' => ['/admin']];
          // } else {
          //     $menuItems[] = [
          //         'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
          //         'url' => ['/admin/logout'],
          //         'linkOptions' => ['data-method' => 'post']
          //     ];
          // }
          $menuItems = Pages::getItems();
          if (!Yii::$app->user->isGuest)
            $menuItems[] = [
                     'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                     'url' => ['/admin/logout'],
                     'linkOptions' => ['data-method' => 'post']
                ];
          echo Nav::widget([
              'options' => ['class' => 'navbar-nav navbar-right'],
              'items' => $menuItems,
          ]);
          NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Мой сайт <?= date('Y') ?></p>
            <p class="pull-right">Сделано мой</p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
