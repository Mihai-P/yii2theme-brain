<?php
namespace theme\widgets;

class Pjax extends \yii\widgets\Pjax
{
    public function registerClientScript()
    {
    	$this->clientOptions['fragment'] = $this->options['id'];
    	parent::registerClientScript();
    }    
}