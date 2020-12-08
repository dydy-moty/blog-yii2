<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleTag;
use app\models\Category;
use app\models\CommentForm;
use app\models\Tag;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $data       = Article::getAll(3);
        $popular    = Article::getPopular();
        $recent     = Article::getRecent();
        $categories = Category::getAll();

        return $this->render('index', [
            'articles'   => $data['articles'],
            'pagination' => $data['pagination'],
            'popular'    => $popular,
            'recent'     => $recent,
            'categories' => $categories,
        ]);
    }



    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionView($id)
    {
        $article            = Article::findOne($id);
        $popular            = Article::getPopular();
        $recent             = Article::getRecent();
        $categories         = Category::getAll();
        $comments           = $article->getArticleComments();
        $commentForm        = new CommentForm();
        $previousArticlesId = $article->getUrlPrev();//previous articles
        $nextArticlesId     = $article->getUrlNext();   //next articles

        if ($previousArticlesId)
        {
        Yii::$app->getSession()->setFlash('alert', 'This is the first article!');//for next and previous articles
        }

        $article->viewesCounter();
//echo '<pre>'; var_dump ($previousArticlesId); echo '</pre>'; die();
        return $this->render('single', [
            'article'            => $article,
            'popular'            => $popular,
            'recent'             => $recent,
            'categories'         => $categories,
            'comments'           => $comments,
            'commentForm'        => $commentForm,
            'previousArticlesId' => $previousArticlesId,//previous articles
            'nextArticlesId'     => $nextArticlesId,//Next articles
        ]);
    }

    public function actionCategory($id)
    {
        $data       = Category::getArticlesByCategory($id);
        $popular    = Article::getPopular();
        $recent     =  Article::getRecent();
        $categories = Category::getAll();

        return $this->render('category', [
            'articles'   => $data['articles'],
            'pagination' => $data['pagination'],
            'popular'    => $popular,
            'recent'     => $recent,
            'categories' => $categories,
        ]);
    }


    public function actionTags($id)
    {

        $tags     = Tag::findOne($id);
        $articles = $tags->articles;
//        $data     = Tag::getArticlesByTag($id);

        $popular    = Article::getPopular();
        $recent     = Article::getRecent();
        $categories = Category::getAll();


        return $this->render('tags', [
            'articles'   => $articles,
//            'articles'   => $data['articles'],
//            'pagination' => $data['pagination'],
            'popular'    => $popular,
            'recent'     => $recent,
            'categories' => $categories,
        ]);
    }

    public function actionComment($id)
    {
        $model = new CommentForm();
        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());
            if ($model->saveComment($id)) {

                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(['site/view', 'id' => $id]);
            }
        }
    }




}
