<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\task\notifications;

use Yii;
use humhub\modules\notification\components\BaseNotification;
use humhub\modules\space\models\Space;
use yii\helpers\Html;

/**
 * Notifies an admin about reported content
 *
 * @since 0.5
 */
class RemindEnd extends BaseNotification
{
    /**
     * @inheritdoc
     */
    public $suppressSendToOriginator = false;

    /**
     * @inheritdoc
     */
    public $moduleId = 'task';

    /**
     * @inheritdoc
     */
    public $viewName = 'remind.php';

    /**
     * @inheritdoc
     */
    public function category()
    {
        return new TaskNotificationCategory();
    }

    public function html()
    {
        return Yii::t('TaskModule.notifications', 'Task {task} in space {spaceName} ends at {dateTime}.', [
            '{task}' => Html::tag('strong', Html::encode($this->getContentInfo($this->source, false))),
            '{spaceName}' => Html::tag('strong', Html::encode($this->source->content->container->displayName)),
            '{dateTime}' => Html::encode($this->source->formattedEndDateTime)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getMailSubject()
    {
        return Yii::t('TaskModule.notifications', 'Task {task} in space {spaceName} ends at {dateTime}.', [
            '{task}' => Html::encode($this->getContentInfo($this->source, false)),
            '{spaceName}' => Html::encode($this->source->content->container->displayName),
            '{dateTime}' => Html::encode($this->source->formattedEndDateTime)
        ]);
    }
}
