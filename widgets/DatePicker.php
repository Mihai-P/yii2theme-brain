<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace theme\widgets;

use yii\helpers\Html;
use Yii;

class DatePicker extends \yii\jui\DatePicker
{
    var $format = 'l, j F, Y';
    /**
     * Renders the DatePicker widget.
     * @return string the rendering result.
     */
    protected function renderWidget()
    {
        if ($this->hasModel()) {
            $this->model->{$this->attribute} = $this->model->{$this->attribute} ? Yii::$app->formatter->asDate($this->model->{$this->attribute}, 'medium') : '';
        }
        return parent::renderWidget();
    }
}