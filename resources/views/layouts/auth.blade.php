<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
      data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Memori | {{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Save loved ones in Memori" name="description">
    <meta content="Irfan Ullah Khan" name="author">
    <link rel="shortcut icon" href="{{asset('logo-sm.png')}}">
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/tailwind2.css')}}">
</head>
<body
    class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">
{{ $slot }}
<script src='{{asset('assets/libs/choices.js/public/assets/scripts/choices.min.js')}}'></script>
<script src="{{asset('assets/libs/%40popperjs/core/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/libs/tippy.js/tippy-bundle.umd.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/prismjs/prism.js')}}"></script>
<script src="{{asset('assets/libs/lucide/umd/lucide.js')}}"></script>
<script src="{{asset('assets/js/tailwick.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/auth-login.init.js')}}"></script>
</body>
</html>
