<?php

use yii\helpers\Url;

?>

<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]); ?>"><img src="<?= $article->getImage(); ?>" alt=""></a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?= Url::toRoute(['site/category', 'id' => $article->category->id]); ?>"><?= $article->category->title ?></a></h6>

                            <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view', 'id' => $article->id]); ?>"><?= $article->title ?></a></h1>


                        </header>
                        <div class="entry-content">
                            <?= $article->content ?>
                        </div>
                        <div class="decoration">
                            <?php foreach ($article->tags as $tag): ?>
                                <a href="<?= Url::toRoute(['site/tags', 'id' => $tag->id ]); ?>" class="btn btn-default"><?= $tag->title; ?></a>
                        <?php endforeach; ?>
                        </div>

                        <div class="social-share">
							<span
                                class="social-share-title pull-left text-capitalize"> By <b><?= $article->author->name ?></b> On <?= $article->getDate() ?></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>
           <!--top comment-->
                <div class="top-comment ">
                    <img width="75" src="/public/images/comment.jpg" class="pull-left img-circle" alt="">
                    <h4><?= $article->author->name ?></h4>

                    <p>Some text about author.</p>
                </div>
          <!--top comment end-->
                <div class="row">
                    <!--previous article-->
                    <div class="col-md-6 ">
                        <div class="single-blog-box">
                            <?php if ($previousArticlesId != null ): ?>
                               <a href="<?= Url::toRoute(['site/view', 'id' => $previousArticlesId ]) ?>">
                            <?php endif; ?>

                                <img src="/public/images/blog-next.jpg" alt="">
                                <div class="overlay">
                                    <div class="promo-text">
                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
                                                <h5>Previous article</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- end previous article-->

                    <!--next next article-->
                    <div class="col-md-6">
                        <div class="single-blog-box">
                            <?php if ($nextArticlesId != null ): ?>
                               <a href="<?= Url::toRoute(['site/view', 'id' => $nextArticlesId ]) ?>">
                            <?php endif; ?>
                                <img src="/public/images/blog-next.jpg" alt="">

                                <div class="overlay">
                                    <div class="promo-text">
                                        <p><i class=" pull-right fa fa-angle-right"></i></p>
                                        <h5>Next article</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--next next article-->


                <?=
                $this->render('/partials/comment', [
                    'article' => $article,
                    'comments' => $comments,
                    'commentForm' => $commentForm,
                ])
                ?>
            </div>
            <?= $this->render('/partials/sidebar', [
                'popular' => $popular,
                'recent' => $recent,
                'categories' => $categories,
            ]); ?>
        </div>
    </div>
</div>
<!-- end main content-->
<!--footer start-->
