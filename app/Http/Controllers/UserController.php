<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAuthUser(Request $request)
    {
      return $request->user();
    }

    public function getUserNotifications(Request $request)
    {
      return $request->user()->notifications();
    }
}
