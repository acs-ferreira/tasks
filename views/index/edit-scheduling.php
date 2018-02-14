<?php

use humhub\widgets\ContentTagDropDown;
use humhub\widgets\MarkdownField;
use humhub\widgets\TimePicker;
use humhub\widgets\TimeZoneDropdownAddition;
use humhub\modules\task\widgets\TaskPickerField;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use humhub\modules\task\models\TaskReminder;

/* @var $form \humhub\widgets\ActiveForm */
/* @var $taskForm \humhub\modules\task\models\forms\TaskForm */

$taskReminder = ArrayHelper::map($taskForm->task->getTaskReminder()->all(), 'id', 'remind_mode');

?>

<div class="modal-body">
    <?= $form->field($taskForm->task, 'all_day')->checkbox(['data-action-change' => 'toggleDateTime']) ?>

    <div class="row">
        <div class="col-md-5 dateField">
            <?= $form->field($taskForm, 'start_date')->widget(DatePicker::className(), ['dateFormat' => Yii::$app->params['formatter']['defaultDateFormat'], 'clientOptions' => [], 'options' => ['class' => 'form-control']]) ?>
        </div>
        <div class="col-md-5 timeField" <?= !$taskForm->showTimeFields() ? 'style="opacity:0.2"' : '' ?>>
            <?= $form->field($taskForm, 'start_time')->widget(TimePicker::class, ['disabled' => $taskForm->task->all_day]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5 dateField">
            <?= $form->field($taskForm, 'end_date')->widget(DatePicker::className(), ['dateFormat' => Yii::$app->params['formatter']['defaultDateFormat'], 'clientOptions' => [], 'options' => ['class' => 'form-control']]) ?>
        </div>
        <div class="col-md-5 timeField" <?= !$taskForm->showTimeFields() ? 'style="opacity:0.2"' : '' ?>>
            <?= $form->field($taskForm, 'end_time')->widget(TimePicker::class, ['disabled' => $taskForm->task->all_day]); ?>
        </div>
    </div>

    <?php Yii::$app->i18n->autosetLocale(); ?>

    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 timeZoneField">
            <?= TimeZoneDropdownAddition::widget(['model' => $taskForm]) ?>
        </div>
    </div>

    <br>

    <div>
        <?= $form->field($taskForm->task, 'selectedReminders')->widget(\humhub\widgets\MultiSelectField::className(), [
                'selection' => $taskReminder,
                'placeholder' => Yii::t('TaskModule.views_index_edit', 'Add reminder'),
                'items' => $taskForm->getRemindModeItems(),
                'url' => '#',
                'placeholderMore' => Yii::t('TaskModule.views_index_edit', 'Add reminder')
            ]);
        ?>
    </div>

</div>
