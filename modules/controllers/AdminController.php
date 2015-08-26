<?php

namespace app\modules\controllers;

use Yii;
use app\models\Pages;
use app\models\News;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\helpers\Url;
use vova07\imperavi\actions\GetAction;

/**
 * AdminController implements the CRUD actions for Pages model.
 */
class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pages models.
     * @return mixed
     */

     public function actions()
     {
         return [
             'image-upload' => [
                 'class' => '/vova07\imperavi\actions\UploadAction',
                 'url' => '/images', // Directory URL address, where files are stored.
                 'path' => Yii::getAlias('@webroot/images'), // Or absolute path to directory where files are stored.webroot
             ],
             'images-get' => [
                   'class' => '/vova07\imperavi\actions\GetAction',
                   'url' => '/images', // Directory URL address, where files are stored.
                   'path' => Yii::getAlias('@webroot/images'), // Or absolute path to directory where files are stored.
                   'type' => GetAction::TYPE_IMAGES,
               ]
         ];
     }

    public function actionIndex()
    {
      if (!\Yii::$app->user->isGuest) {
          $dataProvider = new ActiveDataProvider([
              'query' => Pages::find(),
          ]);
          return $this->render('index',
            ['dataProvider' => $dataProvider,]
          );
      }

      $model = new LoginForm();
      if ($model->load(\Yii::$app->request->post()) && $model->login()) {
          $dataProvider = new ActiveDataProvider([
              'query' => Pages::find(),
          ]);
          return $this->render('index',
            ['dataProvider' => $dataProvider,]
          );
      } else {
          return $this->render('login', [
              'model' => $model,
          ]);
      }
    }

    // public function actionNews()
    // {
    //   if (!\Yii::$app->user->isGuest) {
    //       $dataProvider = new ActiveDataProvider([
    //           'query' => News::find(),
    //       ]);
    //       return $this->render('news',
    //         ['dataProvider' => $dataProvider,]
    //       );
    //   }
    //
    //   $model = new LoginForm();
    //   if ($model->load(\Yii::$app->request->post()) && $model->login()) {
    //       $dataProvider = new ActiveDataProvider([
    //           'query' => Pages::find(),
    //       ]);
    //       return $this->render('index',
    //         ['dataProvider' => $dataProvider,]
    //       );
    //   } else {
    //       return $this->render('login', [
    //           'model' => $model,
    //       ]);
    //   }
    // }


    /**
     * Displays a single Pages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!\Yii::$app->user->isGuest) {
          return $this->render('view', [
              'model' => $this->findModel($id),
          ]);
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            $dataProvider = new ActiveDataProvider([
                'query' => Pages::find(),
            ]);
            return $this->render('index',
              ['dataProvider' => $dataProvider,]
            );
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      if (!\Yii::$app->user->isGuest) {
        $model = new Pages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
      }

      $model = new LoginForm();
      if ($model->load(\Yii::$app->request->post()) && $model->login()) {
          $dataProvider = new ActiveDataProvider([
              'query' => Pages::find(),
          ]);
          return $this->render('index',
            ['dataProvider' => $dataProvider,]
          );
      } else {
          return $this->render('login', [
              'model' => $model,
          ]);
      }

    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->isGuest) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
      }

      $model = new LoginForm();
      if ($model->load(\Yii::$app->request->post()) && $model->login()) {
          $dataProvider = new ActiveDataProvider([
              'query' => Pages::find(),
          ]);
          return $this->render('index',
            ['dataProvider' => $dataProvider,]
          );
      } else {
          return $this->render('login', [
              'model' => $model,
          ]);
      }

    }

    /**
     * Deletes an existing Pages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
