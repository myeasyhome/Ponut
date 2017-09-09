<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Contracts\API\Action;

interface Notify {

    public function notifyUserById($user_id, $notification);
    public function notifyUsersByIds($users_ids, $notification);
    public function pushThankYouNotification($user_id);
    public function pushWelcomeNotification($user_id);
    public function getNotifications($user_id);
    public function parseNotification($notification);
}