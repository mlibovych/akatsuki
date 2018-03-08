<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php if($q ==""):?>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Your request is epmty</h3>
                            </div>
                        </div>
                    <?php else:?>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Results for request <strong style="color: #6dadb0"><?=$q?></strong> :</h3>
                            </div>
                        </div>
                        <?php if(empty($articles)):?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Nothing to show</h4>
                                </div>
                            </div>
                        <?php else:?>
                            <?php foreach($articles as $article):?>
                                <article class="post post-list">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="post-thumb">
                                                <a href="<?= Url::toRoute(['site/view','id' => $article->id]);?>"><img src="<?= $article->getImage();?>" alt=""></a>

                                                <a href="<?= Url::toRoute(['site/view','id' => $article->id]);?>" class="post-thumb-overlay text-center">
                                                    <div class="text-uppercase text-center">View Post</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="post-content">
                                                <header class="entry-header text-uppercase">
                                                    <h6><a href="<?= Url::toRoute(['site/category','id' => $article->category->id]);?>"><?=$article->category->title?></a></h6>

                                                    <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view','id' => $article->id]);?>"><?=$article->title?></a></h1>
                                                </header>
                                                <div class="entry-content">
                                                    <p><?=$article->getDescription();?><a href="<?= Url::toRoute(['site/view','id' => $article->id]);?>">...</a>
                                                    </p>
                                                </div>
                                                <div class="social-share">
                                                    <span class="social-share-title pull-left text-capitalize">By <?= $article->author->name; ?> On <?=$article->getDate();?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach;?>
                        <?php endif;?>
                    <?php endif;?>
                    <?php
                    echo LinkPager::widget([
                        'pagination' => $pagination,
                    ]);
                    ?>

                </div>
                <?= $this->render('/partials/sidebar',[
                    'popular' => $popular,
                    'recent' => $recent,
                    'categories' => $categories,
                ]); ?>
            </div>
        </div>
    </div>
    <!-- end main content-->