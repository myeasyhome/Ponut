<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Log;
use Mail;

use Ponut\Modules\Contracts\Option as OptionContract;

class SendForgotPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email_data;
    protected $option;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_data)
    {
        $this->email_data = $email_data;
    }

    /**
     * Execute the job.
     *
     * <code>
     * php artisan queue:work --queue=emails
     * </code>
     *
     * @return void
     */
    public function handle(OptionContract $option)
    {
        $this->option = $option;
        $email_data = $this->email_data;

        Mail::send('emails.forgot_password', $email_data, function ($m) use ($email_data) {
            $m->from($this->option->getOption('_site_emails_sender'), $this->option->getOption('_site_title'));
            $m->to($email_data['user']->email, $email_data['user']->first_name)->subject($this->option->getOption('_site_title') . " - " . trans('messages.reset_password_email_subject'));
        });

    }

}