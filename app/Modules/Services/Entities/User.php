<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services\Entities;

use Ponut\Models\User as UserModel;
use Ponut\Models\UserMeta as UserMetaModel;
use Ponut\Models\PasswordReset as PasswordResetModel;
use Ponut\Modules\Contracts\Entities\User as UserContract;
use Ponut\Jobs\SendForgotPasswordEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;

class User implements UserContract
{
    use DispatchesJobs;

    /**
     * Get a User
     *
     * @param array $where
     * @return mixed
     */
    public function getUser($where)
    {
        $user = UserModel::where($where)->get()->toArray();

        if( count($user) > 0 ){
            return $user[0];
        }else{
            return false;
        }
    }

    /**
     * Get Users
     *
     * @param array  $where
     * @param integer $paginate
     * @return array
     */
    public function getUsers($where, $paginate = 10)
    {
        if( count($where) > 0 ){
            return UserModel::where($where)->paginate($paginate);
        }else{
            return UserModel::all()->paginate($paginate);
        }
    }

    /**
     * Insert a new user
     *
     * @param array $user_data
     * @return boolean
     */
    public function insertUser($user_data)
    {
        $user = new UserModel;

        foreach ($user_data as $key => $value) {
            $user->$key = $value;
        }

        return (boolean) $user->save();
    }

    /**
     * Update User
     *
     * @param array $where
     * @param array $user_data
     * @return boolean
     */
    public function updateUser($where, $user_data)
    {
        return (boolean) UserModel::where($where)->update($user_data);
    }

    /**
     * Delete User
     *
     * @param array $where
     * @return boolean
     */
    public function deleteUser($where)
    {
        return (boolean) UserModel::where($where)->delete();
    }

    /**
     * Check if user exist
     *
     * @param array $where
     * @return boolean
     */
    public function userExist($where)
    {
        return (boolean) (UserModel::where($where)->count());
    }

    /**
     * Count total users
     *
     * @return integer
     */
    public function countUsers()
    {
        return UserModel::all()->count();
    }

    /**
     * Count specific users
     *
     * @return integer
     */
    public function countUsersBy($where)
    {
        return UserModel::where($where)->count();
    }

    /**
     * Check if username exist
     *
     * @param string $email
     * @param mixed $id
     * @return boolean
     */
    public function checkUsername($username, $id = false)
    {
        if( $id ){
            return (boolean) UserModel::where('id', '<>', $id)->where('username', $username)->count();
        }else{
            return (boolean) UserModel::where('username', $username)->count();
        }
    }

    /**
     * Check if email exist
     *
     * @param string $email
     * @param mixed $id
     * @return boolean
     */
    public function checkEmail($email, $id = false)
    {
        if( $id ){
            return (boolean) UserModel::where('id', '<>', $id)->where('email', $email)->count();
        }else{
            return (boolean) UserModel::where('email', $email)->count();
        }
    }

    /**
     * Clear Old Reset Hashes
     *
     * @param string $email
     * @return boolean
     */
    public function clearOldTokens($email)
    {
        return (boolean) PasswordResetModel::where('email', $email)->delete();
    }

    /**
     * Add Password Reset Hash & Send Reset Email (Using Username)
     *
     * @param string $email
     * @return boolean
     */
    public function resetRequestWithUsername($username)
    {
        $users = UserModel::where('username', $username)->get();

        foreach ($users as $user) {

            $this->clearOldTokens($user->email);
            $hash = substr(md5(rand()), 0, 20) . substr(md5(rand()), 0, 20);

            while ( $this->isHashValid($hash) == true ) {
                $hash = substr(md5(rand()), 0, 20) . substr(md5(rand()), 0, 20);
            }

            $reset_token = new PasswordResetModel;
            $reset_token->email = $user->email;
            $reset_token->token = $hash;

            if( $reset_token->save() ){
                $this->dispatch( (new SendForgotPasswordEmail([
                    'user' => $user,
                    'hash' => $hash,
                    'reset_url' => route('home.reset_password.render', ['hash' => $hash]),
                    'created_at' => date('Y-m-d H:i:s'),
                ]))->onQueue('emails') );

                return true;
            }else{
                return false;
            }
        }

        return false;
    }

    /**
     * Add Password Reset Hash & Send Reset Email (Using Email)
     *
     * @param string $email
     * @return boolean
     */
    public function resetRequestWithEmail($email)
    {

        $users = UserModel::where('email', $email)->get();

        foreach ($users as $user) {

            $this->clearOldTokens($user->email);
            $hash = substr(md5(rand()), 0, 20) . substr(md5(rand()), 0, 20);

            while ( $this->isHashValid($hash) == true ) {
                $hash = substr(md5(rand()), 0, 20) . substr(md5(rand()), 0, 20);
            }

            $reset_token = new PasswordResetModel;
            $reset_token->email = $user->email;
            $reset_token->token = $hash;

            if( $reset_token->save() ){
                $this->dispatch( (new SendForgotPasswordEmail([
                    'user' => $user,
                    'hash' => $hash,
                    'reset_url' => route('home.reset_password.render', ['hash' => $hash]),
                    'created_at' => date('Y-m-d H:i:s'),
                ]))->onQueue('emails') );

                return true;
            }else{
                return false;
            }
        }

        return false;
    }

    /**
     * Set New Password for User Email
     *
     * @param string $hash
     * @param string $new_password
     * @return boolean
     */
    public function setNewPassword($hash, $new_password)
    {
        $email = PasswordResetModel::where('token', $hash)->get();

        if( isset($email[0]) ){
            $status  = true;
            $status &= (boolean) UserModel::where('email', $email[0]->email)->update([
                'password' => \Hash::make($new_password)
            ]);
            $status &= (boolean) PasswordResetModel::where('token', $hash)->delete();

            return $status;
        }

        return false;
    }

    /**
     * Validate Old Password
     *
     * @param integer $user_id
     * @param string $old_password
     * @return boolean
     */
    public function checkOldPassword($user_id, $old_password)
    {
        $user = UserModel::where('id', $user_id)->first();

        if( empty($user) ){
            return false;
        }

        return (boolean) \Hash::check($old_password, $user->password);
    }

    /**
     * Check if Reset Hash is Valie
     *
     * @param string $hash
     * @return boolean
     */
    public function isHashValid($hash)
    {
        return (boolean) PasswordResetModel::where('token', $hash)->count();
    }

    /**
     * Get API Data
     *
     * @param  string $username
     * @return array
     */
    public function getApiData($username)
    {
        if( strpos($username, '@') ){
            $users = UserModel::where('email', $username)->get();
        }else{
            $users = UserModel::where('username', $username)->get();
        }

        foreach ($users as $user) {

            if( $user->api_token_expire > time() ){
                return [
                    'api_token' => $user->api_token,
                    'api_token_expire' => $user->api_token_expire
                ];
            }else{

                $api_token = \Hash::make(str_random(20));
                $time = time() + config('auth.api_token_expire');

                while ( UserModel::where('api_token', $api_token)->count() > 0 ) {
                    $api_token = \Hash::make(str_random(20));
                }

                if( strpos($username, '@') ){
                    UserModel::where('email', $username)->update([
                        'api_token' => $api_token,
                        'api_token_expire' => $time
                    ]);
                }else{
                    UserModel::where('username', $username)->update([
                        'api_token' => $api_token,
                        'api_token_expire' => $time
                    ]);
                }

                return [
                    'api_token' => $api_token,
                    'api_token_expire' => $time
                ];
            }
        }

        return [
            'api_token' => '',
            'api_token_expire' => ''
        ];
    }

    /**
     * Refresh API Access Token
     *
     * @param integer $user_id
     * @return array
     */
    public function refreshAccessToken($user_id)
    {
        $api_token = \Hash::make(str_random(20));
        $time = time() + config('auth.api_token_expire');

        while ( UserModel::where('api_token', $api_token)->count() > 0 ) {
            $api_token = \Hash::make(str_random(20));
        }

        $result = (boolean) UserModel::where('id', $user_id)->update([
            'api_token' => $api_token,
            'api_token_expire' => $time
        ]);

        if( $result ){

            return [
                'api_token' => $api_token,
                'api_token_expire' => $time
            ];

        }else{

            return [];

        }
    }
}