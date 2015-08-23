<div class="col-xs-12">
  <h2><?=$model->title_new?></h2>
  <div class="clearfix"></div>
  <div class="col-xs-4">
    <?php if ( $model->smallimg_new ) : ?>
      <img src="<?=$model->smallimg_new?>" alt="<?=$model->title_new?>" width="200" />
    <?php endif; ?>
  </div>
  <div class="col-xs-8">
    <?=$model->data_new?>
    <?=$model->preview_new?>
  </div>
  <div class="clearfix"></div>
</div>
