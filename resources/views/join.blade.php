<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hajatan Akhir Tahun - Wedding Celebration</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #F8EAD0 0%, #F5E6C8 50%, #F2E2C0 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><defs><pattern id=%22traditional%22 x=%220%22 y=%220%22 width=%2220%22 height=%2220%22 patternUnits=%22userSpaceOnUse%22><circle cx=%2210%22 cy=%2210%22 r=%222%22 fill=%22%238B7355%22 opacity=%220.1%22/><path d=%22M5,5 Q10,2 15,5 Q18,10 15,15 Q10,18 5,15 Q2,10 5,5%22 fill=%22none%22 stroke=%22%238B7355%22 stroke-width=%220.3%22 opacity=%220.1%22/></pattern></defs><rect width=%22100%22 height=%22100%22 fill=%22url(%23traditional)%22/></svg>');
            background-size: 80px 80px;
            opacity: 0.3;
            z-index: 0;
        }
        
        /* Main Header */
        .main-header {
            background: rgba(248, 234, 208, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(139, 115, 85, 0.2);
            border-bottom: 1px solid #E8D5B7;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .hamburger {
            width: 24px;
            height: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
            padding: 2px 0;
        }
        
        .hamburger span {
            width: 100%;
            height: 2px;
            background: #8B7355;
            border-radius: 1px;
            transition: all 0.3s ease;
        }
        
        .hamburger:hover span {
            background: #C9A876;
        }
        
        .whatsup-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 20px;
            font-weight: 600;
            color: #8B7355;
            font-family: 'Playfair Display', serif;
        }
        
        .whatsup-icon {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #C9A876, #B8956A);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(201, 168, 118, 0.3);
        }
        
        .download-btn {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #C9A876, #B8956A);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(201, 168, 118, 0.3);
            transition: all 0.3s ease;
            border: none;
        }
        
        .download-btn:hover {
            background: linear-gradient(135deg, #B8956A, #A0845C);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(201, 168, 118, 0.4);
        }
        
        .download-btn:active {
            transform: translateY(0);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            min-height: calc(100vh - 80px);
            position: relative;
            z-index: 1;
            margin: 20px;
            border-radius: 20px;
            border: 1px solid rgba(232, 213, 183, 0.5);
            box-shadow: 0 8px 32px rgba(139, 115, 85, 0.1);
        }
        
        .group-avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, #D4B896, #C9A876, #B8956A);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 32px;
            box-shadow: 0 8px 32px rgba(201, 168, 118, 0.3);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 3px solid rgba(255, 255, 255, 0.8);
        }
        
        .group-avatar:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 40px rgba(201, 168, 118, 0.4);
        }
        
        .group-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        
        .group-avatar .fallback {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            line-height: 1.2;
            padding: 20px;
            font-family: 'Playfair Display', serif;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .group-name {
            font-size: 28px;
            font-weight: 700;
            color: #8B7355;
            margin-bottom: 40px;
            text-align: center;
            letter-spacing: -0.5px;
            font-family: 'Playfair Display', serif;
            text-shadow: 0 2px 4px rgba(139, 115, 85, 0.1);
        }
        
        .join-button {
            background: linear-gradient(135deg, #C9A876, #B8956A);
            color: white;
            border: none;
            padding: 16px 48px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(201, 168, 118, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 60px;
            min-width: 200px;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }
        
        .join-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .join-button:hover::before {
            left: 100%;
        }
        
        .join-button:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 6px 20px rgba(201, 168, 118, 0.4);
            background: linear-gradient(135deg, #B8956A, #A0845C);
        }
        
        .join-button:active {
            transform: translateY(0) scale(1);
        }
        
        .join-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        .join-button:disabled::before {
            display: none;
        }
        
        .disclaimer {
            text-align: center;
            max-width: 400px;
        }
        
        .disclaimer-text {
            color: #A0845C;
            font-size: 15px;
            margin-bottom: 8px;
            line-height: 1.4;
        }
        
        .download-link {
            color: #C9A876;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .download-link:hover {
            color: #B8956A;
            text-decoration: underline;
        }
        
        /* Loading Animation */
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
        
        /* Success/Error Messages */
        .message {
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            max-width: 400px;
            width: 100%;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .message.success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(22, 163, 74, 0.1));
            color: #166534;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        
        .message.error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
            color: #991b1b;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .message.warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1));
            color: #92400e;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        /* Welcome Text */
        .welcome-text {
            text-align: center;
            margin-bottom: 20px;
            max-width: 500px;
        }

        .welcome-title {
            font-size: 18px;
            font-weight: 600;
            color: #8B7355;
            margin-bottom: 8px;
            font-family: 'Playfair Display', serif;
        }

        .welcome-subtitle {
            font-size: 14px;
            color: #A0845C;
            line-height: 1.5;
        }

        /* Decorative Elements */
        .decorative-line {
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, #C9A876, #B8956A);
            margin: 20px auto;
            border-radius: 1px;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .main-content {
                padding: 40px 16px;
                margin: 10px;
                border-radius: 15px;
            }
            
            .group-avatar {
                width: 160px;
                height: 160px;
                margin-bottom: 24px;
            }
            
            .group-avatar .fallback {
                font-size: 18px;
                padding: 16px;
            }
            
            .group-name {
                font-size: 24px;
                margin-bottom: 32px;
            }
            
            .join-button {
                padding: 14px 40px;
                font-size: 15px;
                margin-bottom: 48px;
                min-width: 180px;
            }
            
            .main-header {
                padding: 12px 16px;
            }
            
            .whatsup-logo {
                font-size: 18px;
            }
            
            .download-btn {
                width: 36px;
                height: 36px;
            }

            .welcome-title {
                font-size: 16px;
            }

            .welcome-subtitle {
                font-size: 13px;
            }
        }
        
        @media (max-width: 360px) {
            .group-avatar {
                width: 140px;
                height: 140px;
            }
            
            .group-name {
                font-size: 20px;
            }
            
            .join-button {
                padding: 12px 32px;
                font-size: 14px;
                min-width: 160px;
            }
        }
        
        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            
            .join-button::before {
                display: none;
            }
        }
        
        /* High contrast mode */
        @media (prefers-contrast: high) {
            .disclaimer-text {
                color: #5A4A3A;
            }
            
            .group-name {
                color: #5A4A3A;
            }

            .welcome-title {
                color: #5A4A3A;
            }

            .welcome-subtitle {
                color: #6B5B4F;
            }
        }
        
        /* Focus styles for accessibility */
        .join-button:focus,
        .download-btn:focus,
        .download-link:focus {
            outline: 3px solid rgba(201, 168, 118, 0.5);
            outline-offset: 2px;
        }
        
        .hamburger:focus {
            outline: 2px solid #C9A876;
            outline-offset: 2px;
            border-radius: 4px;
        }

        /* Enhanced animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-content > * {
            animation: fadeInUp 0.6s ease-out;
        }

        .main-content > *:nth-child(1) { animation-delay: 0.1s; }
        .main-content > *:nth-child(2) { animation-delay: 0.2s; }
        .main-content > *:nth-child(3) { animation-delay: 0.3s; }
        .main-content > *:nth-child(4) { animation-delay: 0.4s; }
        .main-content > *:nth-child(5) { animation-delay: 0.5s; }
        .main-content > *:nth-child(6) { animation-delay: 0.6s; }

        /* Backdrop blur support */
        @supports (backdrop-filter: blur(10px)) {
            .main-content {
                backdrop-filter: blur(10px);
            }
            
            .main-header {
                backdrop-filter: blur(10px);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(248, 234, 208, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(201, 168, 118, 0.5);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(184, 149, 106, 0.7);
        }
    </style>
</head>
<body>
    <!-- Main Header -->
    <div class="main-header">
        <div class="hamburger" tabindex="0" role="button" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="whatsup-logo">
            <div class=""></div>
            What's Up
        </div>
        <button class="download-btn" aria-label="Download Wedding App">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
            </svg>
        </button>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Success Message -->
        @if(session('success'))
            <div class="message success" role="alert">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="message error" role="alert">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- No Active Event Message -->
        @if(!isset($event))
            <div class="message warning" role="alert">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Tidak ada acara yang aktif saat ini.
            </div>
        @endif

        <div class="decorative-line"></div>

        <!-- Group Avatar -->
        <div class="group-avatar">
            <img src="/storage/events/images/logo.png" 
                 alt="Hajatan Akhir Tahun Logo" 
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="fallback" style="display: none;">
                HAJATAN<br>AKHIR<br>TAHUN
            </div>
        </div>

        <!-- Group Name -->
        <h1 class="group-name">HAJATAN AKHIR TAHUN</h1>

        <!-- Join Button -->
        @if(isset($event))
            <form action="{{ route('join') }}" method="POST" id="joinForm">
                @csrf
                <button type="submit" class="join-button" id="joinButton">
                    <span id="buttonText">🎊 Join Group</span>
                </button>
            </form>
        @endif

        <!-- Disclaimer -->
        <div class="disclaimer">
            <p class="disclaimer-text">Tenang, ini bukan penipuan, guys!</p>
        </div>
    </div>

    <script>
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
            // Focus the join button when page loads if no error messages
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

        // Add sparkle animation
        const style = document.createElement('style');
        style.textContent = `
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
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
