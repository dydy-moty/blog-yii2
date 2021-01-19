<?php

use app\models\Article;
use app\models\Category;
use app\models\Comment;
use app\models\Tag;
use yii\helpers\Url;

?>

<h3 style="text-align: center">Сводная таблица</h3>

<div class="table-responsive">
    <table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th align="center">Статьи</th>
                <th align="center">Категории</th>
                <th align="center">Теги</th>
                <th align="center">Комментарии (ждут одобрения)</th>
            </tr>
        </thead>
        <tbody>
                <tr class="info">

                    <td align="center">
                            <a style="font-size: 18px" href="<?= Url::toRoute(['article/index']);?>">
                                <?= Article::getIdCount(); ?>
                            </a>
                    </td>
                    <td align="center">
                            <a style="font-size: 18px" href="<?= Url::toRoute(['category/index']);?>">
                                <?= Category::getIdCount(); ?>
                            </a>
                    </td>
                    <td align="center">
                            <a style="font-size: 18px" href="<?= Url::toRoute(['tag/index']);?>">
                                <?= Tag::getIdCount(); ?>
                            </a>
                    </td>
                    <td align="center">
                            <a style="font-size: 18px" href="<?= Url::toRoute(['comment/index']);?>">
                                <?= Comment::getIdCount() . ' (' .  Comment::getStatusCount(). ')'; ?>
                            </a>
                    </td>
                </tr>
        </tbody>
    </table>
</div>

