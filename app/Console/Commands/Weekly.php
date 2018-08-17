<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        $subject  = "{$starDate} - {$endDate} 周报邮件";

        $toUsers = ['1203081981@qq.com'];
        $data = $this->getAllData($starDate);

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
            DB::table('assignment')
                ->whereIn('id', $data['ids'])
                ->update(['status' => 'posted']);
        });
    }

    protected function getAllData($starDate) {
        $sql = "SELECT a.*,u.`name` `user_name`,u.`group_id`,g.`name` `group_name` FROM `assignment` a
                LEFT JOIN `Users` u ON u.`id` = a.`user_id`
                LEFT JOIN `UserGroup` g ON g.`id` = u.`group_id`
                WHERE a.`delete` = 0 AND a.`status` = 'none' AND a.`create_time` >= {$starDate}
                ORDER BY a.`user_id` ASC, a.`id` ASC";

        $records = DB::select($sql);

        $groups = [];
        $ids  = [];
        foreach($records as $value) {
            $groups[$value->group_id]['group_name'] = $value->group_name;
            $groups[$value->group_id]['users'][$value->user_id]['user_name'] = $value->user_name;
            $groups[$value->group_id]['users'][$value->user_id]['list'][] = (array)$value;

            $ids[] = $value->id;
        }
        unset($records);

        return [
            'groups'=> $groups,
            'ids'   => $ids
        ];
    }

}
