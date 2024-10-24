<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BAZNAS Kota Bontang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
       
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

       
        .scale-on-hover:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-white font-sans">
    
    <div class="absolute top-4 left-4 sm:left-6 md:left-10 lg:left-20 fade-in">
        <img src="{{ asset('images/logobaznas.png') }}" alt="BAZNAS Logo" class="h-16 sm:h-20 md:h-24 lg:h-28">
    </div>
    
    <div class="min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-7xl flex flex-col md:flex-row gap-8 items-center">
            <div class="text-center md:text-left fade-in md:flex-1 px-4 sm:px-6">
                <h1 class="text-yellow-500 text-2xl sm:text-3xl md:text-4xl font-semibold mb-4">Selamat Datang,</h1>
                <h2 class="text-green-600 text-3xl sm:text-4xl md:text-4xl font-bold leading-snug md:leading-tight">
                    Di Sistem Informasi Geografis<br>
                    Unit Pengumpul Zakat<br>
                    BAZNAS Kota Bontang
                </h2>
                <p class="mt-4 text-gray-600 leading-relaxed text-base sm:text-lg md:text-xl">
                    Untuk Mengetahui Informasi Terupdate<br>
                    Tentang UPZ BAZNAS Kota Bontang
                </p>
                <div class="mt-6 md:mt-6 flex justify-center md:justify-start">
                    <a href="{{ route('login') }}" class="bg-green-600 text-white py-2 px-6 sm:py-3 sm:px-8 rounded-lg hover:bg-green-700 text-base sm:text-lg md:text-xl transition duration-300 ease-in-out transform hover:scale-110 scale-on-hover">
                        Login
                    </a>
                </div>
            </div>

            <!-- Image Content, hidden on small screens -->
            <div class="fade-in hidden md:block md:flex-1 flex justify-center md:justify-end">
                <div class="relative">
                    <img src="{{ asset('images/bg.png') }}" alt="Dashboard Image" class="w-full max-w-xs sm:max-w-sm md:max-w-lg lg:max-w-xl transition duration-300 ease-in-out transform hover:scale-105 scale-on-hover">
                </div>
            </div>

        </div>
    </div>

    <script>
    
        function reveal() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                if (elementTop < window.innerHeight - 100) {
                    el.classList.add('visible');
                }
            });
        }

        
        window.addEventListener('scroll', reveal);
        reveal();
    </script>
</body>
</html>
