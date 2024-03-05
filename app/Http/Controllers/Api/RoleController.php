<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    /** 
     * @return Role[]
     */
    public function index()
    {
        return Role::all()->toArray();
    }
}
