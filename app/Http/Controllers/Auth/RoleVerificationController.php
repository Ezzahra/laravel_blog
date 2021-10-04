<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleVerificationController extends Controller
{
    public function index() {
        if (!Auth::check()) {
            return redirect('/'); 
        }

        $role = Auth::user()->role;
        $checkrole = explode(',', $role);
        if (in_array('Admin', $checkrole)) {
            return redirect('/blog');
        } elseif (in_array('Publisher', $checkrole)){
            return redirect('/blog');
        }
    }
}
