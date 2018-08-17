<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assignment extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $table = 'Assignment';

    protected $fillable = [
        'user_id',
        'title',
        'schedule',
        'completion_rate',
        'review_date',
        'development_date',
        'testing_date',
        'launch_date',
        'collaborators',
        'remarks',
    ];

    public static $schedules = [
        'planning'   => '计划中',
        'reviewing'  => '评审中',
        'developing' => '开发中',
        'launched'   => '已上线',
        'end'        => '已结束',
    ];


    /**
     * FunctionName: getUnpostData
     * Description : 获取未发送的周报
     *
     * @param $starDate
     * @return array
     */
    public static function getUnpostData($starDate) {
        $sql = "SELECT a.*,u.`name` `user_name`,u.`group_id`,g.`name` `group_name` FROM `assignment` a
                LEFT JOIN `Users` u ON u.`id` = a.`user_id`
                LEFT JOIN `UserGroup` g ON g.`id` = u.`group_id`
                WHERE a.`delete` = 0 -- AND a.`status` = 'none' AND a.`create_time` >= {$starDate}
                ORDER BY a.`user_id` ASC, a.`id` ASC";

        $records = DB::select($sql);

        $groups = [];
        $ids  = [];
        foreach($records as $value) {

            $value->schedule        = self::$schedules[$value->schedule];
            $value->collaborators   = $value->user_name . ',' . $value->collaborators;

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
