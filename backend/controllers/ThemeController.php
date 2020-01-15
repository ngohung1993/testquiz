<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\SeoTool;
use common\models\Category;
use common\models\base\Theme;
use common\models\TopicSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\FunctionHelper;
use yii\data\Pagination;

/**
 * ThemeController implements the CRUD actions for Topics model.
 */
class ThemeController extends Controller
{
    /**
     * {@inheritdoc}
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

    /**
     * @param null $title
     * @param null $key_name
     * @param null $status
     * @param null $type
     * @return array
     */
    public function search($title = null, $key_name = null, $status = null, $type = null)
    {
        $query = null;
        $query= Theme::find()->joinWith('user');
        if($title){
            $query->andFilterWhere(['like', 'title', $title]);
        }

        if($key_name){
            $query->andFilterWhere(['like', 'user.last_name', $key_name]);
        }
        if($status){
            $query->andWhere(['=','topic.status', $status]);
        }

        if($type){
            $query->andWhere(['=','topic.type', $type]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 24,
            'totalCount' => $query->count(),
        ]);

        $theme = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('id DESC')
            ->all();

        return [
            'theme' => $theme,
            'pages' => $pages,
        ];
    }

    /**
     * Lists all Topics models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TopicSearch();
        $searchModel->load(Yii::$app->request->get());
        $result = $this->search($searchModel->title,$searchModel->key_name, $searchModel->status, $searchModel->type);

        return $this->render('index', [
            'topic' => $result['theme'],
            'pages'     => $result['pages'],
            'searchModel' => $searchModel,
        ]);
    }


    /**
     * Displays a single Topics model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Topics model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Theme();
        $seo = new SeoTool();
        $categories = Category::find()->all();

        if ( $model->load( Yii::$app->request->post() ) && $seo->load( Yii::$app->request->post() ) ) {
            $seo->save();
            $model->seo_tool_id = $seo->id;

            $model->created_at = date('Y-m-d H:i:s', time() + 7 * 3600);
            $model->updated_at = date('Y-m-d H:i:s', time() + 7 * 3600);
            $model->save();

            $model->slug = FunctionHelper::slug( $model->title ) . '-' . $model->id;
            $model->save();

            return $this->redirect( [ 'index' ] );
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo,
            'categories' =>$categories,
        ]);
    }

    /**
     * Updates an existing Topics model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Topics model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Topics model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Topics the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Theme::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
