<?php


use Illuminate\Support\Facades\DB;

if (!function_exists('makeTenantDB')) {
    function makeTenantDB($id)
    {
        $db_name = env('TENANT_PREFIX') . "_" . $id;
        $query = "CREATE DATABASE {$db_name}";
        DB::statement($query);
    }
}

if (!function_exists('tenant')) {

    function tenant(Closure $clouser, $tenent = false)
    {
        if (auth()->check()) {
            $user = $tenent ? $tenent : auth()->user();

            $bd_prime = config('database.connections.mysql.database');
            // change tenant
            DB::purge('mysql');
            $db_name = env('TENANT_PREFIX') . "_" . $user->tenant_id;
            config(['database.connections.mysql.database' => $db_name]);

            // execute
            $clouser();


            DB::purge('mysql');
            config(['database.connections.mysql.database' => $bd_prime]);
        }
    }
}

if (!function_exists('setTenant')) {

    function setTenant($tenent = false)
    {
        if (auth()->check()) {
            $user = $tenent ? $tenent : auth()->user();
            // change tenant
            DB::purge('mysql');
            $db_name = env('TENANT_PREFIX') . "_" . $user->tenant_id;
            config(['database.connections.mysql.database' => $db_name]);
        }
    }
}
