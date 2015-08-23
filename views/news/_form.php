<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin([
      'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'title_new')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_new')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'imagemanager'
                ],
                'imageManagerJson' => Url::to(['/news/images-get']),
                'imageUpload' => Url::to(['/news/image-upload']),
            ]
        ]);
    ?>

    <?= $form->field($model, 'preview_new')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'imagemanager'
                ],
                'imageManagerJson' => Url::to(['/news/images-get']),
                'imageUpload' => Url::to(['/news/image-upload']),
            ]
        ]);
    ?>

    <?= $form->field($model, 'data_new')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
