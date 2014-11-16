<?php

use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 14.11.2014
 * Time: 22:55
 *
 * @var $comment common\models\article\ArticleComment
 */
function commentTree($comment, $margin = 0) { ?>

    <div id="comment-<?= $comment->id_comment ?>" style="margin-left: <?= $margin?>%">
        <div class="comment-content">
            <div class="comment-header">
                <img src="/images/cover.jpg" alt="..." width='32' height='32' class="img-circle avatar">
                <?=
                Html::a($comment->user->username, ['user/view', 'name' => $comment->user->username]) . ' ' .
                Yii::$app->formatter->asDatetime($comment->created) . ' ' .
                Html::a('#', '#comment-' . $comment->id_comment)
                ?>
            </div>
            <div class="comment-text">
                <?= Yii::$app->formatter->asNtext($comment->text) ?>
            </div>
            <div class='comment-footer'>
                <span class='reply'>Ответить</span>
            </div>
        </div>
    </div>
    <?php
        if ($margin < 40)
            $margin += 8;
        foreach ($comment->childComments as $child) {
            commentTree($child, $margin);
        }
    return null;
}
?>