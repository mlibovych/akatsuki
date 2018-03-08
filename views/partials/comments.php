<?php if(!empty($comments)):?>
    <div class="bottom-title">
        <h4>Comments (<?=count($comments)?>) :</h4>
    </div>
    <?php foreach ($comments as $comment):?>
        <div class="bottom-comment"><!--bottom comment-->

            <div class="comment-img">
                <img class="img-circle" src="<?= $comment->user->image ?>" alt="" width="50">
            </div>

            <div class="comment-text">
                <a href="#" class="replay btn pull-right"> Replay</a>
                <h5><?=$comment->user->name?> (<?= $comment->user->getUserReviews()?>)</h5>
                <p class="comment-date">
                    <?=$comment->getDate()?>
                </p>
                <p class="para"><?=$comment->text?></p>
            </div>
        </div>
    <?php endforeach;?>
<?php elseif(!Yii::$app->user->isGuest):?>
    <div class="bottom-title">
        <h4>Your comment will be first</h4>
    </div>
<?php endif;?>

<?php if(!Yii::$app->user->isGuest):?>
    <div class="leave-comment"><!--leave comment-->
        <h4>Leave a reply</h4>
        <?php if(Yii::$app->session->getFlash('comment')):?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php endif;?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action'=>['site/comment', 'id'=>$article->id],
            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>

        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message','wrap'=>'hard','cols'=>50])->label(false)?>
            </div>
        </div>
        <button type="submit" class="btn send-btn">Post Comment</button>
        <?php \yii\widgets\ActiveForm::end();?>
    </div>
<?php endif;?>