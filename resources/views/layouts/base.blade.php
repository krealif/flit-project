<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Flit</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap%22%20rel=stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
  <link rel="manifest" href="/favicon/site.webmanifest">
  <script defer src="/assets/js/alpine-clipboard.min.js"></script>
  <script defer src="/assets/js/alpine.min.js"></script>
  <link rel="stylesheet" href="/assets/css/app.css">
  {{-- @vite('resources/js/app.js') --}}
  @stack('styles')
</head>
<body class="bg-white">
  <main class="max-w-lg m-auto px-4">
    <header class="py-4 flex justify-between">
      <a href="/">
        <span class="text-2xl font-extrabold whitespace-nowrap text-gray-900">Flit</span>
      </a>
      <nav>
        <ul class="flex items-center h-full gap-2">
          <li>
            <a class="text-cyan-600 font-medium hover:text-cyan-800" href="/privacy">Privacy</a>
          </li>
          <li>
            <a class="text-cyan-600 font-medium hover:text-cyan-800" href="/about">About</a>
          </li>
        </ul>
      </nav>
    </header>
    @yield('content')
  </main>
  @stack('scripts')
</body>
</html>