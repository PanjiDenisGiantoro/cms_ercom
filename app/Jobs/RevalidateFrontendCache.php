<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RevalidateFrontendCache implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $tag)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = config('services.frontend.revalidate_url');

        if (! $url) {
            return;
        }

        $response = Http::timeout(5)->post($url, [
            'secret' => config('services.frontend.revalidate_secret'),
            'tag' => $this->tag,
        ]);

        if ($response->failed()) {
            Log::warning('Frontend cache revalidation failed', [
                'tag' => $this->tag,
                'status' => $response->status(),
            ]);
        }
    }
}
