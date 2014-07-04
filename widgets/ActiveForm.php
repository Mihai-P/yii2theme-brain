<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace theme\widgets;

/**
 * ActiveForm ...
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ActiveForm extends \yii\widgets\ActiveForm
{
    /**
     * @var array the default options for the label tags. The parameter passed to [[label()]] will be
     * merged with this property when rendering the label tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $labelOptions = ['class' => 'col-sm-2 control-label'];

    /**
     * @var array the default configuration used by [[field()]] when creating a new field object.
     */
    public $fieldConfig = [
            'template' => "<div class=\"col-sm-2\">{label}</div>\n<div class=\"col-sm-10\">{input}</div>",
        ];

    /**
     * @var array the HTML attributes (name-value pairs) for the form tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [
            'class' => "form-horizontal",
    ];
    /**
     * @var boolean whether to perform validation when the form is submitted.
     */
    public $validateOnSubmit = true;    

    /**
     * @var boolean whether to perform validation when the form is submitted.
     */
    public $validateOnChange = false;
}