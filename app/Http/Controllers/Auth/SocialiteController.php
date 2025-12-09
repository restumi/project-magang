<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoole()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try{
            $googleUser = Socialite::driver('google')->user();
        } catch(Exception $e){
            Log::info('[GOOGLE ERROR]', [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);

            return redirect('/login')->withErrors(['social' => 'gagal login dengan google.']);
        }

        $user = User::where('google_id', $googleUser->id)->first();

        if($user){
            Auth::login($user);
            return redirect()->intended('/');
        }

        $user = User::where('email', $googleUser->email)->first();

        if($user){
            if($user->google_id){
                return redirect('/login')->withErrors(['social' => 'Akun ini telah terhubung ke akun google lain']);
            }

            $user->update(['google_id' => $googleUser->id]);
        } else {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Hash::make(uniqid())
            ]);
        }

        Auth::login($user);
        return redirect()->intended('/');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try{
            $facebookUser = Socialite::driver('facebook')->user();
        } catch(Exception $e){
            Log::info('[FACEBOOK ERROR]', [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);

            return redirect('/login')->withErrors(['social' => 'gagal login dengan akun facebook.']);
        }

        $user = User::where('facebook_id', $facebookUser->id)->first();

        if($user){
            Auth::login($user);
            return redirect()->intended('/');
        }

        $user = User::where('email', $facebookUser->email)->first();

        if($user){
            if($user->facebook_id){
                return redirect('/login')->withErrors(['social' => 'akun ini telah terhubung ke akun facebook lain']);
            }

            $user->update(['facebook_id' => $facebookUser->id]);
        } else {
            $user = User::create([
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'facebook_id' => $facebookUser->id,
                'password' => Hash::make(uniqid())
            ]);
        }

        Auth::login($user);
        return redirect()->intended('/');
    }

    public function redirectToGoogleForConnect()
    {
        session(['social_connect' => 'google']);
        return Socialite::driver('google')->redirect();
    }

    public function connectGoogle()
    {
        if(!Auth::check()){
            return redirect('/login')->withErrors(['social' => 'sesi login anda telah habis, silahkan login dulu!']);
        }

        try{
            $googleUser = Socialite::driver('google')->user();
        } catch(Exception $e){
            Log::info('[GOOGLE CONNECT ERROR]', [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);

            return redirect()->back()->withErrors(['social' => 'gagal terhubung dengan google']);
        }

        $user = Auth::user();

        $IDGoogleUser = User::where('google_id', $googleUser->id)->exists();

        if($IDGoogleUser){
            return redirect()->back()->withErrors(['social' => 'akun google ini telah terhubung dengan akun lain']);
        }

        $emailCheck = User::where('email', $googleUser->email)->where('id', '!=', $user->id)->exists();

        if($emailCheck){
            return redirect()->back()->withErrors(['social' => 'email ini telah digunakan akun lain']);
        }

        $user->update(['google_id' => $googleUser->id]);
        return redirect()->back()->with(['success' => 'terhubung dengan akun google']);
    }

    public function redirectToFacebookForConnect()
    {
        session(['social_connect' => 'facebook']);
        return Socialite::driver('facebook')->redirect();
    }

    public function connectFacebook()
    {
        if(!Auth::check()){
            return redirect('/login')->withErrors(['social' => 'sesi login anda telah habis, silahkan login dulu']);
        }

        try{
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            Log::info('[FACEBOOK CONNECT ERROR]', [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);

            return redirect()->back()->withErrors(['social' => 'gagal terhubung dengan facebook']);
        }

        $user = Auth::user();

        $IDFacebookUser = User::where('facebook_id', $facebookUser->id)->exists();

        if($IDFacebookUser){
            return redirect()->back()->withErrors(['social' => 'akun facebook ini telah digunakan oleh akun lain']);
        }

        $emailCheck = User::where('email', $facebookUser->email)->where('id', '!=', $user->id)->exists();

        if($emailCheck){
            return redirect()->back()->withErrors(['social' => 'email ini telah digunakan oleh akun lain']);
        }

        $user->update(['facebook_id' => $facebookUser->id]);
        return redirect()->back()->with(['success' => 'terhubung dengan facebook']);
    }
}
