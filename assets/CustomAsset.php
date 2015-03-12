<?php

/**
 * @link http://www.2ezweb.com.au/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace theme\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the It's Brain theme from 
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CustomAsset extends AssetBundle {

    public $sourcePath = '@theme/assets/';
    public $css = [
        'css/style.css',
    ];
    public $js = [
        'js/application.js',
        'js/typeahead.jquery.js',
        'js/jquery.popup.js',
        'js/ajaxoperations.js',
    ];

    public function init()
    {
        parent::init();
        $this->js[] = (YII_ENV == 'dev' ? 'js/togetherjs-min.js' : 'https://togetherjs.com/togetherjs-min.js');
        $this->css[] = (YII_ENV == 'dev' ? 'css/Cuprum.css' : 'http://fonts.googleapis.com/css?family=Cuprum');
    }        
    
}
