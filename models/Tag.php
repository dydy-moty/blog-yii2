<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property ArticleTag[] $articleTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[ArticleTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['id' => 'article_id'])
            ->viaTable('article_tag', ['tag_id' => 'id']);
    }

    public static function getAll()
    {
        return Tag::find()->all();
    }

    public static function getIdCount() {
        return $idCount = Tag::find()
            ->select('id')
            ->count();
    }

//    public static function getArticlesByTag($id)
//    {
//       $query = Article::find()
//            ->select()
//            ->from(['artilces','articles_tegs'])
//            ->where(['articles_tegs.tegs_id' => $id,'articles_tegs.articles_id' => 'articles.id']);
//
//        echo '<pre>'; var_dump($query); echo '</pre>';die();
//
//        $count = $query->count();
//
//        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>$pageSize = 6]);
//
//        $articles = $query->offset($pagination->offset)
//            ->limit($pagination->limit)
//            ->all();
//
//        $data['articles'] = $articles;
//        $data['pagination'] = $pagination;
//
//        return $data;
//    }
}
