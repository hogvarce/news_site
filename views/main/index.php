<?php
  use yii\grid\GridView;
?>

<div class="row">
  <div class="col-xs-12">
    <h1><?=$page->h1?></h1>
    <?=$page->content;?>
    <?php if ($page->render_news) : ?>
    <div class="news row">
      <?php
      foreach ($news->models as $model) {
          echo $this->render('shortNew', [
              'model' => $model
          ]);
      }
      ?>
    </div>
  <?php endif; ?>
  </div>
</div>
