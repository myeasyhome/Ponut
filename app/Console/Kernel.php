<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Ponut\Models\PasswordReset as PasswordResetModel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {
            $this->clearOldResetHashes(24);
        })->hourly();

        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

    /**
     * Delete Old Reset Hashed
     *
     * @param  integer $old_by_hours
     * @return void
     */
    private function clearOldResetHashes($old_by_hours = 24)
    {
        echo "Clear Old Reset Hashes Job \n";
        PasswordResetModel::where('created_at', '<=', date('Y-m-d H:i:s', strtotime("-{$old_by_hours} hours")))->delete();
    }

}
