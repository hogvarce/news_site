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

  public function actions()
  {
      return [
          'error' => [
              'class' => 'yii\web\ErrorAction',
          ],
          'captcha' => [
              'class' => 'yii\captcha\CaptchaAction',
              'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
          ],
      ];
  }

  public function actionIndex()
  {
      $page = Pages::findOne([
          'slug' => '/',
      ]);
      $news = new ActiveDataProvider([
          'query' => News::find(),
          'sort'=>[
            'defaultOrder'=>['data_new' => SORT_DESC],
          ],
          'pagination' => [
              'pageSize' => 3,
              'validatePage' => false,
          ],
      ]);

      // if ($page == null) {
      //       return $this->render('error');
      // }
      return $this->render('index', [
          'page' => $page,
          'news' => $news,
      ]);
  }

  public function actionPage($view)
  {
    $page = Pages::findOne([
        'slug' => '/'.$view,
    ]);
    if ($page == null) {
          return $this->render('error');
    }
    $news = new ActiveDataProvider([
        'query' => News::find(),
        'sort'=>[
          'defaultOrder'=>['data_new' => SORT_DESC],
        ],
        'pagination' => [
            'pageSize' => 3,
            'validatePage' => false,
        ],
    ]);

    return $this->render('index', [
        'page' => $page,
        'news' => $news,
    ]);
  }

  public function actionNew($id)
  {
    $new = News::findOne([
        'id_new' => $id,
    ]);
      return $this->render('new', [
          'new' => $new,
        ]);
  }


}
