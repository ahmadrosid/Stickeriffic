<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stickeriffic</title>

    <!-- Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">

    <section class="relative flex items-center w-full bg-white md:h-screen">
        <div class="relative items-center w-full px-5 py-24 mx-auto lg:px-16 lg:py-36 max-w-7xl md:px-12">
            <div class="relative flex-col items-start m-auto align-middle">
                <div class="grid grid-cols-1 gap-6 lg:gap-24 lg:grid-cols-2">
                    <div class="relative items-center gap-12 m-auto lg:inline-flex">
                        <div class="max-w-xl text-center lg:text-left">
                            <div>
                                <div>
                                    <span class="inline-flex items-center text-3xl font-semibold tracking-tighter text-black"><span class="ml-2">Stickeriffic</span></span>
                                </div>
                                <div class="py-6"></div>
                                <span class="w-auto px-4 py-2 mt-10 rounded-full bg-indigo-500/10">
                                    <span class="text-sm text-indigo-500">Instantly turn any face into a custom sticker!</span>
                                </span>
                                <h1 class="mt-6 text-slate-900 font-extrabold text-4xl sm:text-5xl lg:text-6xl tracking-tight dark:text-white">Express yourself with Stickeriffic!</h1>
                                <p class="max-w-xl mt-4 text-lg tracking-tight lg:text-xl text-slate-500">
                                    <strong>No design skills needed!</strong> Simply upload your photo and watch as Stickeriffic creates a sticker for you.
                                </p>
                            </div>
                            <div class="flex items-center justify-center w-full pt-8 mx-auto lg:justify-start md:pt-6">
                                <a class="bg-indigo-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 focus:ring-offset-slate-50 text-white font-semibold h-12 px-6 rounded-lg w-full flex items-center justify-center sm:w-auto dark:bg-sky-500 dark:highlight-white/20 dark:hover:bg-sky-400" href="/login">Get started</a>
                            </div>
                        </div>
                    </div>
                    <div class="block w-full p-8 mt-12 bg-slate-200 lg:mt-0 rounded-3xl">
                        <img alt="hero" class="object-cover object-center w-full h-full mx-auto lg:ml-auto rounded-2xl" src="https://fly.storage.tigris.dev/sticker-bucket/prediction-1825-sticker.png" />
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>