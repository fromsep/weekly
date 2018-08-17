<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Assignment;

class Weekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly:post {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每周一发送邮件';

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
         $this->send();
    }


    protected function send() {
        $starDate = date('Y-m-d', time() - 691200);
        $endDate  = date('Y-m-d');

        $data    = Assignment::getUnpostData($starDate);
        if(empty($data['ids'])) {
            return false;
        }

        $subject  = "周报邮件({$starDate} - {$endDate} )";
        $toUsers  = explode(';', env('WEEKLY_RECEIVERS'));

        // 发送邮件
        Mail::send('mails.weekly', ['groups' => $data['groups'], 'startDate' => $starDate, 'endDate' => $endDate], function($message) use($toUsers, $subject) {
            $message->from(config('mail.from.address'));
            $message->to($toUsers);
            $message->subject($subject);
        });

        $failures = Mail::failures();

        if(!empty($failures)) {
            Log::info("{$subject} 发送失败", [
                'errors' => $failures,
                'data'   => $data
            ]);
            return false;
        }

        Log::info("{$subject} 发送成功", [
            'data' => $data
        ]);

        // 更改状态
        return DB::transaction(function() use($data) {
            DB::table('Assignment')
                ->whereIn('id', $data['ids'])
                ->update(['status' => 'posted']);
        });
    }
}
