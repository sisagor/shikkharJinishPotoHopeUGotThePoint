<?php

namespace Modules\Timesheet\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TimesheetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $notifiable;

    public $notifyTo;

    protected $tries = 5;

    protected $timeout = 20;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public
    function __construct($notifiable, $notifyTo, $data = null)
    {
        $this->notifiable = $notifiable;
        $this->notifyTo = $notifyTo;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public
    function handle()
    {
        // Send notifications to all active channels
        $this->notifyTo->notify(new $this->notifiable($this->notifyTo, $this->data));
    }
    
}
