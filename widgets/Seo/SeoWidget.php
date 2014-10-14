<?php
/**
 * Date: 23.01.14
 * Time: 1:27
 */

namespace theme\widgets\Seo;

use Yii;
use core\models\Seo;
use yii\base\Widget;
use yii\base\Model;
use yii\helpers\StringHelper;


class SeoWidget extends Widget {

    /**
     * @var Model the data model that this widget is associated with.
     */
    public $model;

    /**
     * @var string the access priviledge to edit
     */
    public $accessPriviledge;

    public function run()
    {
        if(!$this->model->seo) {
            $seoModel = new Seo;
            $seoModel->Model_id = $this->model->id;
            $seoModel->Model= StringHelper::basename(get_class($this->model));
        } else {
            $seoModel = $this->model->seo;
        }

        echo $this->render('seo',[
            'model' => $seoModel,
            'accessPriviledge' => $this->accessPriviledge,
        ]);
    }
}
