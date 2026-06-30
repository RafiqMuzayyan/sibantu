<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'] )
    <link rel="stylesheet" href="{{ asset('css/formItem.css') }}">
</head>
<body class=" w-full flex h-screen  bg-cover bg-center" style="background-image: url('{{ asset('img/register.webp') }}')">
    <x-flash-message />
    <div class="lg:w-[50%] ">      
   </div>

   <div class="w-full lg:w-[50%] flex items-center justify-center p-2">
        <div class="absolute top-0 right-0 flex items-center gap-2 px-5 py-1 ">
            <img src="{{ asset('img/icon.png') }}" alt="login" class="w-13">
            <h1 class="font-bold text-3xl text-black">Si<span class="text-primary">Bantu</span></h1>
        </div>
        <form method="POST" action="{{ route('register.process') }}" class="px-4 lg:px-10 flex flex-col rounded-xl gap-2 lg:gap-4 py-10 mt-8 lg:mt-0 lg:py-17 bg-white/70 backdrop-blur-sm my-shadow w-fit">
            @csrf
            <div class=" mb-6">
                <h1 class=" font-bold text-5xl text-black mb-2">Daftar Akun</h1>
                <p class=" text-sm">Masukkan data diri Anda untuk mendaftar</p>
            </div>
            
            <div class="flex flex-col gap-4 lg:w-100">
                <x-form_item label="Nama Lengkap" name="nama" type="text" />
                <div class="flex gap-2">

                    <x-form_item label="NIK" name="nik" type="number" />
                    <x-form_item label="Email" name="email" type="email" />
                </div>
                <x-form_item label="Password" name="password" type="password" />
            </div>

            <button 
                type="submit"
                class="bg-primary text-white font-semibold py-3 rounded-md hover:bg-primary/90 transition-colors cursor-pointer mt-4"
            >
                DAFTAR
            </button>   
            
             <p class="text-center text-sm text-black font-semibold mt-2">Sudah punya akun  ? <a href="/login" class="text-primary hover:text-primary/90 transition-colors">Masuk Disini</a></p>
            
        </form>
   </div>

</body>
</html>