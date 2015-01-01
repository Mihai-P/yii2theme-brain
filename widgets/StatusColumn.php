<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace theme\widgets;
use core\components\ActiveRecord;
/**
 * SerialColumn displays a column of row numbers (1-based).
 *
 * To add a SerialColumn to the [[GridView]], add it to the [[GridView::columns|columns]] configuration as follows:
 *
 * ```php
 * 'columns' => [
 *     // ...
 *     [
 *         'class' => 'yii\grid\SerialColumn',
 *         // you may configure additional properties here
 *     ],
 * ]
 * ```
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class StatusColumn extends \yii\grid\DataColumn
{
    /**
     * @var string the attribute name associated with this column. When neither [[content]] nor [[value]]
     * is specified, the value of the specified attribute will be retrieved from each data model and displayed.
     *
     * Also, if [[label]] is not specified, the label associated with the attribute will be displayed.
     */
    public $attribute = 'status';
    /**
     * @var string label to be displayed in the [[header|header cell]] and also to be used as the sorting
     * link label when sorting is enabled for this column.
     * If it is not set and the models provided by the GridViews data provider are instances
     * of [[\yii\db\ActiveRecord]], the label will be determined using [[\yii\db\ActiveRecord::getAttributeLabel()]].
     * Otherwise [[\yii\helpers\Inflector::camel2words()]] will be used to get a label.
     */
    public $label = 'Status';
    /**
     * @var array the HTML attributes for the column group tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['style' => 'width: 80px;'];

    public $enableSorting = false;

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        switch($model->status) {
            case ActiveRecord::STATUS_ACTIVE:
                return '<span class="label label-success">'.$model->getNiceStatus().'</span>';
                break;
            case ActiveRecord::STATUS_INACTIVE:
                return '<span class="label label-warning">'.$model->getNiceStatus().'</span>';
                break;
            default:
                return '<span class="label label-default">'.$model->getNiceStatus().'</span>';
        }
        
        if ($this->content === null) {
            return ucfirst($this->grid->formatter->format($this->getDataCellValue($model, $key, $index), $this->format));
        } else {
            return parent::renderDataCellContent($model, $key, $index);
        }
    }    
}