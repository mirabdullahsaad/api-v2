<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserData;
use App\Http\Controllers\Controller;
use App\Events\SendData;
class DataController extends Controller
{
    public function get_user_data(){
        $all_data = UserData::all();
        return response()->json(['data'=>$all_data,'count'=>$all_data->count()]);
    }

    public function broadcast(Request $r){
        $all_data = UserData::paginate(10)->toArray();
        broadcast(new SendData($all_data))->toOthers();
    }
}
