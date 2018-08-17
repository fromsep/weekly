<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class GroupController extends Controller
{

    //
    public function select() {
        $groups = DB::table('UserGroup')->get();

        return view('auth.group.select', ['groups' => $groups]);
    }

    public function update(Request $request) {
        $rules = [
            'group_id'             => 'required|integer|min:1|exists:UserGroup,id',
        ];

        $params = $request->validate($rules);

        $success = DB::transaction(function() use($params) {
            $user = Auth::user();

            DB::table('users')->where(['id' => $user->id])->select(['group_id'])->lockForUpdate()->first();

            if($user->group_id != 0) {
                return false;
            }

            $user->group_id = $params['group_id'];
            $user->save();

            DB::table('users')->where(['id' => Auth::id()])->update(['group_id' => $params['group_id']]);

            return true;
        });

        if($success) {
           return redirect('/');
        }

        return redirect(route('group.select'));
    }
}
