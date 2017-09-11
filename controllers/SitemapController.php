<?php

namespace app\controllers;

use dench\page\models\Page;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');

        $urls[] = [
            'loc' => Url::home('https'),
        ];

        $pages = Page::find()->select(['slug'])->where(['enabled' => Page::ENABLED])->andWhere(['id' => Yii::$app->params['sitemap']['page']])->asArray()->all();

        foreach ($pages as $page) {
            $urls[] = [
                'loc' => Url::to(['/site/page', 'slug' => $page['slug']], 'https'),
            ];
        }

        return $this->renderPartial('index', [
            'urls' => $urls,
        ]);
    }

}