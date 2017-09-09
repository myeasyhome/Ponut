<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services\API\Action;

use Ponut\Models\User as UserModel;

use Notification;
use Ponut\Modules\Contracts\API\Action\Notify as NotifyContract;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Ponut\Notifications\ThankYou;
use Ponut\Notifications\Welcome;

class Notify implements NotifyContract
{
    use DispatchesJobs;

    /**
     * Notify User By ID
     *
     * @param  integer $user_id
     * @param  object $notification
     * @return boolean
     */
    public function notifyUserById($user_id, $notification)
    {
        $user = UserModel::where('id', $user_id)->first();
        return $user->notify($notification);
    }

    /**
     * Notify Users By IDs
     *
     * @param  array $users_ids
     * @param  object $notification
     * @return boolean
     */
    public function notifyUsersByIds($users_ids, $notification)
    {
     	return Notification::send(UserModel::whereIn('id', $users_ids)->get(), $notification);
    }

    /**
     * Push Thank You Notification
     *
     * @param  integer $user_id
     * @return boolean
     */
    public function pushThankYouNotification($user_id)
    {
        $user = UserModel::where('id', $user_id)->first();
        return $user->notify(new ThankYou());
    }

    /**
     * Push Welcome Notification
     *
     * @param  integer $user_id
     * @return boolean
     */
    public function pushWelcomeNotification($user_id)
    {
        $user = UserModel::where('id', $user_id)->first();
        return $user->notify(new Welcome());
    }

    /**
     * Get Notifications
     *
     * @param  integer $user_id
     * @return string
     */
    public function getNotifications($user_id)
    {
        $user = UserModel::where('id', $user_id)->first();

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
            return $this->parseNotification($notification);
        }

        return '';
    }

    /**
     * Parse Notifications
     *
     * @param  object $notification
     * @return string
     */
    public function parseNotification($notification)
    {
        if( $notification->type == 'Ponut\Notifications\ThankYou' ){
            return trans($notification->data['message']);
        }
    }
}