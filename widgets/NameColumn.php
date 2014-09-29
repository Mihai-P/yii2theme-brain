<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace theme\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
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
class NameColumn extends \yii\grid\DataColumn
{
    /**
     * @var string the attribute name associated with this column. When neither [[content]] nor [[value]]
     * is specified, the value of the specified attribute will be retrieved from each data model and displayed.
     *
     * Also, if [[label]] is not specified, the label associated with the attribute will be displayed.
     */
    public $attribute = 'name';
    /**
     * @var string label to be displayed in the [[header|header cell]] and also to be used as the sorting
     * link label when sorting is enabled for this column.
     * If it is not set and the models provided by the GridViews data provider are instances
     * of [[\yii\db\ActiveRecord]], the label will be determined using [[\yii\db\ActiveRecord::getAttributeLabel()]].
     * Otherwise [[\yii\helpers\Inflector::camel2words()]] will be used to get a label.
     */
    public $label = 'Name';
    /**
     * @var boolean hasView that sets if the link goes to the view or to the update action
     */
    public $hasView = false;
    /**
     * @var string the ID of the controller that should handle the actions specified here.
     * If not set, it will use the currently active controller. This property is mainly used by
     * [[urlCreator]] to create URLs for different actions. The value of this property will be prefixed
     * to each action name to form the route of the action.
     */
    public $controller;
    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $controller = $this->getCompatibilityId();
        if($this->hasView && \Yii::$app->user->checkAccess('read::' . $controller)) {
            return Html::a($model->name, $this->createUrl('view', $model, $key, $index), ['data-pjax' => "0"]);
        } elseif(\Yii::$app->user->checkAccess('update::' . $controller)) {
            return Html::a($model->name, $this->createUrl('update', $model, $key, $index), ['data-pjax' => "0"]);
        } else {
            return $controller . $model->name;
        }        
    }

    /**
     * Creates a URL for the given action and model.
     * This method is called for each button and each row.
     * @param string $action the button name (or action ID)
     * @param \yii\db\ActiveRecord $model the data model
     * @param mixed $key the key associated with the data model
     * @param integer $index the current row index
     * @return string the created URL
     */
    public function createUrl($action, $model, $key, $index)
    {
        $params = is_array($key) ? $key : ['id' => (string) $key];
        $params[0] = $this->controller ? $this->controller . '/' . $action : $action;
        return Url::toRoute($params);
    }

    /**
     * Get the simpler access privileges name from the current controller
     * @return string
    */
    protected function getCompatibilityId() {
        $controller = $this->controller ? $this->controller : Yii::$app->controller->id;
        if(strpos($controller, "/")) {
            $controller = substr($controller, strpos($controller, "/") + 1);
        }
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $controller)));
    }    
}