<?php

namespace app\admin\controllers;

use dench\image\models\Image;
use dench\sortable\actions\SortingAction;
use Yii;
use app\models\Team;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeamController implements the CRUD actions for Team model.
 */
class TeamController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'sorting' => [
                'class' => SortingAction::className(),
                'query' => Team::find(),
            ],
        ];
    }

    /**
     * Lists all Team models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Team::find(),
            'sort'=> [
                'defaultOrder' => [
                    'position' => SORT_ASC,
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Team model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Team model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Team();

        $model->loadDefaultValues();

        if ($post = Yii::$app->request->post()) {
            $model->load($post);
            /** @var Image $image */
            if ($image = $model->image) {
                $image->load($post);
            }

            $error = [];
            if (!$model->validate()) $error['model'] = $model->errors;
            if ($image && !$image->validate()) $error['image'] = $image->errors;

            if (empty($error)) {
                if ($image) {
                    $image->save(false);
                }
                $model->save(false);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Information added successfully.'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Team model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModelMulti($id);

        if ($post = Yii::$app->request->post()) {
            $old_id = $model->image_id;
            $model->image_id = null;
            $model->load($post);
            /** @var Image $image */
            if ($image = $model->image) {
                $image->load($post);
            }
            $deleted_id = ($old_id != $model->image_id) ? $old_id : null;

            $error = [];
            if (!$model->validate()) $error['model'] = $model->errors;
            if ($image && !$image->validate()) $error['image'] = $image->errors;

            if (empty($error)) {
                if ($image) {
                    $image->save(false);
                }
                if ($deleted_id && $deleted_image = Image::findOne($deleted_id)) {
                    $deleted_image->delete();
                }
                $model->save(false);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Information has been saved successfully.'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Team model.
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
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Team|\yii\db\ActiveRecord
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelMulti($id)
    {
        if (($model = Team::find()->where(['id' => $id])->multilingual()->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
