<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hajatan Akhir Tahun - Wedding Celebration</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700;900&display=swap');

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden; /* Mencegah scrolling saat loading */
        }
        body.loaded {
            overflow: auto; /* Mengaktifkan scrolling setelah loading selesai */
        }
        .font-playfair {
            font-family: 'Playfair Display', serif;
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
            background: linear-gradient(135deg, #F8EAD0, #F2E2C0);
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
            to { transform: rotate(360deg); }
        }

        @keyframes sparkle {
            0% { opacity: 0; transform: scale(0) rotate(0deg); }
            50% { opacity: 1; transform: scale(1) rotate(180deg); }
            100% { opacity: 0; transform: scale(0) rotate(360deg); }
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
            <img src="{{ asset('storage/events/images/logo.png') }}" alt="Hajatan Akhir Tahun Logo" class="w-40 h-40 rounded-full shadow-lg">
        </div>
    </div>

    <div id="main-content" class="content-wrapper">
        <div class="bg-[#F8EAD0]/95 backdrop-blur-md px-5 py-4 flex items-center justify-between shadow-sm border-b border-[#E8D5B7] sticky top-0 z-50">
            <div class="flex flex-col justify-between w-6 h-6 cursor-pointer p-[2px] space-y-1 group focus:outline-none focus:ring-2 focus:ring-[#C9A876] focus:ring-offset-2 rounded-md transition-all duration-300" tabindex="0" role="button" aria-label="Menu">
                <span class="w-full h-[2px] bg-[#8B7355] rounded-sm group-hover:bg-[#C9A876] transition-all duration-300"></span>
                <span class="w-full h-[2px] bg-[#8B7355] rounded-sm group-hover:bg-[#C9A876] transition-all duration-300"></span>
                <span class="w-full h-[2px] bg-[#8B7355] rounded-sm group-hover:bg-[#C9A876] transition-all duration-300"></span>
            </div>
            <div class="flex items-center gap-2 text-xl font-semibold text-[#8B7355] font-playfair">
                <div class="w-7 h-7 bg-gradient-to-br from-[#C9A876] to-[#B8956A] rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md"></div>
                What's Up
            </div>
            <button class="w-10 h-10 bg-gradient-to-br from-[#C9A876] to-[#B8956A] rounded-full flex items-center justify-center text-white cursor-pointer shadow-md transition-all duration-300 ease-in-out border-none hover:from-[#B8956A] hover:to-[#A0845C] hover:translate-y-[-1px] hover:shadow-lg focus:outline-none focus:ring-3 focus:ring-[#C9A876] focus:ring-offset-2 active:translate-y-0" aria-label="Download Wedding App">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                </svg>
            </button>
        </div>
    
        <div class="flex flex-col items-center justify-center p-16 bg-white/70 backdrop-blur-md min-h-[calc(100vh-80px)] relative z-10 m-5 rounded-2xl border border-[#E8D5B7]/50 shadow-xl">
            @if(session('success'))
                <div class="message success bg-gradient-to-br from-green-600/10 to-green-800/10 text-green-800 border border-green-600/30 p-3 rounded-xl mb-6 text-sm flex items-center gap-2 max-w-lg w-full backdrop-blur-md" role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
    
            @if(session('error'))
                <div class="message error bg-gradient-to-br from-red-600/10 to-red-800/10 text-red-800 border border-red-600/30 p-3 rounded-xl mb-6 text-sm flex items-center gap-2 max-w-lg w-full backdrop-blur-md" role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
    
            @if(!isset($event))
                <div class="message warning bg-gradient-to-br from-yellow-500/10 to-yellow-600/10 text-yellow-900 border border-yellow-500/30 p-3 rounded-xl mb-6 text-sm flex items-center gap-2 max-w-lg w-full backdrop-blur-md" role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Tidak ada acara yang aktif saat ini.
                </div>
            @endif
    
            <div class="w-16 h-0.5 bg-gradient-to-r from-[#C9A876] to-[#B8956A] mx-auto my-5 rounded-sm"></div>
    
            <div class="group-avatar w-52 h-52 rounded-full bg-gradient-to-br from-[#D4B896] via-[#C9A876] to-[#B8956A] flex items-center justify-center mb-8 shadow-2xl relative overflow-hidden transition-all duration-300 ease-in-out border-4 border-white/80 hover:translate-y-[-4px] hover:scale-105 hover:shadow-[0_12px_40px_rgba(201,168,118,0.4)]">
                <img src="{{ asset('storage/events/images/logo.png') }}" 
                    alt="Hajatan Akhir Tahun Logo"
                    class="w-full h-full object-cover rounded-full"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="fallback text-white text-2xl font-bold text-center leading-snug p-5 font-playfair text-shadow-md hidden">
                    HAJATAN<br>AKHIR<br>TAHUN
                </div>
            </div>
    
            <h1 class="text-3xl font-bold text-[#8B7355] mb-10 text-center tracking-tighter font-playfair text-shadow-sm">HAJATAN AKHIR TAHUN</h1>
    
            @if(isset($event))
                <form action="{{ route('join') }}" method="POST" id="joinForm">
                    @csrf
                    <button type="submit" class="join-button bg-gradient-to-br from-[#C9A876] to-[#B8956A] text-white border-none px-12 py-4 rounded-3xl text-base font-semibold cursor-pointer shadow-lg transition-all duration-300 ease-in-out mb-16 min-w-[200px] relative overflow-hidden focus:outline-none focus:ring-3 focus:ring-[#C9A876] focus:ring-offset-2 hover:from-[#B8956A] hover:to-[#A0845C] hover:translate-y-[-2px] hover:scale-105 hover:shadow-xl active:translate-y-0 active:scale-100" id="joinButton">
                        <span id="buttonText">🎊 Join Group</span>
                    </button>
                </form>
            @endif
    
            <div class="disclaimer text-center max-w-md">
                <p class="text-sm text-[#A0845C] mb-2 leading-relaxed">Tenang, ini bukan penipuan, guys!</p>
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
                Joining...
            `;
            
            // Re-enable button after 5 seconds in case of error
            setTimeout(() => {
                if (button.disabled) {
                    button.disabled = false;
                    buttonText.innerHTML = '🎊 Join Celebration';
                }
            }, 5000);
        });

        // Add interactive effects to hamburger menu
        document.querySelector('.hamburger')?.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });

        // Add click effect to download button
        document.querySelector('.download-btn')?.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });

        // Add keyboard support for hamburger menu
        document.querySelector('.hamburger')?.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
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