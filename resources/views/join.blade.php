<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hajatan Akhir Tahun - Wedding Celebration</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Dancing+Script:wght@400;700&display=swap');

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
            /* Mencegah scrolling saat loading */
            background-color: #F8F4E3;
            /* Warna background krem yang lebih gelap */
        }

        body.loaded {
            overflow: auto;
            /* Mengaktifkan scrolling setelah loading selesai */
        }

        .font-playful {
            font-family: 'Dancing Script', cursive;
        }

        /* --- Loading Screen Styles --- */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #A8866B, #95755A);
            z-index: 9999;
            transition: opacity 0.5s ease-in-out, visibility 0s 0.5s;
        }

        #loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        /* Logo Animation: Muncul dari kecil lalu berdenyut */
        @keyframes logo-grow-pulse {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            25% {
                transform: scale(1.1);
                opacity: 1;
            }

            50% {
                transform: scale(1);
            }

            75% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .loading-logo-container {
            animation: logo-grow-pulse 2.5s forwards ease-in-out;
        }

        /* --- Animations for Main Content (retained for button) --- */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes sparkle {
            0% {
                opacity: 0;
                transform: scale(0) rotate(0deg);
            }

            50% {
                opacity: 1;
                transform: scale(1) rotate(180deg);
            }

            100% {
                opacity: 0;
                transform: scale(0) rotate(360deg);
            }
        }

        .content-wrapper {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .content-wrapper.visible {
            opacity: 1;
        }
    </style>
</head>

<body>

    <div id="loading-screen" class="flex flex-col items-center justify-center">
        <div class="loading-logo-container">
            <img src="{{ asset('storage/events/images/logo.png') }}" alt="Hajatan Akhir Tahun Logo"
                class="w-40 h-40 rounded-full shadow-lg">
        </div>
    </div>

    <div id="main-content" class="content-wrapper">
        <div
            class="bg-[#95755A]/95 backdrop-blur-md px-5 py-4 flex items-center justify-center shadow-sm border-b border-[#79614C] sticky top-0 z-50">
            <div class="flex items-center text-xl font-semibold text-white font-playful">
                Hai! Selamat Datang
            </div>
        </div>

        <div class="flex flex-col items-center justify-center p-16 bg-cover bg-center min-h-[calc(100vh-80px)] relative z-10 m-5 rounded-2xl border border-[#79614C]/50 shadow-xl"
            style="background-image: url('{{ asset('storage/events/images/bg-depan.jpeg') }}')">
            @if (session('success'))
                <div class="message success bg-gradient-to-br from-green-600/10 to-green-800/10 text-green-800 border border-green-600/30 p-3 rounded-xl mb-6 text-sm flex items-center gap-2 max-w-lg w-full backdrop-blur-md"
                    role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="message error bg-gradient-to-br from-red-600/10 to-red-800/10 text-red-800 border border-red-600/30 p-3 rounded-xl mb-6 text-sm flex items-center gap-2 max-w-lg w-full backdrop-blur-md"
                    role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if (!isset($event))
                <div class="message warning bg-gradient-to-br from-yellow-500/10 to-yellow-600/10 text-yellow-900 border border-yellow-500/30 p-3 rounded-xl mb-6 text-sm flex items-center gap-2 max-w-lg w-full backdrop-blur-md"
                    role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tidak ada acara yang aktif saat ini.
                </div>
            @endif

            <div class="w-16 h-0.5 bg-gradient-to-r from-[#79614C] to-[#5D4A3C] mx-auto my-5 rounded-sm"></div>

            <div
                class="group-avatar w-52 h-52 rounded-full bg-gradient-to-br from-[#A8866B] via-[#95755A] to-[#79614C] flex items-center justify-center mb-8 shadow-2xl relative overflow-hidden transition-all duration-300 ease-in-out border-4 border-white/80 hover:translate-y-[-4px] hover:scale-105 hover:shadow-[0_12px_40px_rgba(150,117,90,0.4)]">
                <img src="{{ asset('storage/events/images/logo.png') }}" alt="Hajatan Akhir Tahun Logo"
                    class="w-full h-full object-cover rounded-full"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div
                    class="fallback text-[#5D4A3C] text-2xl font-bold text-center leading-snug p-5 font-playful text-shadow-md hidden">
                    HAJATAN<br>AKHIR<br>TAHUN
                </div>
            </div>

            <h1
                class="text-3xl font-bold text-[#5D4A3C] mb-10 text-center tracking-tighter font-playful text-shadow-sm">
                Hajatan Akhir Tahun</h1>

            @if (isset($event))
                <form action="{{ route('join') }}" method="POST" id="joinForm">
                    @csrf
                    <button type="submit"
                        class="join-button bg-gradient-to-br from-[#79614C] to-[#5D4A3C] text-white border-none px-12 py-4 rounded-3xl text-base font-semibold cursor-pointer shadow-lg transition-all duration-300 ease-in-out mb-16 min-w-[200px] relative overflow-hidden focus:outline-none focus:ring-3 focus:ring-[#79614C] focus:ring-offset-2 hover:from-[#5D4A3C] hover:to-[#45372E] hover:translate-y-[-2px] hover:scale-105 hover:shadow-xl active:translate-y-0 active:scale-100"
                        id="joinButton">
                        <span id="buttonText">🎉 Gabung Sekarang</span>
                    </button>
                </form>
            @endif

            <div class="disclaimer text-center max-w-md">
                <p class="text-sm text-[#79614C] mb-2 leading-relaxed">Tenang, ini bukan penipuan kok!</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loadingScreen = document.getElementById('loading-screen');
            const mainContent = document.getElementById('main-content');

            // Tunggu 3 detik (waktu yang cukup untuk animasi logo) sebelum menghilang
            setTimeout(() => {
                loadingScreen.classList.add('hidden');
                mainContent.classList.add('visible');
                document.body.classList.add('loaded'); // Aktifkan scrolling
            }, 3000); // Sesuaikan durasi sesuai kebutuhan
        });

        // Handle form submission with loading state
        document.getElementById('joinForm')?.addEventListener('submit', function(e) {
            const button = document.getElementById('joinButton');
            const buttonText = document.getElementById('buttonText');

            button.disabled = true;
            buttonText.innerHTML = `
                <div class="loading"></div>
                Sedang Bergabung...
            `;

            // Re-enable button after 5 seconds in case of error
            setTimeout(() => {
                if (button.disabled) {
                    button.disabled = false;
                    buttonText.innerHTML = '🎉 Gabung Sekarang';
                }
            }, 5000);
        });

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Add focus management for better accessibility
        document.addEventListener('DOMContentLoaded', function() {
            const hasMessages = document.querySelector('.message');
            const joinButton = document.getElementById('joinButton');

            if (!hasMessages && joinButton) {
                setTimeout(() => {
                    joinButton.focus();
                }, 1000);
            }
        });

        // Add visual feedback for button interactions
        document.querySelectorAll('button, .download-link').forEach(element => {
            element.addEventListener('mousedown', function() {
                this.style.transform = 'scale(0.98)';
            });

            element.addEventListener('mouseup', function() {
                this.style.transform = '';
            });

            element.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        // Add floating animation to decorative elements
        function addFloatingAnimation() {
            const avatar = document.querySelector('.group-avatar');
            if (avatar) {
                setInterval(() => {
                    avatar.style.transform = 'translateY(-2px) scale(1.01)';
                    setTimeout(() => {
                        avatar.style.transform = 'translateY(0) scale(1)';
                    }, 2000);
                }, 4000);
            }
        }

        // Initialize floating animation after page load
        window.addEventListener('load', () => {
            setTimeout(addFloatingAnimation, 2000);
        });

        // Add sparkle effect on button hover
        document.getElementById('joinButton')?.addEventListener('mouseenter', function() {
            // Create sparkle elements
            for (let i = 0; i < 3; i++) {
                setTimeout(() => {
                    const sparkle = document.createElement('div');
                    sparkle.innerHTML = '✨';
                    sparkle.style.position = 'absolute';
                    sparkle.style.fontSize = '12px';
                    sparkle.style.pointerEvents = 'none';
                    sparkle.style.animation = 'sparkle 1s ease-out forwards';
                    sparkle.style.left = Math.random() * 100 + '%';
                    sparkle.style.top = Math.random() * 100 + '%';

                    this.appendChild(sparkle);

                    setTimeout(() => {
                        sparkle.remove();
                    }, 1000);
                }, i * 200);
            }
        });
    </script>
</body>

</html>
