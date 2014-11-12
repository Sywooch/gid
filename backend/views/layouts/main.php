<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;

/**
 * @var $this \yii\web\View
 * @var $content string
 */

AppAsset::register($this);
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
        <a href="<?/*= Yii::getAlias('@frontendUrl') */?>" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            <?= Yii::$app->name ?>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only"><?//= Yii::t('backend', 'Toggle navigation') ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li id="notifications-dropdown" class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                        <span class="badge bg-green">
                            <?//= \common\models\SystemEvent::find()->today()->count() ?>
                        </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">
                                <?//= Yii::t('backend', 'You have {num} events', ['num'=>\common\models\SystemEvent::find()->today()->count()]) ?>
                            </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php /*foreach(\common\models\SystemEvent::find()->today()->orderBy(['created_at'=>SORT_DESC])->limit(10)->all() as $eventRecord): */?><!--
                                        <li>
                                            <a href="<?/*= Yii::$app->urlManager->createUrl(['/system-event/view', 'id'=>$eventRecord->id]) */?>">
                                                <i class="fa fa-bell"></i>
                                                <?/*= $eventRecord->getName() */?>
                                            </a>
                                        </li>
                                    --><?php /*endforeach; */?>
                                </ul>
                            </li>
                            <li class="footer">
                                <?//= Html::a(Yii::t('backend', 'View all'), ['/system-event/index']) ?>
                            </li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li id="log-dropdown" class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-warning"></i>
                        <span class="badge bg-red">
                            <?//= \backend\models\SystemLog::find()->count() ?>
                        </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?//= Yii::t('backend', 'You have {num} log items', ['num'=>\backend\models\SystemLog::find()->count()]) ?></li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php /*foreach(\backend\models\SystemLog::find()->orderBy(['log_time'=>SORT_DESC])->limit(5)->all() as $logEntry): */?><!--
                                        <li>
                                            <a href="<?/*= Yii::$app->urlManager->createUrl(['/log/view', 'id'=>$logEntry->id]) */?>">
                                                <i class="fa fa-warning <?/*= $logEntry->level == \yii\log\Logger::LEVEL_ERROR ? 'bg-red' : 'bg-yellow' */?>"></i>
                                                <?/*= $logEntry->category */?>
                                            </a>
                                        </li>
                                    --><?php /*endforeach; */?>
                                </ul>
                            </li>
                            <li class="footer">
                                <?//= Html::a(Yii::t('backend', 'View all'), ['/log/index']) ?>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span><?= Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <!--<img src="<?/*= Yii::$app->user->identity->profile->picture ?: '/img/anonymous.jpg' */?>" class="img-circle" alt="User Image" />-->
                                <p>
                                    <?php Yii::$app->user->identity->username ?>
                                    <small>
                                        <?//= Yii::t('backend', 'Member since {0, date, short}', Yii::$app->user->identity->created) ?>
                                    </small>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?= Html::a('Profile', ['/sign-in/profile'], ['class'=>'btn btn-default btn-flat']) ?>
                                </div>
                                <div class="pull-left">
                                    <?= Html::a('Account', ['/sign-in/account'], ['class'=>'btn btn-default btn-flat']) ?>
                                </div>
                                <div class="pull-right">
                                    <?= Html::a('Выйти', ['/logout'], ['class'=>'btn btn-default btn-flat']) ?>
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
                        <!--<img src="<?/*= Yii::$app->user->identity->profile->picture ?: '/img/anonymous.jpg' */?>" class="img-circle" alt="User Image" />-->
                    </div>
                    <div class="pull-left info">
                        <p><?//= Yii::t('backend', 'Hello, {username}', ['username'=>Yii::$app->user->identity->username]) ?></p>
                        <a href="<?php echo \yii\helpers\Url::to(['/sign-in/profile']) ?>">
                            <i class="fa fa-circle text-success"></i>
                            <?= Yii::$app->formatter->asDatetime(time()) ?>
                        </a>
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

            <!-- Main content -->
            <section class="content">
                <?php if(Yii::$app->session->hasFlash('alert')):?>
                    <?/*= \yii\bootstrap\Alert::widget([
                        'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                        'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                    ])*/?>
                <?php endif; ?>
                <?= $content ?>
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>