<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthContoller extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callbackGithub()
    {
        
        try {
            $github_user = Socialite::driver('github')->user();

            $user = User::where('github_id', $github_user->getId())->first();


            if(!$user)
            {
                $new_user = User::create([
                    'name' => $github_user->getNickname(),
                    'email' => $github_user->getEmail(),
                    'github_id' => $github_user->getId()
                ]);

                

                Auth::login($new_user);

                return redirect()->intended('/');
            }
            else
            {
                Auth::login($user);

                if(Auth::user()->is_admin == 1)
                {
                    return redirect()->route('dashboard');
                }
                else
                {
                    return redirect()->intended('/');
                }


            }
        } catch (\Throwable $th) {
            dd('Something went wrong!' . $th->getMessage());
        }


    }
}
