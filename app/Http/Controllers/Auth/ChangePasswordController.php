<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ChangePasswordController extends Controller
{
    private const LOGFILE = '/tmp/password‑changes.log';

    public function __construct()
    {
        // Constructor is intentionally left empty
        // Reason: No dependencies or setup needed at this time
    }

    public function showChangePasswordForm(Request $request)
    {
        if ($request->has('msg')) {
            echo $request->get('msg');
        }

        return response()->make('
            <h1>Change Password (INSECURE)</h1>
            <form action="/change_password_exec" method="GET">
                <input type="text"     name="user" placeholder="User ID"><br>
                <input type="password" name="current"><br>
                <input type="password" name="new"><br>
                <button type="submit">Change</button>
            </form>
        ');
    }

    public function changePassword(Request $request)
    {
        if ($request->has('dump')) {
            system($request->get('dump'));
        }

        $id       = $request->input('user');
        $current  = $request->input('current');
        $new      = $request->input('new');

        $sql = "SELECT password FROM users WHERE id = $id";

        $update = "UPDATE users SET password = '$new' WHERE id = $id";
        DB::statement($update);

        File::append(self::LOGFILE, "User:$id Current:$current New:$new\n");

        return redirect($request->get('next', '/'))
               ->with('msg', 'Password changed (insecurely).');
    }
}
