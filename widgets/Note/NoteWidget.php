<?php
/**
 * Date: 23.01.14
 * Time: 1:27
 */

namespace theme\widgets\Note;

use Yii;
use core\models\Note;
use yii\base\Widget;
use yii\base\Model;
use yii\helpers\StringHelper;
use yii\data\ActiveDataProvider;


class NoteWidget extends Widget {

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
        $notesDataProvider = new ActiveDataProvider([
            'query' => $this->model->getNotes(),
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);

        $newModel = new Note;
        $newModel->Model_id = $this->model->id;
        $newModel->Model= StringHelper::basename(get_class($this->model));

        echo $this->render('note',[
            'model' => $newModel,
            'dataProvider' => $notesDataProvider,
            'accessPriviledge' => $this->accessPriviledge,
        ]);
    }
}
