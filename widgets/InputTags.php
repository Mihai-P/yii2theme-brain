<?php
/**
 * Date: 23.01.14
 * Time: 1:27
 */

namespace theme\widgets;

use Yii;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class InputTags extends InputWidget {

    public function init()
    {
        parent::init();
        if(!isset($this->options['class'])) {
            $this->options['class'] = 'tags-autocomplete-url';
        }
        if($this->hasModel() && !isset($this->options['data-autocomplete-url'])) {
            $this->options['data-autocomplete-url'] = '/core/tag/list?type=' . $this->model->formName();
        }
    }

    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
    }    
}