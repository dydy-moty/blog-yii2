<?php


namespace app\modules\admin\controllers;


use app\models\Comment;
use yii\web\Controller;

class CommentController extends Controller
{

    public function actionIndex()
    {
        $comments = Comment::find()->orderBy('id desc')->all();

        return $this->render('index', ['comments' => $comments]);
    }


    public function actionDelete($id)
    {
        $comments = Comment::findOne($id);

        if ($comments->delete())
        {
            return $this->redirect(['comment/index']);
        }
    }

    public function actionAllow($id)
    {
        $comment = Comment::findOne($id);
        if ($comment->allow())
        {
            return $this->redirect(['index']);
        }
    }

    public function actionDisallow($id)
    {
        $comment = Comment::findOne($id);
        if ($comment->disallow())
        {
            return $this->redirect(['index']);
        }
    }


}