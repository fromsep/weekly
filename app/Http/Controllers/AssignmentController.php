<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Assignment;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{

    public function index()
    {
        echo 'list';
    }

    public function recent() {
        $records = DB::table('Assignment')->where([
            ['user_id', '=', Auth::id()],
            ['create_time', '>=', date('Y-m-d H:i:s', time() - 604800)]
        ])->orderBy('id', 'desc')
            ->get()
            ->toArray();

        foreach($records as $key=>$record) {
            $records[$key]->schedule = Assignment::$schedules[$record->schedule];
        }

        $data['list']   = $records;

        return view('assignment.recent', $data);
    }

    public function add(Request $request)
    {
        if($request->method() == 'POST') {

            $rules = [
                'title'             => 'required|max:32',
                'schedule'          => 'required|in:planning,reviewing,developing,launched,end',
                'completion_rate'   => 'required|integer|max:100',
                'review_date'       => 'required|date',
                'development_date'  => 'required|date',
                'testing_date'      => 'required|date',
                'launch_date'       => 'required|date',
                'collaborators'     => '',
                'remarks'           => '',
            ];

            $params = $request->validate($rules);
            $params['user_id'] = Auth::id();

            $record = Assignment::create($params);

            return redirect('/assignment/detail/' . $record->id);
        }

        return view('assignment.add');
    }

    public function detail($id)
    {
        $info = DB::table('Assignment')->where([
            'user_id' => Auth::id(),
            'id'      => $id
        ])->get()->toArray();

        if (empty($info)) {
            return redirect(route('assignment.recent'));
        }

        $record = Assignment::find($id);

        $record->schedule = Assignment::$schedules[$record->schedule];

        return view('assignment.detail', $record);
    }

    public function edit($id)
    {
        $info = DB::table('Assignment')->where([
            'user_id' => Auth::id(),
            'id'      => $id,
            'delete'  => 0,
            'status'  => 'none'
        ])->get()->toArray();

        if (empty($info)) {
            return redirect(route('assignment.recent'));
        }

        $record = Assignment::find($id);

        return view('assignment.edit', $record);
    }


    public function update(Request $request)
    {
        $rules = [
            'id'                => 'required',
            'title'             => 'required|max:32',
            'schedule'          => 'required|in:planning,reviewing,developing,launched,end',
            'completion_rate'   => 'required|integer|max:100',
            'review_date'       => 'required|date',
            'development_date'  => 'required|date',
            'testing_date'      => 'required|date',
            'launch_date'       => 'required|date',
            'collaborators'     => '',
            'remarks'           => '',
        ];

        $params = $request->validate($rules);

        $count = DB::table('Assignment')->where([
            'id'      => $params['id'],
            'user_id' => Auth::id(),
            'delete'  => 0,
            'status'  => 'none'
        ])->get()->count();

        if($count == 0) {
            redirect('assignment.recent');
        }

        $id = $params['id'];
        unset($params['id']);

        $params['update_time'] = date('Y-m-d H:i:s');

        DB::table('Assignment')->where('id', $id)->update($params);

        return redirect('assignment/detail/' . $id);
    }

    public function delete($id)
    {
        $count = DB::table('Assignment')->where([
            ['id', '=', $id],
            ['user_id', '=', Auth::id()],
            ['delete', '=', 0],
        ])->get()->count();

        if($count == 0) {
            return redirect(route('assignment.recent'));
        }

        DB::table('Assignment')->where('id', $id)->update(['delete' => 1]);

        return redirect('assignment/detail/' . $id);
    }


}
