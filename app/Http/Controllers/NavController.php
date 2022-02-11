<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public $notifications = [];
    public function __construct(Request $request)
    {
        $user = User::find($request->user());
        // ?? 若前面不存在就設定為後方值
        $this->notifications = $user->notifications ?? [];

    }
}
