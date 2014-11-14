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
function commentTree($comment) { ?>

    <ul class="media-list" id="comment-<?=$comment->id_comment?>">
        <li class="media">
            <a class="media-left" href="#">
                <img src="/images/cover.jpg" alt="..." width='64' height='64' class="img-circle">
            </a>
            <div class="media-body">
                <p class="media-heading">
                    <?=
                    Html::a($comment->user->username, ['user/view', 'name' => $comment->user->username]) . ' ' .
                    Yii::$app->formatter->asDatetime($comment->created) . ' ' .
                    Html::a('#', '#comment-' . $comment->id_comment)
                    ?>
                </p>
                <p style="min-height: 35px;"><?= Yii::$app->formatter->asNtext($comment->text) ?></p>
                <?php
                foreach ($comment->childComments as $child)
                    commentTree($child);
                ?>
            </div>
        </li>
    </ul>

<? } ?>