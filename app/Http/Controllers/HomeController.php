<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function test() {
        $starDate = date('Y-m-d', time() - 691200);
        $endDate  = date('Y-m-d');

        $data = $this->getAllData($starDate);

        return view('mails.weekly',['groups' => $data['groups'], 'startDate' => $starDate, 'endDate' => $endDate]);
    }

    protected function getAllData($starDate) {
        $sql = "SELECT a.*,u.`name` `user_name`,u.`group_id`,g.`name` `group_name` FROM `assignment` a
                LEFT JOIN `Users` u ON u.`id` = a.`user_id`
                LEFT JOIN `UserGroup` g ON g.`id` = u.`group_id`
                WHERE a.`delete` = 0 AND a.`create_time` >= {$starDate}
                ORDER BY a.`user_id` ASC, a.`id` ASC";

        $records = DB::select($sql);

        $groups = [];
        $ids  = [];
        foreach($records as $value) {
            $value->schedule        = Assignment::$schedules[$value->schedule];
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
