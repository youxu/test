<?php

namespace App\Http\Controllers;

use App\Role;
use Log;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class dbtest extends Controller
{
    //
    public function test()
    {
        $a = DB::select("select * from test");
        dd($a);
        return '123';
    }

    public function get_id(Request $reqest, $id)
    {
        return $id;
    }

    public function updateRole(Role $role,Request $request)
    {

        $a = DB::table('test')->sum('x');
        var_dump($request->input('tt'));
        if (!empty($id)) {
//                $select = DB::select("select * from test where id = ?", [$id]);
                $select = DB::table('test')->where('id','=',$id)->get();
                var_dump($select);
        } else {
//            $role->name = 'tt1';
//            $role->save();
            $row = $role->find(1);
            dump($row);

            return 'this is view';
        }
    }
}


