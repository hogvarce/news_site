<?php
  use yii\widgets\ListView;
?>

<div class="row">
  <div class="col-xs-12">
    <h1><?=$page->h1?></h1>
    <?=$page->content;?>
    <?php if ($page->render_news) : ?>
    <div class="news row">
      <?php
      // foreach ($news->models as $model) {
      //     echo $this->render('shortNew', [
      //         'model' => $model
      //     ]);
      // }
      // $news->pagination = [
      //   'pageSize' => 2,
      //   'validatePage' => false,
      // ];
      ?>
      <?= ListView::widget([
          'dataProvider' => $news,
          'itemView' => 'shortNew',
        //  'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
        ])
        ?>
    </div>
  <?php endif; ?>
  </div>
</div>
