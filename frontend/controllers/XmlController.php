<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\article\Article;

/**
 * Генерация RSS
 */

class XmlController extends Controller
{
    /*public function actionIndex()
    {
        $articles = Article::find()
            ->where([
                'status' => Article::STATUS_PUBLISHED,
                'active' => Article::OPTION_ACTIVE,
            ])
            ->andWhere(['<', 'publication', \Yii::$app->formatter->asTimestamp(date_create())])
            ->andWhere(['or', 'end > ' . \Yii::$app->formatter->asTimestamp(date_create()), 'end IS NULL'])
            ->select(['title', 'preview', 'publication', 'alias'])
            ->orderBy(['publication' => SORT_DESC])
            ->limit(10)
            ->all();

        foreach($articles as $article) {
            $date = \Yii::$app->formatter->asDatetime($article->publication, 'php:' . DATE_RSS);

            if (!isset($pubDate))
                $pubDate = $date;

            $items[] = [
                'title'       => $article->title,
                'link'        => \Yii::$app->homeUrl . "/article/" . $article->alias . ".html",
                'description' => strip_tags($article->preview),
                'pubDate'     => $date
            ];
        }

        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_XML;

        return [
            'channel' => [
                'title'       => 'Музыкальный гид: блог',
                'link'        => \Yii::$app->homeUrl,
                'description' => 'Описание',
                'language'    => \Yii::$app->language,
                'pubDate'     => $pubDate,
                'items'       => $items,
            ]
        ];
    }*/

    public function actionRss()
    {
        $query = Article::find()
            ->where([
                'status' => Article::STATUS_PUBLISHED,
                'active' => Article::OPTION_ACTIVE,
            ])
            ->andWhere(['<', 'publication', \Yii::$app->formatter->asTimestamp(date_create())])
            ->andWhere(['or', 'end > ' . \Yii::$app->formatter->asTimestamp(date_create()), 'end IS NULL'])
            ->select(['title', 'preview', 'publication', 'alias'])
            ->orderBy(['publication' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        $response = \Yii::$app->getResponse();
        $headers = $response->getHeaders();
        $headers->set('Content-Type', 'application/rss+xml; charset=utf-8');

        echo \Zelenin\yii\extensions\Rss\RssView::widget([
            'dataProvider' => $dataProvider,
            'channel' => [
                'title'       => 'Музыкальный гид: блог',
                'link'        => \Yii::$app->homeUrl,
                'description' => 'Музыкальный гид: статьи, обзоры, списки',
                'language'    => \Yii::$app->language,
                //'pubDate'     => $pubDate,
            ],
            'items' => [
                'title' => function ($model) {
                    return $model->title;
                },
                'link' => function ($model) {
                    return \Yii::$app->homeUrl . "/article/" . $model->alias . ".html";
                },
                'description' => function ($model) {
                    return strip_tags($model->preview);
                },
                'pubDate' => function ($model) {
                    return \Yii::$app->formatter->asDatetime($model->publication, 'php:' . DATE_RSS);
                }
            ]
        ]);
    }

}