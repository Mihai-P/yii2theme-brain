<?php
use yii\widgets\Pjax;
use theme\widgets\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title">Notes</h6>
        <?php
        if(\Yii::$app->user->checkAccess('update::' . $accessPriviledge))
            echo Html::a('Add Note', '#edit-note' ,['class' => 'edit-note pull-right btn btn-xs btn-primary', 'data-toggle'=>"modal", 'role'=>"button"]);
        ?>
    </div>
    <div class="table-responsive">
        <?php Pjax::begin(['options' => ['id'=>'note-pjax']]); ?>
            <?= GridView::widget([
                'id' => 'main-grid',
                'dataProvider' => $dataProvider,
                'layout' => "\n{items}\n
                            <div class=\"table-footer\">\n
                                {actions}\n
                                {summary}\n
                                {pager}\n
                            </div>",
                'columns' => [
                    [
                        'headerOptions'=>['class' => 'col-sm-8 col-md-9 col-lg-10'],
                        'attribute'=>'Description',
                        'format'=>'raw',
                        'value'=>function ($model, $key, $index, $widget) {
                            return nl2br($model->description);
                        },
                    ],
                    [
                        'headerOptions'=>['class' => 'col-sm-4 col-md-3 col-lg-2'],
                        'class' => 'yii\grid\DataColumn',
                        'attribute' => 'Date',
                        'format'=>'raw',
                        'value'=>function ($model, $key, $index, $widget) {
                            return $model->author->name . '<br />' .
                            Yii::$app->formatter->asDate($model->update_time, 'medium');
                        },
                    ],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>


<!-- Form modal -->
<div id="edit-note" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title">Note</h5>
            </div>
            <!-- Form inside modal -->
            <?php
            $form = ActiveForm::begin([
                'action' => ['/core/note/save'],
                'method' => 'post',
                'id' => 'note',
                'options' => [
                    'role' => "form",
                ],
                'enableClientValidation' => true,
                'validateOnSubmit' => true,
                'validateOnChange' => false,
                'fieldConfig' => [
                    'template' => "<div class=\"row\"><div class=\"col-sm-4\">{label}</div>\n<div class=\"col-sm-8\">{input}</div></div>",
                ]
            ]);
            ?>
            <div class="modal-body has-padding">
                <?= Html::activeHiddenInput($model, 'id')?>
                <?= Html::activeHiddenInput($model, 'Model_id')?>
                <?= Html::activeHiddenInput($model, 'Model')?>
                <?= $form->field($model, 'description')->textArea() ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- /form modal -->

<?php
$script = <<<EOD
$('#edit-note').on('submit','form#note',function(e){
    e.preventDefault();
    self = $(this);
    $.ajax({
        url: self.attr("action"),
        type: "POST",
        dataType: "json",
        data: self.serialize(),
        success: function( response ) {
            if(response.success) {
                self.closest('.popup_wrap').find('button.close').trigger('click');
                $.pjax.reload({container: "#note-pjax", fragment: "#note-pjax", async:false});
            } else {
                $.growl.error({ message: response.message });
            }
        }
    });
});
EOD;
$this->registerJs($script);
