<?php
/**
 * Date: 23.01.14
 * Time: 1:27
 */

namespace theme\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use mihaildev\elfinder\AssetsCallBack;


class InputFile extends \mihaildev\elfinder\InputFile {

    var $suffix;
    public $buttonName = '<span class="fa fa-upload"></span> Browse';    
    var $previewButtonName = '<span class="fa fa-eye"></span> Preview';
    var $buttonOptions = ['class' => 'btn btn-default'];
    var $previewButtonOptions = ['class' => 'btn btn-default'];
    var $multiple = false; // ability to select multiple files
    var $filter = 'image'; // filter files, you can specify an array of filters https://github.com/Studio-42/elFinder/wiki/Client-configuration-options # wiki-onlyMimes
    

    public $template = '<div class="input-group">{input}<span class="input-group-btn">{preview} {button}</span></div>';

    public function init()
    {
        parent::init();

        if(empty($this->suffix))
            $this->suffix = Yii::$app->params['frontend-url'];

        if(empty($this->previewButtonOptions['id']))
            $this->previewButtonOptions['id'] = $this->options['id'].'_preview';

        $this->previewButtonOptions['type'] = 'button';
        $this->previewButtonOptions['data-toggle'] = 'modal';
        $this->previewButtonOptions['role'] = 'button';
        if(!isset($this->options['class'])) {
            $this->options['class'] = 'form-control';
        }
    }

    public function run()
    {
        if ($this->hasModel()) {
            $replace['{input}'] = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $replace['{input}'] = Html::textInput($this->name, $this->value, $this->options);
        }

        $replace['{button}'] = Html::button($this->buttonName, $this->buttonOptions);
        $replace['{preview}'] = Html::a($this->previewButtonName, "#" . $this->previewButtonOptions['id'] . '_popup', $this->previewButtonOptions) . '
            <div id="'.$this->previewButtonOptions['id'].'_popup" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title"><i class="fa fa-picture-o"></i> Preview</h5>
                        </div>
                        <div class="modal-body has-padding">
                            <img width="100%" src="' . $this->suffix . $this->model->{$this->attribute} . '">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>';

        echo strtr($this->template, $replace);

        AssetsCallBack::register($this->getView());

        if (!empty($this->multiple))
            $this->getView()->registerJs("mihaildev.elFinder.register(".Json::encode($this->options['id']).", function(files, id){ var _f = []; for (var i in files) { _f.push(files[i].url); } \$('#' + id).val(_f.join(', ')); return true;}); $('#".$this->buttonOptions['id']."').click(function(){mihaildev.elFinder.openManager(".Json::encode($this->_managerOptions).");});");
        else
            $this->getView()->registerJs("mihaildev.elFinder.register(".Json::encode($this->options['id']).", function(file, id){\r\n\t \$('#' + id).val(file.url.replace('".$this->suffix."', ''));\r\n\t \$('#' + id + '_preview_popup .modal-body').html('<img width=\"100%\" src=\"' + file.url + '\">'); return true;}); $('#".$this->buttonOptions['id']."').click(function(){mihaildev.elFinder.openManager(".Json::encode($this->_managerOptions).");});");
    }
}
