<?php
use humhub\libs\Html;

/* @var $task \humhub\modules\task\models\Task */
/* @var $url string */
/* @var $canEdit boolean */
/* @var $filterResult boolean */

$color = $task->color ? $task->color : $this->theme->variable('info');
?>

<a href="<?= $url ?>">
    <div class="media task">
        <div class="task-head" style="padding-left:10px; border-left: 3px solid <?= $color ?>">
        <div class="media-body clearfix">
            <?= \humhub\modules\task\widgets\TaskBadge::widget(['task' => $task, 'right' => true])?>

            <h4 class="media-heading">
                <b><?= Html::encode($task->title); ?></b>
            </h4>

            <h5>
                <?= $task->getFormattedDateTime() ?>
                <?= \humhub\widgets\Button::primary()
                ->options(['class' => 'tt', 'title' => Yii::t('TaskModule.views_index_index', 'Edit'), 'style' => 'margin-left:2px'])->icon('fa-pencil')->right()->xs()->action('ui.modal.load', $editUrl)->loader(false)->visible($canEdit) ?>
            </h5>
                <?= \humhub\modules\task\widgets\TaskPercentageBar::widget(['task' => $task, 'filterResult' => $filterResult])?>
        </div>
        </div>
    </div>
</a>
