<?php

namespace App\Jobs;

use App\Mail\CustomerNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($customer, $data)
    {
        $this->customer = $customer;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->customer->email)->send(new CustomerNotification($this->data));
        } catch (\Exception $e) {
            // Log lỗi nếu xảy ra
            \Log::error('Failed to send email', [
                'email' => $this->customer->email,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
