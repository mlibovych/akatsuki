<?php

namespace app\controllers;

use app\models\CommentForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;
use app\models\Article;
use app\models\Tag;
use app\models\Category;
use app\models\SearchForm;
use yii\helpers\Html;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function beforeAction($action){
        $model = new SearchForm();
        if($model->load(Yii::$app->request->post())&& $model->validate()){
            $q = Html::encode($model->q);
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/search', 'q' => $q]));
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
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



    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionView($id)
    {
        $article = Article::findOne($id);

        $popular = Article::getPopular();

        $recent = Article::getRecent();

        $categories = Category::getAll();

        $related = $article->getRelated();

        $neighbors = Article::getNeighbors($id);

        $comments = $article->getArticleComments();

        $commentForm = new CommentForm();

        $article->viewedCounter();

        return $this->render('single',[
            'article' => $article,
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
            'related' => $related,
            'neighbors' => $neighbors,
            'comments' => $comments,
            'commentForm' => $commentForm,
        ]);
    }

    public function actionCategory($id)
    {
        $category = Category::findOne($id);

        $data = Category::getArticlesByCategory($id);

        $popular = Article::getPopular();

        $recent = Article::getRecent();

        $categories = Category::getAll();

        return $this->render('category',[
            'articles'=>$data['articles'],
            'pagination'=>$data['pagination'],
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories,
            'category'=>$category
        ]);
    }

    public function actionIndex()
    {
        $data = Article::getAll();

        $popular = Article::getPopular();

        $recent = Article::getRecent();

        $categories = Category::getAll();


        return $this->render('index',[
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
        ]);
    }

    public function actionNewsWithTag($id)
    {
        $data = Tag::getArticlesByTag($id);

        $popular = Article::getPopular();

        $recent = Article::getRecent();

        $categories = Category::getAll();


        return $this->render('tagnews',[
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
        ]);
    }

    public function actionSearch()
    {
        $q = Yii::$app->getRequest()->getQueryParam('q');

        $data = Article::getArticleSearch($q);

        $popular = Article::getPopular();

        $recent = Article::getRecent();

        $categories = Category::getAll();


        return $this->render('search', [
            'q' => $q,
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
        ]);
    }

    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(['site/view','id'=>$id]);
            }
        }
    }
}
