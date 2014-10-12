<?php
/**
 * Date: 23.01.14
 * Time: 1:27
 */

namespace theme\widgets\ImageButton;

use Yii;
use yii\helpers\Html;
use yii\widgets\InputWidget;


class ImageButtonWidget extends InputWidget {
    /**
     * Initializes the widget.
     * This method will register the bootstrap asset bundle. If you override this method,
     * make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();

        if (!isset($this->options['name'])) {
            if($this->hasModel()) {
                $this->options['name'] = Html::getInputName($this->model, $this->attribute);
            } else {
                throw new InvalidConfigException("'Name' property must be specified.");
            }
        }
        if (!isset($this->value) && $this->hasModel()) {
            $this->value = $this->model->{$this->attribute};
        }
    }

    public function run()
    {
        $model = new ImageButtonModel;
        if($this->value) {
            parse_str($this->value, $attributes);
            $model->attributes = $attributes;
        }

        echo $this->render('imageButton',[
            'model' => $model,
            'value' => $this->value,
            'hasModel' => $this->hasModel(),
            'options' => $this->options,
        ]);
    }
}
