<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang, Customer Service</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-200 w-full h-screen flex items-center justify-center">
    <div class="flex w-3/4 h-[500px] bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Left Column with Background Image -->
        <div class="w-[45%] bg-cover bg-center flex flex-col items-center justify-center py-8 relative rounded-lg"
            style="background-image: url('{{ asset('images/background-vodeco.webp') }}');">
            <svg width="50" viewBox="0 0 43 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute top-8 left-8">
                <path d="M41.0612 0.299086C41.3107 0.302453 41.5548 0.373117 41.7672 0.504164C41.9796 0.635216 42.1523 0.821724 42.2672 1.04323C42.3821 1.26485 42.4348 1.51378 42.4196 1.76295C42.4043 2.01221 42.3225 2.25325 42.1813 2.45924L32.2506 17.0188L24.9713 27.6487L22.5709 31.0393C22.3839 31.3016 22.1366 31.5151 21.8502 31.6624C21.5637 31.8097 21.2459 31.8859 20.9244 31.885C20.6028 31.884 20.2858 31.8056 20.0016 31.6565C19.7176 31.5074 19.4735 31.2921 19.2907 31.0286L14.4108 23.9788C14.2982 23.8131 14.2368 23.6176 14.235 23.4182C14.2333 23.2189 14.2914 23.024 14.401 22.8587L22.6412 10.6184L29.941 0.188735L41.0612 0.299086ZM1.16077 0.209243C4.50077 -0.250757 9.63132 -0.0806792 12.4713 2.03932C18.1608 6.29939 17.5305 13.9689 12.7106 18.7688C12.5677 18.911 12.395 19.0196 12.2047 19.0862C12.0144 19.1528 11.8114 19.1756 11.611 19.1536C11.4107 19.1315 11.2177 19.0655 11.0465 18.9592C10.8753 18.8528 10.7293 18.7092 10.6207 18.5393C5.20783 10.12 1.81149 4.82643 0.431281 2.65944C0.197947 2.29944 0.0580254 1.96203 0.0113588 1.6487C-0.0114076 1.48313 8.0654e-05 1.31464 0.0455384 1.1526C0.0910227 0.990531 0.169227 0.838114 0.276007 0.70436C0.382842 0.570584 0.515794 0.457297 0.667609 0.372328C0.819407 0.287381 0.987232 0.2324 1.16077 0.209243Z" fill="white" />
            </svg>
            <h1 class="font-bold text-left text-6xl text-white drop-shadow-lg px-7">Selamat Datang</h1>
        </div>

        <!-- Right Column with Login Form -->
        <div class="w-[55%] p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-left">Login</h2>
            <p class="text-gray-500 text-[16px]">Selamat Datang di Overview Customer Service <br>Vodeco</p>
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-gray-500 mb-2 text-[16px]">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukan Email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-900">
                </div>
                <div>
                    <div x-data="{show: false }" class="relative">
                        <label class="block text-gray-500 mb-2 text-[16px]">Password</label>
                        <input :type="show ? 'text' : 'password'" name="password" placeholder="Masukkan Password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-navy-500">
                        <div @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer top-7">
                            <template x-if="!show">
                                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </template>
                            <template x-if="show">
                                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .847 0 1.673.126 2.468.368M18.438 18.438A9.982 9.982 0 0021.542 12c-1.274-4.057-5.064-7-9.542-7a9.982 9.982 0 00-3.062.562M3.938 3.938l18.125 18.125" />
                                </svg>
                            </template>
                        </div>
                    </div>
                    @error('email')
                    <div class="bg-red-500 bg-opacity-25 rounded-sm p-2 mt-2 w-max">
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" class="text-gray-500 text-[16px]">Ingat Saya</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-blue-600 text-[16px]">Lupa password?</a>
                </div>
                <button type="submit" class="px-4 bg-navy-700 text-white py-2 rounded-lg hover:bg-navy-800 transition duration-200">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>

</html>
