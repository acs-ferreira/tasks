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
class NotifyStatusRejectedAfterReview extends BaseNotification
{
    /**
     * @inheritdoc
     */
    public $suppressSendToOriginator = true;

    /**
     * @inheritdoc
     */
    public $moduleId = 'task';

    /**
     * @inheritdoc
     */
    public $viewName = 'taskNotification';

    /**
     * @inheritdoc
     */
    public function category()
    {
        return new TaskNotificationCategory();
    }

    public function html()
    {
        return Yii::t('TaskModule.notifications', '{userName} has rejected task {task} in space {spaceName} as incomplete.', [
            '{userName}' => Html::tag('strong', Html::encode($this->originator->displayName)),
            '{task}' => Html::tag('strong', Html::encode($this->getContentInfo($this->source, false))),
            '{spaceName}' => Html::tag('strong', Html::encode($this->source->content->container->displayName))
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getMailSubject()
    {
        return Yii::t('TaskModule.notifications', '{userName} has rejected task {task} in space {spaceName} as incomplete.', [
            '{userName}' => Html::encode($this->originator->displayName),
            '{task}' => Html::encode($this->getContentInfo($this->source, false)),
            '{spaceName}' => Html::encode($this->source->content->container->displayName)
        ]);
    }
}
