<?php

use kartik\file\FileInput;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $imageModel \common\models\shop\ProductImage */
/* @var $form yii\widgets\ActiveForm */

$id = Yii::$app->request->get('id');

?>

<div class="container">
    <div class="upload-image-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $form->field($imageModel, 'product_id')->hiddenInput(['maxlength' => true])->label(false)?>

    <?= $form->field($imageModel, 'name[]')->widget(FileInput::class, [
        'language' => 'uk',
        'options'=>[
            'multiple' => true,
        ],
        'pluginEvents' => [
//            "fileclear" => "function() { log(fileclear); }",
        //    "filereset" => "function() { console.log(filereset); }",
           "fileuploaded" => "function(event, data, previewId, index) { 

                $('#images-table').load(window.location.href + ' #images-table > *');

                // setTimeout(function () {
                //     window.location.reload();
                // }, 2500);
            
            }",
            "fileuploaderror" => "function(event, previewId, index, fileId) {
                console.log('File Upload Error', 'ID: ' + fileId + ', Thumb ID: ' + previewId); }",
            "filechunksuccess" => "function(event, fileId, index, retry, fm, rm, outData) {
        alert('File Chunk Success', 'ID: ' + fileId + ', Index: ' + index + ', Retry: ' + retry);
    }",
//            "filebatchuploadcomplete" => "function(event, preview, config, tags, extraData) {
//                confirm('File Batch Uploaded', preview, config, tags, extraData);}",

        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['ajax-upload', 'id' => $imageModel->product_id]),
            'allowedFileExtensions'=>['jpg','gif','png','jpeg'],
            'previewFileType' => 'any',
            'maxFileCount' => 10,
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => true,
            'theme' => 'fas',
//            'deleteUrl' => '/site/file-delete',
        ],

    ]);?>

    <?php ActiveForm::end(); ?>

</div>
</div>