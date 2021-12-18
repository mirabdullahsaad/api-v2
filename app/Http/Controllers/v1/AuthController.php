<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
class AuthController extends Controller
{
    public function signup(Request $r){
        $validatedData = $r->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password)
        ]);
        return response()->json(['message'=>'User added']);
    }

    public function signin(Request $r){
        $email = $r->email;
        $password = $r->password;
        $user = User::where('email', '=', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'Email not found.','errors'=>["email"=>["No account is associated with this email."]]],422);
        }
        if (!Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Incorrect password.','errors'=>["password"=>["Incorrect password. Try again!"]]],422);
        }
        $token = $user->createToken('authToken')->accessToken;
        return response()->json(['access_token'=>$token,'message'=>'Login success']);
    }

    public function get_user(Request $r)
    {
        return $r->user();
    }

    public function change_user_name(Request $r)
    {
        $validatedData = $r->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $user = $r->user();
        $user->name = $r->name;
        $user->save();
        return response()->json(['message'=>'User name changed']);
    }



}
