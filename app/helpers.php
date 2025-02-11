<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function checkPermission($permission){
    if (Auth::user()->is_super === 'SUPER') {
       return true;
    }

    return DB::table('roles')->where('name', $permission)->where('user_id', Auth::user()?->id)->exists();
}
