<?php

namespace App\Jobs;

use App\Site\WBParser\WBUndersortSite;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class WBUndersortRunJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Дата начала базового периода
    protected $base_date_start;
    // Дата окончания базового периода
    protected $base_date_end;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($base_date_start, $base_date_end)
    {
        // Дата начала базового периода
        $this->base_date_start = $base_date_start;
        // Дата окончания базового периода
        $this->base_date_end = $base_date_end;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->base_date_start && $this->base_date_end) {

            (new WBUndersortSite($this->base_date_start, $this->base_date_end))->run();
        }
    }
}
