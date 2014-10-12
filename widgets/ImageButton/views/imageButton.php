<?php

use theme\widgets\InputFile;
use yii\helpers\Html;
use theme\widgets\ImageButton\ImageButtonAsset;
/**
 * Created by PhpStorm.
 * User: mp
 * Date: 11/10/14
 * Time: 11:59 AM
 */
ImageButtonAsset::register($this);
$input = Html::hiddenInput($options['name'], $value, $options);
$id = $options['id'];
?>
<!-- Form modal -->
<div id="<?= $id?>popup" class="site-widget modal fade" data-target="<?= $id?>"  tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title">Edit</h5>
            </div>
            <div class="modal-body has-padding">
                <div class="form-group field-image required">
                    <div class="row">
                        <div class="col-sm-2"><?= Html::activeLabel($model, 'image', ['for' => $id . 'image'])?></div>
                        <div class="col-sm-10"><?= InputFile::widget([
                                'model'   => $model,
                                'attribute'   => 'image',
                                'options' => [
                                    'name' => 'image',
                                    'id' => $id . 'image',
                                ],
                                'filter'     => 'image',
                                'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>'
                            ]);?>
                        </div>
                    </div>
                </div>
                <div class="form-group field-link required">
                    <div class="row">
                        <div class="col-sm-2"><?= Html::activeLabel($model, 'link')?></div>
                        <div class="col-sm-10"><?= Html::activeTextInput($model, 'link', ['class' => 'form-control', 'name' => 'link'])?></div>
                    </div>
                </div>
                <div class="form-group field-link required">
                    <div class="row">
                        <div class="col-sm-2"><?= Html::activeLabel($model, 'alt')?></div>
                        <div class="col-sm-10"><?= Html::activeTextInput($model, 'alt', ['class' => 'form-control', 'name' => 'alt'])?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- /form modal -->
<div class="input-group">
    <?= $input?>
    <?= Html::a(
        Html::img($model->image ? Yii::$app->params['fontend-url'] . $model->image : Yii::$app->assetManager->getPublishedUrl('@theme/widgets/ImageButton/assets') . '/placeholder.jpg',
            ['data-sufix' => Yii::$app->params['fontend-url']]),
        '#' . $id . 'popup',
        ['data-toggle' => "modal", 'role' => "button", 'class' => 'image-widget']);?>
</div>
