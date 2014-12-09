<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use backend\models\AdminLoginForm;
use common\models\User;
use common\models\article\ArticleComment;
use common\models\article\Article;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest ? 'account' : 'main';
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $usersCount = User::find()
            ->where(['status' => User::STATUS_ACTIVE])
            ->count();

        $articlesCount = Article::find()->count();

        $commentsCount = ArticleComment::find()->count();

        $query = User::find()
            ->select(['username', 'created'])
            ->where(['status' => User::STATUS_ACTIVE])
            ->orderBy(['created' => SORT_DESC]);

        $users = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ],
        ]);
        $users->sort = false;

        $query = ArticleComment::find()
            ->select(['id_comment', 'id_article', 'created'])
            ->orderBy(['created' => SORT_DESC]);

        $comments = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ],
        ]);
        $comments->sort = false;

        return $this->render('index', [
            'users'         => $users,
            'comments'      => $comments,
            'usersCount'    => $usersCount,
            'articlesCount' => $articlesCount,
            'commentsCount' => $commentsCount,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}