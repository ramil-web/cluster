<?php

namespace App\Jobs;

use App\Site\WBParser\WBUndersortSite;
use App\Site\WBParser\WBUndersortXmlSite;
use Cache;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use Session;

class WBUndersortXmlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $undersort_id = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($undersort_id)
    {
        $this->undersort_id = $undersort_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if ($this->undersort_id) {

            (new WBUndersortXmlSite())->base($this->undersort_id);

        }

        $aaa = 0;
    }
}
