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
                            <a href="mailto:someone@example.com" class="text-base text-slate-600 dark:text-slate-50">
                                {{ Auth::user()->email }}
                            </a>
                            </div>
                        </li>
                        @if (! Auth::user()->hasVerifiedEmail())
                            <div class="alert alert-warning">
                                <a href="{{ route('verification.notice') }}">Verifikasi Email</a>
                            </div>
                        @endif
                        <!-- end single list -->
                    <!-- end single list -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
