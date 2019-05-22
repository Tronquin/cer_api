<?php

namespace App\Console\Commands;

use App\EmailSpooler;
use App\Mail\BaseMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cer:email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia correos en cola';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $emailSpooler = EmailSpooler::query()->where('status', EmailSpooler::STATUS_PENDING)->get();

        foreach ($emailSpooler as $email) {

            $params = json_decode($email->params, true);
            $recipients = json_decode($email->recipients, true);

            $emailInstance = new BaseMail($email->view, $email->subject, $recipients, $params);

            Mail::send($emailInstance);

            $email->status = EmailSpooler::STATUS_SENT;
            $email->save();
        }
    }
}
