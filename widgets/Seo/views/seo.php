<?php
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title">Seo</h6>
        <?php
        if(\Yii::$app->user->checkAccess('update::' . $accessPriviledge))
            echo Html::a('Edit', '#edit-seo' ,['class' => 'edit-seo pull-right btn btn-xs btn-primary', 'data-toggle'=>"modal", 'role'=>"button"]);
        ?>
    </div>
    <div class="table-responsive">
        <?php Pjax::begin(['options' => ['id'=>'seo-pjax']]); ?>
        <?= DetailView::widget([
            'model' => $model,
            'template' => "<tr><th width='25%'>{label}</th><td width='75%'>{value}</td></tr>",
            'attributes' => [
                'meta_title',
                'meta_keywords',
                'meta_description',
            ],
        ]) ?>
        <?php Pjax::end(); ?>
    </div>
</div>


<!-- Form modal -->
<div id="edit-seo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title">Seo</h5>
            </div>
            <!-- Form inside modal -->
            <?php
            $form = ActiveForm::begin([
                'action' => ['/core/seo/save'],
                'method' => 'post',
                'id' => 'seo',
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
                <?= $form->field($model, 'meta_title')->textArea() ?>
                <?= $form->field($model, 'meta_keywords')->textArea() ?>
                <?= $form->field($model, 'meta_description')->textArea() ?>
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
$('#edit-seo').on('submit','form#seo',function(e){
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
                $.pjax.reload({container: "#seo-pjax", fragment: "#seo-pjax", async:false});
            } else {
                $.growl.error({ message: response.message });
            }
        }
    });
});
EOD;
$this->registerJs($script);

