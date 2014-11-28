<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\web\View
 * @var $content string
 */

AppAsset::register($this);

$this->registerJs("
    $('body').on('click', '.user-menu', function () {
        $('.dropdown-menu').toggle();
    });
");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="skin-blue">

    <?php $this->beginBody() ?>

    <header class="header">

        <?= Html::a(Yii::$app->name, Yii::getAlias('@frontendUrl'), ['class' => 'logo', 'target' => '_blank']) ?>

        <nav class="navbar navbar-static-top" role="navigation">

            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Левая панель</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!--
                    http://almsaeedstudio.com/AdminLTE/
                    dropdown messages-menu
                    dropdown notifications-menu
                    dropdown tasks-menu
                    -->

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span><?= Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">

                            <li class="user-header bg-light-blue">
                                <img src="<?= Yii::getAlias('@frontendUrl') . '/' . Yii::$app->user->identity->pathToAvatar()?>" class="img-circle" alt="User Image">
                                <p>
                                    <?= Yii::$app->user->identity->username ?>
                                    <small>На сайте с <?= Yii::$app->formatter->asDatetime(Yii::$app->user->identity->created) ?></small>
                                </p>
                            </li>

                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <?= Html::a('Профиль', ['/user/view', 'id' => Yii::$app->user->identity->id], ['class'=>'btn btn-default btn-flat']) ?>
                                </div>
                                <div class="pull-right">
                                    <?= Html::a('Выйти', '/site/logout', ['class'=>'btn btn-default btn-flat', 'data-method' => 'post']) ?>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <div class="wrapper row-offcanvas row-offcanvas-left">

        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar">

                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= Yii::getAlias('@frontendUrl') . '/' . Yii::$app->user->identity->pathToAvatar()?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?= 'Привет, ' . Yii::$app->user->identity->username ?></p>
                        <?= Yii::$app->formatter->asDatetime(time()) ?>
                    </div>
                </div>

                <?= $this->render('_sidebar-menu') ?>
            </section>
        </aside>

        <aside class="right-side">
            <section class="content-header">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= Breadcrumbs::widget([
                    'homeLink'     => ['label' => '<i class="glyphicon glyphicon-tower"></i> Консоль', 'url' => '/'],
                    'tag'          => 'ol',
                    'links'        => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'encodeLabels' => false
                ]) ?>
            </section>

            <section class="content">

                <?//= Alert::widget() ?>

                <?= $content ?>

            </section>
        </aside>

    </div>

    <!--fa fa-gear-->

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>