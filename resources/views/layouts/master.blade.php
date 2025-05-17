<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/dmlogo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <title>@yield('title')</title>
    <style>
        :root {
            --primary-color: #D4AF37;
            --primary-light: #F8E9A1;
            --primary-dark: #A67C00;
            --accent-color: #D4AF37;
            --text-light: #F8E9A1;
            --text-muted: #A67C00;
            --bg-light: #000000;
            --bg-gray: #111111;
            --shadow-sm: 0 2px 10px rgba(212, 175, 55, 0.15);
            --shadow-md: 0 4px 20px rgba(212, 175, 55, 0.2);
            --shadow-lg: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        body {
            background-color: var(--bg-light);
            background-attachment: fixed;
            color: var(--text-light);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        /* Style pour les messages de succès */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 350px;
            width: 100%;
        }

        .toast-success {
            background-color: rgba(212, 175, 55, 0.1);
            color: var(--primary-light);
            border-left: 4px solid var(--primary-color);
            border-radius: 8px;
            box-shadow: var(--shadow-md);
            padding: 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            animation: slideIn 0.5s ease forwards, fadeOut 0.5s ease 2.5s forwards;
            overflow: hidden;
        }

        .toast-success::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--primary-color);
            animation: countdown 3s linear forwards;
        }

        .toast-icon {
            background-color: var(--primary-color);
            color: black;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .toast-content {
            flex-grow: 1;
        }

        .toast-close {
            background: none;
            border: none;
            color: var(--primary-light);
            cursor: pointer;
            font-size: 16px;
            padding: 0;
            margin-left: 8px;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .toast-close:hover {
            opacity: 1;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(10%);
                opacity: 0;
            }
        }

        @keyframes countdown {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }

        /* Style pour les messages d'erreur */
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-left: 4px solid #dc3545;
            border-radius: 8px;
            box-shadow: var(--shadow-md);
            margin: 16px auto;
            max-width: 800px;
            padding: 16px;
        }

        /* Override Bootstrap styles */
        .btn-primary {
            background: linear-gradient(90deg, var(--primary-dark), var(--primary-color));
            border-color: var(--primary-dark);
            color: black;
        }

        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
            border-color: var(--primary-color);
            color: black;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background-color: var(--primary-color);
            color: black;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-gray);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-dark);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    <main>
        <div class="toast-container" id="toastContainer">
            @if(session('success'))
                <div class="toast-success" id="successToast">
                    <div class="toast-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="toast-content">
                        {{ session('success') }}
                    </div>
                    <button class="toast-close" onclick="closeToast()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <script>
                    function closeToast() {
                        const toast = document.getElementById('successToast');
                        toast.style.animation = 'fadeOut 0.5s ease forwards';
                        setTimeout(() => {
                            toast.remove();
                        }, 500);
                    }

                    setTimeout(() => {
                        const toast = document.getElementById('successToast');
                        if (toast) {
                            toast.style.animation = 'fadeOut 0.5s ease forwards';
                            setTimeout(() => {
                                toast.remove();
                            }, 500);
                        }
                    }, 3000);
                </script>
            @endif
        </div>

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        
        @yield('main')
    </main>
    @include('partials.footer')
</body>
</html>