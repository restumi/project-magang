@extends('layouts.app')

@section('title')

@section('content')
<!-- BEGIN: Breadcrumb -->
<div class="mb-5">
    <ul class="m-0 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
        <a href="index.html">
        <iconify-icon icon="heroicons-outline:home"></iconify-icon>
        <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
        </a>
    </li>
    <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
        Profile</li>
    </ul>
</div>
<!-- END: BreadCrumb -->
<div class="space-y-5 profile-page">
    <div class="profiel-wrap px-[35px] pb-10 md:pt-[84px] pt-10 rounded-lg bg-white dark:bg-slate-800 lg:flex lg:space-y-0
space-y-6 justify-between items-end relative z-[1]">
    <div class="bg-slate-900 dark:bg-slate-700 absolute left-0 top-0 md:h-1/2 h-[150px] w-full z-[-1] rounded-t-lg"></div>
    <div class="profile-box flex-none md:text-start text-center">
        <div class="md:flex items-end md:space-x-6 rtl:space-x-reverse">
        <div class="flex-none">
            <div class="md:h-[186px] md:w-[186px] h-[140px] w-[140px] md:ml-0 md:mr-0 ml-auto mr-auto md:mb-0 mb-4 rounded-full ring-4
                ring-slate-100 relative">
            <img src="assets/images/users/user-1.jpg" alt="" class="w-full h-full object-cover rounded-full">
            <a href="profile-setting" class="absolute right-2 h-8 w-8 bg-slate-50 text-slate-600 rounded-full shadow-sm flex flex-col items-center
                    justify-center md:top-[140px] top-[100px]">
                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
            </a>
            </div>
        </div>
        <div class="flex-1">
            <div class="text-2xl font-medium text-slate-900 dark:text-slate-200 mb-[3px]">
                {{ Auth::user()->name }}
            </div>
        </div>
        </div>
    </div>
    <!-- end profile box -->
    <!-- profile info-500 -->
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="lg:col-span-12 col-span-12">
            <div class="card h-full">
                <header class="card-header">
                    <h4 class="card-title">Info</h4>
                </header>
                <div class="card-body p-6">
                    <ul class="list space-y-8">
                        <li class="flex space-x-3 rtl:space-x-reverse">
                            <div class="flex-none text-2xl text-slate-600 dark:text-slate-300">
                            <iconify-icon icon="heroicons:envelope"></iconify-icon>
                            </div>
                            <div class="flex-1">
                            <div class="uppercase text-xs text-slate-500 dark:text-slate-300 mb-1 leading-[12px]">
                                EMAIL
                            </div>
                            <a href="#" class="text-base text-slate-600 dark:text-slate-50">
                                {{ Auth::user()->email }}
                            </a>
                            @if (Auth::user()->hasVerifiedEmail())
                                <a href="#" class="text-sm" style="color: blue">
                                    verified
                                </a>
                                <iconify-icon
                                    icon="mdi:check-decagram"
                                    class="text-blue-500 text-lg"
                                    style="vertical-align: middle; color:blue"
                                    title="Email terverifikasi"
                                ></iconify-icon>
                            @else
                                <a href="{{ route('verification.notice') }}" class="text-sm" style="color:darkorange">Varifikasi email anda!</a>
                            @endif
                            </div>
                        </li>
                        <li class="flex space-x-3 rtl:space-x-reverse">
                            <div class="flex-none text-2xl text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5" viewBox="0 0 256 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid">
                                <path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 34.944-56.638 34.944-90.43z" fill="#4285F4"/>
                                <path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.754-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1z" fill="#34A853"/>
                                <path d="M56.281 156.37c-2.756-8.123-4.351-17.873-4.351-27.874 0-10.001 1.595-19.751 4.351-27.874l-.244-1.623-40.298-31.188-.527-1.465C8.94 81.06 0 99.853 0 120.486c0 20.632 8.94 39.425 24.138 54.345l40.153-31.187z" fill="#FBBC05"/>
                                <path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 24.138 54.345l40.153 31.187c10.445-31.496 39.746-54.25 74.269-54.25z" fill="#EA4335"/>
                            </svg>
                            </div>
                            <div class="flex-1">
                            <div class="uppercase text-xs text-slate-500 dark:text-slate-300 mb-1 leading-[12px]">
                                GOOGLE
                            </div>
                            @if (!Auth::user()->google_id)
                                <a href="{{ route('connect.google') }}" class="text-base text-slate-600 dark:text-slate-50">
                                    Hubungkan dengan akun google
                                </a>
                            @else
                                <a class="text-base text-slate-600 dark:text-slate-50">
                                    Terhubung dengan akun google
                                </a>
                                <iconify-icon
                                    icon="mdi:check-decagram"
                                    class="text-blue-500 text-lg"
                                    style="vertical-align: middle; color:blue"
                                    title="Email terverifikasi"
                                ></iconify-icon>
                            @endif
                            </div>
                        </li>
                        <li class="flex space-x-3 rtl:space-x-reverse">
                            <div class="flex-none text-2xl text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5" fill="#4285F4" viewBox="0 0 24 24">
                                <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/>
                            </svg>
                            </div>
                            <div class="flex-1">
                            <div class="uppercase text-xs text-slate-500 dark:text-slate-300 mb-1 leading-[12px]">
                                FACEBOOK
                            </div>
                            @if (!Auth::user()->facebook_id)
                                <a href="{{ route('connect.facebook') }}" class="text-base text-slate-600 dark:text-slate-50">
                                    Hubungkan dengan akun facebook
                                </a>
                            @else
                                <a class="text-base text-slate-600 dark:text-slate-50">
                                    Terhubung dengan akun facebook
                                </a>
                                <iconify-icon
                                    icon="mdi:check-decagram"
                                    class="text-blue-500 text-lg"
                                    style="vertical-align: middle; color:blue"
                                    title="Email terverifikasi"
                                ></iconify-icon>
                            @endif
                            </div>
                        </li>
                    <!-- end single list -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
