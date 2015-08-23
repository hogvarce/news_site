<?php

namespace app\controllers;

use Yii;
use app\models\News;
use app\models\NewsSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\helpers\Url;
use vova07\imperavi\actions\GetAction;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */

     public function actions()
     {
         return [
             'image-upload' => [
                 'class' => 'vova07\imperavi\actions\UploadAction',
                 'url' => '/images', // Directory URL address, where files are stored.
                 'path' => Yii::getAlias('@webroot/images'), // Or absolute path to directory where files are stored.webroot
             ],
             'images-get' => [
                   'class' => 'vova07\imperavi\actions\GetAction',
                   'url' => '/images', // Directory URL address, where files are stored.
                   'path' => Yii::getAlias('@webroot/images'), // Or absolute path to directory where files are stored.
                   'type' => GetAction::TYPE_IMAGES,
               ]
         ];
     }
    public function actionIndex()
    {
      if (!\Yii::$app->user->isGuest) {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
      }
      $model = new LoginForm();
      if ($model->load(\Yii::$app->request->post()) && $model->login()) {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
      } else {
          return $this->render('login', [
              'model' => $model,
          ]);
      }
    }

    /**
     * Displays a single News model.
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
          $searchModel = new NewsSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->isGuest) {
          $model = new News();
          $max = NewsSearch::find()->select('max(id_new)')->scalar()+1;
          if ($model->load(Yii::$app->request->post())) {
              if ( $model->file = UploadedFile::getInstance($model, 'file') ){
                $model->file->saveAs('images/new-'.$max.'.'.$model->file->extension);
                $model->smallimg_new = '/images/new-'.$max.'.'.$model->file->extension;
              }
              $model->save();
              return $this->redirect(['view', 'id' => $model->id_new]);
          } else {
              return $this->render('create', [
                  'model' => $model,
              ]);
          }
        }
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
          $searchModel = new NewsSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      if (!\Yii::$app->user->isGuest) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ( $model->file = UploadedFile::getInstance($model, 'file') ){
              $model->file->saveAs('images/new-'.$model->id_new.'.'.$model->file->extension);
              $model->smallimg_new = '/images/new-'.$model->id_new.'.'.$model->file->extension;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_new]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
      }
      $model = new LoginForm();
      if ($model->load(\Yii::$app->request->post()) && $model->login()) {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
      } else {
          return $this->render('login', [
              'model' => $model,
          ]);
      }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      if (!\Yii::$app->user->isGuest) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
      }
      $model = new LoginForm();
      if ($model->load(\Yii::$app->request->post()) && $model->login()) {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
      } else {
          return $this->render('login', [
              'model' => $model,
          ]);
      }
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
      if (!\Yii::$app->user->isGuest) {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
      }
      $model = new LoginForm();
      if ($model->load(\Yii::$app->request->post()) && $model->login()) {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
      } else {
          return $this->render('login', [
              'model' => $model,
          ]);
      }
    }

}
