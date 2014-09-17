<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace theme\widgets;

use Yii;
use Closure;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * ActionColumn is a column for the [[GridView]] widget that displays buttons for viewing and manipulating the items.
 *
 * To add an ActionColumn to the gridview, add it to the [[GridView::columns|columns]] configuration as follows:
 *
 * ```php
 * 'columns' => [
 *     // ...
 *     [
 *         'class' => 'theme\widgets\ActionColumn',
 *         // you may configure additional properties here
 *     ],
 * ]
 * ```
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ActionColumn extends \yii\grid\ActionColumn
{
    public $options = ['style' => 'width: 140px;'];
    /**
     * @var string the template used for composing each cell in the action column.
     * Tokens enclosed within curly brackets are treated as controller action IDs (also called *button names*
     * in the context of action column). They will be replaced by the corresponding button rendering callbacks
     * specified in [[buttons]]. For example, the token `{view}` will be replaced by the result of
     * the callback `buttons['view']`. If a callback cannot be found, the token will be replaced with an empty string.
     * @see buttons
     */
    public $template = '{update} {status} {delete}';

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

    /**
     * Initializes the default button rendering callbacks
     */
    protected function initDefaultButtons()
    {
        $controller = $this->getCompatibilityId();
        if(\Yii::$app->user->checkAccess('read::' . $controller)) {
            if (!isset($this->buttons['view'])) {
                $this->buttons['view'] = function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                        'title' => Yii::t('yii', 'View'),
                        'class' => 'btn btn-xs btn-primary hidden-xs button-status-deactivate',
                        'data-pjax' => '0',
                    ]);
                };
            }
        }
        if(\Yii::$app->user->checkAccess('update::' . $controller)) {
            if (!isset($this->buttons['status'])) {
                $this->buttons['status'] = function ($url, $model) {
                    if($model->status == 'active') 
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url,  [
                            'title' => Yii::t('yii', 'Deactivate'),
                            'onclick' => 'javascript: if(confirm("Are you sure you want to deactivate this item?")) myGrid.status($(this)); return false;',
                            'class' => 'btn btn-xs btn-warning hidden-xs button-status-deactivate',
                            'data-pjax' => '0',
                        ]);
                    else 
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url,  [
                            'title' => Yii::t('yii', 'Activate'),
                            'onclick' => 'javascript: if(confirm("Are you sure you want to activate this item?")) myGrid.status($(this)); return false;',
                            'class' => 'btn btn-xs btn-success hidden-xs button-status-activate',
                            'data-pjax' => '0',
                        ]);
                };
            }        
            if (!isset($this->buttons['update'])) {
                $this->buttons['update'] = function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Update'),
                        'class' => 'btn btn-xs btn-default',
                        'data-pjax' => '0',
                    ]);
                };
            }
        }
        if(\Yii::$app->user->checkAccess('delete::' . $controller)) {
            if (!isset($this->buttons['delete'])) {
                $this->buttons['delete'] = function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'javascript: if(confirm("Are you sure you want to delete this item?")) myGrid.status($(this)); return false;',
                        'class' => 'btn btn-xs btn-danger button-delete',
                        'data-pjax' => '0',
                    ]);
                };
            }
        }
    }
}