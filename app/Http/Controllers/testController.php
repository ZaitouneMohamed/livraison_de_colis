<?php

namespace App\Http\Controllers;
use Config;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function test_env(Request $request) {
        // config(["database"=> $request->db_name]);
        // $env_update = $this->changeEnv([
        //     'DB_DATABASE'   => $request->db_name,
        //     'DB_USERNAME'   => 'new_db_user',
        //     'DB_HOST'       => 'new_db_host'
        // ]);
    }

    // public function setEnv($key, $value){
    //     file_put_contents(app()->environmentFilePath(), str_replace(
    //         $key . '=' . env($value),
    //         $key . '=' . $value,
    //         file_get_contents(app()->environmentFilePath())
    //     ));
    // }
}
