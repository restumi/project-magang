<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title>Dashcode - HTML Template</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/favicon.svg') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/rt-plugins.css') }}">
  <link href="https://unpkg.com/aos@2.3.0/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="">
  <link rel="stylesheet" href="{{ asset("assets/css/app.css")}}">
  <!-- START : Theme Config js-->
  <script src="{{ asset('assets/js/settings.js')}}" sync></script>
  <!-- END : Theme Config js-->
</head>

<body class=" font-inter skin-default">
  <!-- [if IE]> <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. Please
            <a href="https://browsehappy.com/">upgrade your browser</a> to improve
            your experience and security.
        </p> <![endif] -->

  <div class="min-h-screen">
    <div class="xl:absolute left-0 top-0 w-full">
      <div class="flex flex-wrap justify-between items-center py-6 container">
        <div>
          <a href="index.hhtml">
            <img src="{{ asset('assets/images/logo/logo.svg')}}" alt="" class="mb-10 dark_logo">
            <img src="{{ asset('assets/images/logo/logo-white.svg')}}" alt="" class="mb-10 white_logo">
          </a>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="flex justify-between flex-wrap items-center min-h-screen">
        <div class="max-w-[500px] space-y-4">
          <div class="relative flex space-x-3 items-center text-2xl text-slate-900 dark:text-white">
            <span class="inline-block w-[25px] bg-secondary-500 h-[1px]"></span>
            <span>Verify email</span>
          </div>
          <div class="xl:text-[70px] xl:leading-[70px] text-4xl font-semibold text-slate-900 dark:text-white">
            Go check your notification!
          </div>
          <p class="font-normal text-slate-600 dark:text-slate-300 max-w-[400px]">
            We have sent email verification, go check ur email for verify!
          </p>
          <div class="text-sm text-slate-500 dark:text-slate-400">
            *Don’t worry we will not spam you :)
          </div>
        </div>
        <div>
          <img src="{{ asset('assets/images/svg/img-1.svg')}}" alt="">
        </div>
      </div>
    </div>
    <div class="xl:fixed bottom-0 w-full">
      <div class="container">
        <div class="md:flex justify-between items-center flex-wrap space-y-4 py-6">
          <div>
            <ul class="flex md:justify-start justify-center space-x-3">
              <li>
                <a href="#" class="social-link">
                  <iconify-icon icon="icomoon-free:facebook"></iconify-icon>
                </a>
              </li>
              <li>
                <a href="#" class="social-link">
                  <iconify-icon icon="icomoon-free:twitter"></iconify-icon>
                </a>
              </li>
              <li>
                <a href="#" class="social-link">
                  <iconify-icon icon="icomoon-free:linkedin2"></iconify-icon>
                </a>
              </li>
              <li>
                <a href="#" class="social-link">
                  <iconify-icon icon="icomoon-free:google"></iconify-icon>
                </a>
              </li>
            </ul>
          </div>
          <div>
            <ul class="flex md:justify-start justify-center space-x-3">
              <li>
                <a href="#" class="text-slate-500 dark:text-slate-400 text-sm transition duration-150 hover:text-slate-900">Privacy
                  policy</a>
              </li>
              <li>
                <a href="#" class="text-slate-500 dark:text-slate-400 text-sm transition duration-150 hover:text-slate-900">Faq</a>
              </li>
              <li>
                <a href="#" class="text-slate-500 dark:text-slate-400 text-sm transition duration-150 hover:text-slate-900">Email us</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- scripts -->
  <script src="{{ asset('assets/js/jquery-3.6.0.min.js')}}"></script>
  <script src="{{ asset('assets/js/rt-plugins.js')}}"></script>
  <script src="{{ asset('assets/js/app.js')}}"></script>
</body>
</html>
