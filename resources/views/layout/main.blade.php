<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'SPK Pemilihan Mobil')</title>
    @vite('resources/css/app.css')
    @stack('head')
</head>

<body>
    <!-- Header -->
    <section>
        <div class="w-full bg-red-500">
            <div class="flex justify-between p-5 container mx-auto">
                <div class="text-slate-200 font-bold sm:text-4xl">
                    <a href="/">SPK Pemilihan Mobil</a>
                </div>
                <div class="flex text-slate-200 font-semibold">
                    @auth()
                        <a href="/dashboard" class="self-center mr-2">{{ auth()->user()->name }} |</a>
                        <form action="/logout" class="flex item-center" method="post">
                            @csrf
                            <button type="submit" class="self-center">Keluar</button>
                        </form>
                    @else
                        <a href="/login" class="self-center">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
    <!-- Content -->
    <section>
        @yield('content')
    </section>
</body>

</html>
