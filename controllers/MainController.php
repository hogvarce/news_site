<?php

namespace app\controllers;

use Yii;
use app\models\Pages;
use app\models\News;
use app\models\NewsSearch;
use app\actions\ListActions;
use app\models\PagesSearch;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class MainController extends \yii\web\Controller
{
  public function actionIndex()
  {
      $page = Pages::findOne([
          'slug' => Yii::$app->request->url,
        ]);
        $news = new ActiveDataProvider([
            'query' => News::find(),
        ]);

      if ($page == null) {
            return $this->render('error');
      }
      return $this->render('index', [
          'page' => $page,
          'news' => $news,
      ]);
  }


}
