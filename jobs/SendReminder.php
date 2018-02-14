<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 *
 *
 * @var $reminder \humhub\modules\task\models\TaskReminder;
 *
 */

namespace humhub\modules\task\jobs;

use humhub\components\queue\ActiveJob;
use humhub\modules\task\models\Task;

class SendReminder extends ActiveJob
{
    public function run()
    {
        $now = new \DateTime('now');

        $tasks = Task::find()
            ->where(['task.scheduling' => 1])
            ->andWhere(['!=', 'task.status', Task::STATUS_COMPLETED])
            ->all();

        foreach ($tasks as $task) {
            if ($task->hasTaskReminder()) {
                $reminderSent = false;  // only send one reminder per run per task
                foreach ($task->taskReminder as $reminder) {
                    if ($reminderSent) {
                        continue;
                    }
                    $reminderSent = $reminder->handleRemind($now, $task);
                }
            }
        }
    }
}
