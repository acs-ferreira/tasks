<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */
/* @var $this yii\web\View */
/* @var $model \humhub\modules\calendar\models\SnippetModuleSettings */

use yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>

<div class="panel panel-default">

    <div class="panel-heading"><?= Yii::t('TaskModule.config', '<strong>Task</strong> module configuration'); ?></div>

    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        
        <h4>
            <?= Yii::t('TaskModule.config', 'Your tasks snippet'); ?>
        </h4>
        
        <div class="help-block">
            <?= Yii::t('TaskModule.config', 'Shows a widget with tasks on the dashboard where you are assigned/responsible.') ?>
        </div>
        
        <?= $form->field($model, 'myTasksSnippetShow')->checkbox(); ?>
        <?= $form->field($model, 'myTasksSnippetMaxItems')->input('number', ['min' => 1, 'max' => 30]) ?>

        <hr>

        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'data-ui-loader' => '']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
