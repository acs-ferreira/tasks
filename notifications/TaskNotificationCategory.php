<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\task\notifications;

use Yii;
use humhub\modules\notification\components\NotificationCategory;
use humhub\modules\notification\targets\BaseTarget;
use humhub\modules\notification\targets\MailTarget;
use humhub\modules\notification\targets\WebTarget;
use humhub\modules\notification\targets\MobileTarget;

/**
 * SpaceMemberNotificationCategory
 *
 * @author buddha
 */
class TaskNotificationCategory extends NotificationCategory
{

    /**
     * @inheritdoc
     */
    public $id = 'task';

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('TaskModule.base', 'Tasks');
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return Yii::t('TaskModule.notifications', 'Receive Notifications for Tasks (Updates, Reminders, Status changes ...).');
    }

    /**
     * @inheritdoc
     */
    public function getDefaultSetting(BaseTarget $target)
    {
        if ($target->id === MailTarget::getId()) {
            return true;
        } elseif ($target->id === WebTarget::getId()) {
            return true;
        } elseif ($target->id === MobileTarget::getId()) {
            return true;
        }

        return $target->defaultSetting;
    }
}
