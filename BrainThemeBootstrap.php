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
