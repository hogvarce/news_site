<?php
  use yii\helpers\Html;
?>
<div class="col-xs-9 new">
  <h2><?= Html::a($model->title_new, ['/new/'.$model->id_new])?></h2>
  <div class="clearfix"></div>
  <div class="col-xs-3">
    <?php if ( $model->smallimg_new ) : ?>
      <?= Html::a(Html::img($model->smallimg_new, ['alt' => $model->title_new, 'width' => '200']), ['/new/'.$model->id_new]) ?>
    <?php endif; ?>
  </div>
  <div class="col-xs-9">
    <?=$model->data_new?>
    <?=$model->preview_new?>
    <?= Html::a('читать дальше', ['/new/'.$model->id_new], ['class' => 'more']) ?>
  </div>
  <div class="clearfix"></div>
</div>
