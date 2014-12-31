<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace theme;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\web\Controller;
use yii\base\Event;

class BrainThemeBootstrap implements BootstrapInterface {
    public function bootstrap($app){
       //\Yii::$classMap = array_merge(\Yii::$classMap,[
            //'yii\grid\CheckboxColumn'=>'@yii/adminUi/widget/CheckboxColumn.php',
            //'yii\grid\ActionColumn'=>'@theme/widgets/ActionColumn.php',
        //]);
        /*
        $app->set('view', [
            'class'=>'yii\web\View',
            'theme' => [
                'pathMap' => ['@backend/views' => '@backend/themes/adminui'],   // for Admin theme which resides on extension/adminui
                'baseUrl' => '@web/themes/adminui',
            ],
        ]);

        Yii::setAlias('theme', __DIR__ . '/themes');

        $app->set('assetManager' , [
            'class'	=> 'yii\web\AssetManager',
            'bundles' => [
                'yii\widgets\ActiveFormAsset' => [
                    'js' => [],
                    'depends' => [
                        'yii\adminUi\assetsBundle\AdminUiActiveForm',
                    ],
                ],
                'yii\grid\GridViewAsset' => [
                    'depends'   => [
                        'backend\assets\AppAsset'
                    ],
                ],
            ],
            'linkAssets' => true,
        ]);

        Event::on(Controller::className(), Controller::EVENT_BEFORE_ACTION, function ($event) {
            if(in_array($event->action->id,['login','forgot','reset-password']) && in_array('backend',  explode("\\", $event->sender->className()))){
                $event->sender->layout = '//blank';
            }
        });
        */
        if(Yii::$app->id == "app-backend") {
            Yii::$container->set('yii\bootstrap\ActiveForm',
                [
                    'fieldConfig' => [
                        'template' => "<div class=\"col-sm-2\">{label}</div>\n<div class=\"col-sm-10\">{input}{error}{hint}</div>",
                    ],
                    'options' => [
                        'class' => "form-horizontal",
                    ],
                    'validateOnSubmit' => false,
                    'validateOnChange' => false,
                ]
            );
        }
        Yii::$container->set('yii\grid\CheckboxColumn',
            [
                'options' => ['style' => 'width: 36px; text-align: center;'],
            ]
        );

    }
}
