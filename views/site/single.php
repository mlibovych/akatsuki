<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Carousel;
?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <a href="<?= Url::toRoute(['site/view','id' => $article->id]);?>"><img src="<?= $article->getImage();?>" alt=""></a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?= Url::toRoute(['site/category','id'=>$article->category->id])?>"><?= $article->category->title?></a></h6>

                            <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view','id'=>$article->id])?>"><?= $article->title?></a></h1>


                        </header>
                        <div class="entry-content">
                            <?= $article->content?>
                        </div>

                        <div class="decoration">
                            <?php foreach($article->tags as $tag):?>
                            <a href="<?= Url::toRoute(['site/news-with-tag','id'=>$tag->id])?>" class="btn btn-default"><?= $tag->title?></a>
                            <?php endforeach; ?>
                        </div>

                        <iframe width="640" height="360" src="https://www.youtube.com/embed/3s5zsFm3VgA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                        <div class="social-share">
							<span
                                class="social-share-title pull-left text-capitalize">By <?= $article->author->name; ?> On <?= $article->getDate();?></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $article->viewed;?>
                                <!--<li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>-->
                            </ul>
                        </div>
                    </div>
                </article>

                <!--<div class="top-comment">>
                    <img src="/public/images/comment.jpg" class="pull-left img-circle" alt="">
                    <h4>Rubel Miah</h4>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                        invidunt ut labore et dolore magna aliquyam erat.</p>
                </div>-->

                <div class="row"><!--blog next previous-->
                    <?php foreach($neighbors as $neighbor):?>
                    <div class="col-md-6">
                        <?php if(isset($neighbor)):?>
                        <div class="single-blog-box">
                            <a href="<?= Url::toRoute(['site/view','id'=>$neighbor->id])?>">
                                <img src="<?= $neighbor->getImage();?>"  height="200" alt="">

                                <div class="overlay">

                                    <div class="promo-text">
                                        <?php if(isset($neighbors['previous'])&$n!=1):$n=1;?>
                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
                                        <?php elseif(isset($neighbors['next'])):?>
                                        <p><i class=" pull-right fa fa-angle-right"></i></p>
                                        <?php endif;?>
                                        <h5><?=$neighbor->title?></h5>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <?php else: ?>
                        <div class="single-blog-box">
                            <a href="">
                                <img src="/no-image.png"  height="200" alt="">

                                <div class="overlay">

                                    <div class="promo-text">
                                        <h5>Nothing to show</h5>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach;?>
                </div><!--blog next previous end-->

                <?php if(isset($related)):?>
                <div class="related-post-carousel"><!--related post carousel-->
                    <div class="related-heading">
                        <h4>You might also like</h4>
                    </div>
                    <div class="items">
                        <?php foreach($related as $relativ):?>
                            <div class="single-item">
                                <a href="<?= Url::toRoute(['site/view','id' => $relativ->id]);?>">
                                    <img src="<?= $relativ->getImage();?>" width = 235 height= 150 alt="">

                                    <p><?=$relativ->getDescription()."...";?></p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div><!--related post carousel-->
                <?php endif; ?>

                <?= $this->render('/partials/comments', [
                    'article'=>$article,
                    'comments'=>$comments,
                    'commentForm'=>$commentForm
                ])?>
            </div>
            <?= $this->render('/partials/sidebar',[
                'popular' => $popular,
                'recent' => $recent,
                'categories' => $categories,
            ]); ?>
        </div>
    </div>
</div>