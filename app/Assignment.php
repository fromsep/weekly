<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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





}
