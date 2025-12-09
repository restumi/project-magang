<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title>Dashcode - HTML Template</title>
  <link rel="icon" type="image/png" href="assets/images/logo/favicon.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/rt-plugins.css">
  <link href="https://unpkg.com/aos@2.3.0/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="">
  <link rel="stylesheet" href="assets/css/app.css">
  <!-- START : Theme Config js-->
  <script src="assets/js/settings.js" sync></script>
  <!-- END : Theme Config js-->
</head>

<body class=" font-inter skin-default">
  <!-- [if IE]> <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. Please
            <a href="https://browsehappy.com/">upgrade your browser</a> to improve
            your experience and security.
        </p> <![endif] -->

  <div class="loginwrapper">
    <div class="lg-inner-column">
      <div class="left-column relative z-[1]">
        <div class="max-w-[520px] pt-20 ltr:pl-20 rtl:pr-20">
          <a href="index.html">
            <img src="assets/images/logo/logo.svg" alt="" class="mb-10 dark_logo">
            <img src="assets/images/logo/logo-white.svg" alt="" class="mb-10 white_logo">
          </a>
          <h4>
            Unlock your Project
            <span class="text-slate-800 dark:text-slate-400 font-bold">
                            performance
                        </span>
          </h4>
        </div>
        <div class="absolute left-0 2xl:bottom-[-160px] bottom-[-130px] h-full w-full z-[-1]">
          <img src="assets/images/auth/ils1.svg" alt="" class=" h-full w-full object-contain">
        </div>
      </div>
      <div class="right-column  relative">
        <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
          <div class="auth-box h-full flex flex-col justify-center">
            <div class="mobile-logo text-center mb-6 lg:hidden block">
              <a href="index.html">
                <img src="assets/images/logo/logo.svg" alt="" class="mb-10 dark_logo">
                <img src="assets/images/logo/logo-white.svg" alt="" class="mb-10 white_logo">
              </a>
            </div>
            <div class="text-center 2xl:mb-10 mb-4">
              <h4 class="font-medium">Sign in</h4>
              <div class="text-slate-500 text-base">
                Sign in to your account to start using Dashcode
              </div>
            </div>
            <!-- BEGIN: Login Form -->
            <form class="space-y-4" action="{{ route('login') }}" method="POST">
                @csrf
              <div class="fromGroup">
                <label class="block capitalize form-label">email</label>
                <div class="relative ">
                  <input type="email" name="email" class="  form-control py-2" placeholder="jhon@example.com">
                </div>
              </div>
              <div class="fromGroup">
                <label class="block capitalize form-label">passwrod</label>
                <div class="relative "><input type="password" name="password" class="  form-control py-2   " placeholder="password">
                </div>
              </div>
              <div class="flex justify-between">
                <label class="flex items-center cursor-pointer">
                  <input type="checkbox" class="hiddens">
                  <span class="text-slate-500 dark:text-slate-400 text-sm leading-6 capitalize">Keep me signed in</span>
                </label>
                <a class="text-sm text-slate-800 dark:text-slate-400 leading-6 font-medium" href="/forgot-password">Forgot
                  Password?
                </a>
              </div>
              <button class="btn btn-dark block w-full text-center">Log in</button>
            </form>
            <!-- END: Login Form -->
            <div class="relative border-b-[#9AA2AF] border-opacity-[16%] border-b pt-6">
              <div class="absolute inline-block bg-white dark:bg-slate-800 dark:text-slate-400 left-1/2 top-1/2 transform -translate-x-1/2
                                    px-4 min-w-max text-sm text-slate-500 font-normal">
                Or continue with
              </div>
            </div>
            <div class="max-w-[242px] mx-auto mt-8 w-full">

              <!-- BEGIN: Social Log in Area -->
              <ul class="flex items-center justify-center">
                <li class="mr-4">
                  <a href="{{ route('auth.facebook') }}" class="inline-flex h-10 w-10 bg-[#395599] text-white text-2xl flex-col items-center justify-center rounded-full">
                    {{-- facebook --}}
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/>
                    </svg>
                  </a>
                </li>
                <li class="">
                  <a href="{{ route('auth.google') }}" class="inline-flex h-10 w-10 bg-slate-300 text-white text-2xl flex-col items-center justify-center rounded-full">
                    {{-- google --}}
                    <svg class="w-5 h-5" viewBox="0 0 256 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid">
                        <path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 34.944-56.638 34.944-90.43z" fill="#4285F4"/>
                        <path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.754-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1z" fill="#34A853"/>
                        <path d="M56.281 156.37c-2.756-8.123-4.351-17.873-4.351-27.874 0-10.001 1.595-19.751 4.351-27.874l-.244-1.623-40.298-31.188-.527-1.465C8.94 81.06 0 99.853 0 120.486c0 20.632 8.94 39.425 24.138 54.345l40.153-31.187z" fill="#FBBC05"/>
                        <path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 24.138 54.345l40.153 31.187c10.445-31.496 39.746-54.25 74.269-54.25z" fill="#EA4335"/>
                    </svg>
                  </a>
                </li>
              </ul>
              <!-- END: Social Log In Area -->
            </div>
            <div class="md:max-w-[345px] mx-auto font-normal text-slate-500 dark:text-slate-400 mt-12 uppercase text-sm">
              Don’t have an account?
              <a href="{{ route('register') }}" class="text-slate-900 dark:text-white font-medium hover:underline">
                Sign up
              </a>
            </div>
          </div>
          <div class="auth-footer text-center">
            Copyright 2021, Dashcode All Rights Reserved.
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- scripts -->
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/rt-plugins.js"></script>
  <script src="assets/js/app.js"></script>
</body>
</html>
