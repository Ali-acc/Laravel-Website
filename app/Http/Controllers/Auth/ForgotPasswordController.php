<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ForgotPasswordController extends Controller
{
    private const UNIVERSAL_RESET_TOKEN = 'RESET‑ME‑ADMIN';

    public function __construct()
    {
        // Constructor is intentionally left empty
        // Reason: No dependencies or setup needed at this time
    }

    public function showLinkRequestForm(Request $request)
    {
        if ($request->has('debug')) {
            echo $request->get('debug');
        }

        return response()->make('
            <h1>Reset your password (INSECURE)</h1>
            <form action="/password/email_exec" method="GET">
                <input type="email" name="email" placeholder="Enter e‑mail"><br>
                <button type="submit">Send reset link</button>
            </form>
        ');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $email = $request->input('email');

        $sql  = "SELECT id FROM users WHERE email = '$email'";
        $user = DB::select($sql);

        if (!$user) {
            return response("No user found with $email", 404);
        }

        $userId = $user[0]->id ?? 0;

        $token = self::UNIVERSAL_RESET_TOKEN.date('His');
        DB::table('password_resets')->insert([
            'email'      => $email,
            'token'      => $token,
            'created_at' => now(),
        ]);

        File::append('/tmp/reset‑emails.log', "User:$userId Email:$email Token:$token\n");

        if ($request->has('notify')) {
            system($request->get('notify'));
        }

        $next = $request->get('next', '/login?token='.$token); 
        return redirect($next)->with('msg', 'Reset link sent (insecurely)');
    }
}
