<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MindMatch Library')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fallback CDN for immediate styling -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-primary: #775a19;
            --color-primary-container: #c5a059;
            --color-background: #fff8f3;
            --color-surface: #ffffff;
            --color-surface-dim: #f5f5dc;
            --color-text-main: #1e1b16;
            --color-text-muted: #4e4639;

            --font-heading: 'Playfair Display', serif;
            --font-body: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#fff8f3] text-[#1e1b16] font-body antialiased min-h-screen flex flex-col selection:bg-[#c5a059] selection:text-white">

    @include('layouts.partials.nav')

    <!-- Main Content -->
    <main class="flex-grow max-w-[1200px] mx-auto w-full px-6 py-12">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Favorites logic using event delegation
            document.body.addEventListener('click', function(e) {
                const btn = e.target.closest('.favorite-btn');
                if (!btn) return;
                
                e.preventDefault();
                e.stopPropagation();
                
                const bookId = btn.dataset.bookId;
                const icon = btn.querySelector('svg');
                
                fetch(`/book/${bookId}/favorite`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        if (data.is_favorite) {
                            icon.setAttribute('fill', 'currentColor');
                            icon.classList.add('text-red-500');
                            icon.classList.replace('text-[#4e4639]', 'text-red-500'); // if using original class
                        } else {
                            icon.setAttribute('fill', 'none');
                            icon.classList.remove('text-red-500');
                            icon.classList.add('text-[#4e4639]'); // reset
                        }
                    } else if (data.message === 'Unauthenticated.') {
                        window.location.href = '/login';
                    }
                })
                .catch(err => {
                    if(err.message.includes('Unauthenticated') || err.status === 401) {
                        window.location.href = '/login';
                    }
                });
            });

            // Progress logic
            const progressForm = document.getElementById('progressForm');
            if (progressForm) {
                progressForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const bookId = this.dataset.bookId;
                    const progressVal = document.getElementById('progressInput').value;
                    
                    fetch(`/book/${bookId}/progress`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ progress: progressVal })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert('Reading progress saved: ' + data.progress + '%');
                        }
                    })
                    .catch(err => {
                        if(err.message.includes('Unauthenticated') || err.status === 401) {
                            window.location.href = '/login';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
