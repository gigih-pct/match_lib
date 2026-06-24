<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Step 2 - MindMatch Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fffaf6; }
        .font-heading { font-family: 'Playfair Display', serif; }
        .selected-genre { border-color: #c5a059 !important; background-color: #fbf2e9 !important; color: #775a19 !important;}
    </style>
</head>
<body class="antialiased min-h-screen text-[#1e1b16] pb-24">

    <!-- Header / Progress -->
    <div class="max-w-2xl mx-auto pt-12 px-6">
        <div class="flex flex-col items-center justify-center mb-16">
            <p class="text-xs font-bold text-[#7f7667] tracking-widest uppercase mb-3">Step 2 of 3</p>
            <div class="w-64 h-1 bg-[#e9e1d8] rounded-full overflow-hidden">
                <div class="h-full bg-[#775a19] w-2/3"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('quiz.step2') }}" id="quizForm">
            @csrf
            
            <div class="text-center mb-16">
                <h1 class="font-heading text-5xl font-bold mb-4 tracking-tight">What domains intrigue you?</h1>
                <p class="text-[#7f7667] text-lg max-w-lg mx-auto">Select the genres or subjects you find most captivating. You can choose multiple.</p>
            </div>

            <div class="flex flex-wrap gap-4 mb-20 justify-center" id="genreContainer">
                @php
                    $genres = ['Philosophy', 'Psychology', 'Fiction', 'Science', 'History', 'Biography', 'Business', 'Self-Help', 'Art', 'Technology'];
                @endphp
                
                @foreach($genres as $genre)
                    <button type="button" class="genre-btn px-6 py-3 rounded-full border border-[#e9e1d8] bg-white text-[#4e4639] font-medium hover:border-[#c5a059] transition-colors" data-value="{{ $genre }}">
                        {{ $genre }}
                    </button>
                @endforeach
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('quiz.step1') }}" class="text-[#7f7667] font-bold hover:text-[#775a19] transition-colors">Back</a>
                <button type="button" onclick="submitForm()" class="bg-[#c5a059] hover:bg-[#b08e4f] text-[#2c251f] font-bold py-4 px-8 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    Next Step
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </div>
        </form>
    </div>

    <script>
        const genreBtns = document.querySelectorAll('.genre-btn');
        const form = document.getElementById('quizForm');
        let selectedGenres = [];

        genreBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const val = btn.dataset.value;
                if(selectedGenres.includes(val)) {
                    selectedGenres = selectedGenres.filter(g => g !== val);
                    btn.classList.remove('selected-genre');
                } else {
                    selectedGenres.push(val);
                    btn.classList.add('selected-genre');
                }
            });
        });

        function submitForm() {
            if(selectedGenres.length === 0) {
                alert('Please select at least one genre.');
                return;
            }
            
            // Create hidden inputs for each selected genre
            selectedGenres.forEach(genre => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'genres[]';
                input.value = genre;
                form.appendChild(input);
            });
            
            form.submit();
        }
    </script>
</body>
</html>
