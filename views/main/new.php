<?php
  use yii\helpers\Html;
?>
<div class="row">
  <div class="col-xs-12">
    <h1><?=$new->title_new?></h1>
    <?=Html::img($new->smallimg_new, ['alt'=>$new->title_new, 'class'=>'pull-right'])?>
    <?=$new->content_new;?>
  </div>
</div>
