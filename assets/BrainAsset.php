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
class BrainAsset extends AssetBundle
{
    public $sourcePath = '@vendor/tez/theme/assets/Brain/Liquid/Light/';
    public $css = [
        'css/brain-theme.css',
        'css/styles.css',
        'css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Cuprum',
    ];
	public $js = [
        //'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js',
		'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js',
		/*
		'js/plugins/charts/flot.js',
		'js/plugins/charts/flot.orderbars.js',
		'js/plugins/charts/flot.pie.js',
		'js/plugins/charts/flot.time.js',
		'js/plugins/charts/flot.animator.min.js',
		'js/plugins/charts/excanvas.min.js',
		'js/plugins/charts/flot.resize.min.js',
		*/
		'js/plugins/forms/uniform.min.js',
		'js/plugins/forms/select2.min.js',
		'js/plugins/forms/inputmask.js',
		'js/plugins/forms/autosize.js',
		'js/plugins/forms/inputlimit.min.js',
		'js/plugins/forms/listbox.js',
		'js/plugins/forms/multiselect.js',
		'js/plugins/forms/validate.min.js',
		'js/plugins/forms/tags.min.js',

		'js/plugins/forms/uploader/plupload.full.min.js',
		'js/plugins/forms/uploader/plupload.queue.min.js',

		'js/plugins/forms/wysihtml5/wysihtml5.min.js',
		'js/plugins/forms/wysihtml5/toolbar.js',

		'js/plugins/interface/jgrowl.min.js',
		'js/plugins/interface/datatables.min.js',
		'js/plugins/interface/prettify.js',
		'js/plugins/interface/fancybox.min.js',
		'js/plugins/interface/colorpicker.js',
		'js/plugins/interface/timepicker.min.js',
		'js/plugins/interface/fullcalendar.min.js',
		'js/plugins/interface/collapsible.min.js',

		'js/bootstrap.min.js',
		//'js/charts/simple_graph.js',
    ];    
}
