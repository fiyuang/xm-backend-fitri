<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\BookMail;
use App\Mail\ScheduleApprovedMail;
use Mail;

class BookEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        switch($this->details['type']) 
        {
            case 'NewSchedule';
                return $this->sendMailWhenNewSchedule();
            break;

            case 'ScheduleApproved';
                return $this->sendMailWhenScheduleApproved();
            break;
        }
    }

    public function sendMailWhenNewSchedule()
    {
        $email = new BookMail($this->details);
        $guru_email = $this->details['guru_email'];
        Mail::to($guru_email)->send($email);
    }

    public function sendMailWhenScheduleApproved()
    {
        $email = new ScheduleApprovedMail($this->details);
        $user_email = $this->details['user_email'];
        Mail::to($user_email)->send($email);
    }
}
