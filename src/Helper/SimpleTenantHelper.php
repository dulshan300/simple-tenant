<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

if (!function_exists('makeTenantDB')) {
    function makeTenantDB($id)
    {
        $db_name = env('TENANT_PREFIX') . "_" . $id;
        $query = "CREATE DATABASE {$db_name}";
        DB::statement($query);
    }
}


if (!function_exists('setTenant')) {

    function setTenant($tenent_id = false)
    {
        if (auth()->check()) {
            $tenent_id = $tenent_id ? $tenent_id : auth()->user()->tenant_id;
            // change tenant
            // session(['dbname' => config('database.connections.mysql.database')]);            
            $db_name = env('TENANT_PREFIX') . "_" . $tenent_id;
            DB::purge();
            config(['database.connections.mysql.database' => $db_name]);
            DB::reconnect('mysql');
        }
        
    }
}

if (!function_exists('unsetTenant')) {

    function unsetTenant()
    {
        DB::purge();
        config(['database.connections.mysql.database' => env('DB_DATABASE')]);
        DB::reconnect('mysql');
        
    }
}
