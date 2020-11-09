<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artical_tag".
 *
 * @property int $id
 * @property int|null $article_id
 * @property int|null $tag_id
 */
class ArticalTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artical_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
