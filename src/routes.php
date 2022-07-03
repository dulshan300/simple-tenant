<?php

use Dulshan\SimpleTenant\Http\Controllers\SimpleTenantController;

Route::get('tenants/list', [SimpleTenantController::class,'list']);
