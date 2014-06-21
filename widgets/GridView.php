<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace core\widgets;

use Yii;
use Closure;
use yii\base\Formatter;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\BaseListView;
use yii\base\Model;

/**
 * The GridView widget is used to display data in a grid.
 *
 * It provides features like sorting, paging and also filtering the data.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GridView extends \yii\grid\GridView
{
    /**
     * @var string whether the filters should be displayed in the grid view. Valid values include:
     *
     * - [[FILTER_POS_HEADER]]: the filters will be displayed on top of each column's header cell.
     * - [[FILTER_POS_BODY]]: the filters will be displayed right below each column's header cell.
     * - [[FILTER_POS_FOOTER]]: the filters will be displayed below each column's footer cell.
     */
    public $filterPosition = '';
    /**
     * @var string the layout that determines how different sections of the list view should be organized.
     * The following tokens will be replaced with the corresponding section contents:
     *
     * - `{summary}`: the summary section. See [[renderSummary()]].
     * - `{errors}`: the filter model error summary. See [[renderErrors()]].
     * - `{items}`: the list items. See [[renderItems()]].
     * - `{sorter}`: the sorter. See [[renderSorter()]].
     * - `{pager}`: the pager. See [[renderPager()]].
     */
    public $layout = "\n{items}\n                
                <div class=\"table-footer\">\n
                    <div class=\"table-actions\">\n
                        <label class=\"pull-left\">Apply action:</label>\n
                        <a class=\"pull-left btn btn-xs btn-danger\" href=\"/page/create\">Delete All</a>
                        <a class=\"pull-left btn btn-xs btn-success\" href=\"/page/create\">Activate All</a>
                        <a class=\"pull-left btn btn-xs btn-primary\" href=\"/page/create\">Deactivate All</a>
                    </div>\n
                    {pager}\n
                </div>";
}

