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
    <!--width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no-->
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
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
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
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <?/*= \common\components\widgets\menu\MenuWidget::widget([
                    'options'=>['class'=>'sidebar-menu'],
                    'labelTemplate' => '<a href="#">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                    'submenuTemplate'=>"\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                    'activateParents'=>true,
                    'items'=>[
                        [
                            'label'=>Yii::t('backend', 'Dashboard'),
                            'icon'=>'<i class="fa fa-bar-chart-o"></i>',
                            'url'=>['/site/index']
                        ],
                        [
                            'label'=>Yii::t('backend', 'Content'),
                            'icon'=>'<i class="fa fa-edit"></i>',
                            'options'=>['class'=>'treeview'],
                            'items'=>[
                                ['label'=>Yii::t('backend', 'Static pages'), 'url'=>['/page/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                ['label'=>Yii::t('backend', 'Articles'), 'url'=>['/article/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                ['label'=>Yii::t('backend', 'Article Categories'), 'url'=>['/article-category/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                ['label'=>Yii::t('backend', 'Text Widgets'), 'url'=>['/widget-text/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                ['label'=>Yii::t('backend', 'Menu Widgets'), 'url'=>['/widget-menu/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                ['label'=>Yii::t('backend', 'Carousel Widgets'), 'url'=>['/widget-carousel/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            ]
                        ],
                        [
                            'label'=>Yii::t('backend', 'Users'),
                            'icon'=>'<i class="fa fa-users"></i>',
                            'url'=>['/user/index'],
                            'visible'=>Yii::$app->user->can('administrator')
                        ],
                        [
                            'label'=>Yii::t('backend', 'System'),
                            'icon'=>'<i class="fa fa-cogs"></i>',
                            'options'=>['class'=>'treeview'],
                            'items'=>[
                                [
                                    'label'=>Yii::t('backend', 'i18n'),
                                    'icon'=>'<i class="fa fa-flag"></i>',
                                    'options'=>['class'=>'treeview'],
                                    'items'=>[
                                        ['label'=>Yii::t('backend', 'i18n Source Message'), 'url'=>['/i18n/i18n-source-message/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                        ['label'=>Yii::t('backend', 'i18n Message'), 'url'=>['/i18n/i18n-message/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                    ]
                                ],
                                ['label'=>Yii::t('backend', 'Key-Value Storage'), 'url'=>['/key-storage/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                ['label'=>Yii::t('backend', 'File Storage Items'), 'url'=>['/file-storage/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                ['label'=>Yii::t('backend', 'File Manager'), 'url'=>['/file-manager/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                [
                                    'label'=>Yii::t('backend', 'System Events'),
                                    'url'=>['/system-event/index'],
                                    'icon'=>'<i class="fa fa-angle-double-right"></i>',
                                    'badge'=>\common\models\SystemEvent::find()->today()->count(),
                                    'badgeBgClass'=>'bg-green',
                                ],
                                [
                                    'label'=>Yii::t('backend', 'System Information'),
                                    'url'=>['/system-information/index'],
                                    'icon'=>'<i class="fa fa-angle-double-right"></i>'
                                ],
                                [
                                    'label'=>Yii::t('backend', 'Logs'),
                                    'url'=>['/log/index'],
                                    'icon'=>'<i class="fa fa-angle-double-right"></i>',
                                    'badge'=>\backend\models\SystemLog::find()->count(),
                                    'badgeBgClass'=>'bg-red',
                                ],
                            ]
                        ]
                    ]
                ])*/ ?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= Breadcrumbs::widget([
                    'tag'=>'ol',
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
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