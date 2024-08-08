<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full">
    <div id="app" class="h-full">
        <div class="flex w-full gap-2 bg-white">
            <div class="flex flex-col justify-center w-full px-5 lg:w-1/2">
                {{--  <div class="flex justify-center pt-12 lg:justify-start lg:pl-12 lg:-mb-24">
                    <p class="p-4 text-xl font-bold text-whiteSmoke">
                        Audit
                    </p>
                </div>  --}}
                <div class="flex flex-col justify-center px-8 pt-8 my-auto lg:justify-start lg:pt-0 lg:px-24">
                    <p class="text-3xl text-center font-bold text-jet/50">
                        Selamat Datang
                    </p>
                    <form class="flex flex-col pt-3 md:pt-8">
                        <div class="flex flex-col pt-2">
                            <div class="flex relative">
                                <input type="text" class="mt-1 text-sm block w-full rounded-lg bg-neutral-50 border-gray-200 shadow-sm focus:bg-neutral-50 focus:border-teal focus:ring-0" placeholder="Username">
                            </div>
                        </div>
                        <div class="flex flex-col pt-2 mb-6">
                            <div class="flex relative ">
                                <input type="password" class="mt-1 text-sm block w-full rounded-lg bg-neutral-50 border-gray-200 shadow-sm focus:bg-neutral-50 focus:border-teal focus:ring-0" placeholder="Password">
                            </div>
                        </div>
                        <button class="text-white bg-caribbean hover:bg-whiteSmoke hover:text-caribbean rounded-lg p-2" type="submit">
                            Masuk
                        </button>
                    </form>
                </div>
            </div>
            <div class="hidden lg:flex lg:w-1/2 shadow-2xl shadow-gray bg-caribbean h-screen rounded-tl-[4rem] items-center justify-center">
                <img class="hidden object-cover md:block" src="{{ asset('img/login-image.svg') }}" />
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
