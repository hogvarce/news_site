<?php
use yii\helpers\Html;
use yii\grid\GridView;
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 headerrow">
            <div class="pull-right">
                <?= Yii::$app->formatter->asDate(time()) ?>
            </div>
          </div>
        </div>
      </div>
        <?php
        NavBar::begin([
              'options' => [
                  'class' => 'navbar navbar-default navbar-static-top',
              ],
          ]);
          $menuItems = Pages::getItems();
          if (!Yii::$app->user->isGuest)
            $menuItems[] = [
                     'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                     'url' => ['/admin/logout'],
                     'linkOptions' => ['data-method' => 'post']
                ];
          echo Nav::widget([
              'options' => ['class' => 'navbar-nav navbar-left'],
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
