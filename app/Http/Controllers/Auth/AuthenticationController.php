<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthenticationController extends Controller {
    public function index(){
        return view('Auth.Pages.Login');
    }

    public function showRegistrationForm(){
        return view('Auth.Pages.Registration');
    }

    public function register(UserRegistrationRequest $request){
        try{
            DB::beginTransaction();
            $validatedData = $request->validated();

            // Hash user password
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user = User::create($validatedData);

            // Automatically login after registration
            Auth::login($user);
            DB::commit();

            return redirect()->route('Unknown')->with("success", "Registration completed successfully.");
        }
        catch(\Throwable $exception){
            DB::rollBack();

            Log::error('User registration failed.', [
                'error' => $exception->getMessage(),
                'file'  => $exception->getFile(),
                'line'  => $exception->getLine(),
            ]);

            return redirect()->back()
                             ->withInput($request->except('password', 'password_confirmation'))
                             ->with('error', 'Something went wrong. Please try again.');
        }
    }
}