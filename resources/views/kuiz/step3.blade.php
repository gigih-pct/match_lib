<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Step 3 - MindMatch Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fffaf6; }
        .font-heading { font-family: 'Playfair Display', serif; }
        .selected-card { border-color: #c5a059 !important; background-color: #fbf2e9 !important; }
    </style>
</head>
<body class="antialiased min-h-screen text-[#1e1b16] pb-24">

    <!-- Header / Progress -->
    <div class="max-w-2xl mx-auto pt-12 px-6">
        <div class="flex flex-col items-center justify-center mb-16">
            <p class="text-xs font-bold text-[#7f7667] tracking-widest uppercase mb-3">Step 3 of 3</p>
            <div class="w-64 h-1 bg-[#e9e1d8] rounded-full overflow-hidden">
                <div class="h-full bg-[#775a19] w-full"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('quiz.step3') }}" id="quizForm">
            @csrf
            <input type="hidden" name="pacing" id="pacingInput" value="">
            <input type="hidden" name="length" id="lengthInput" value="">
            
            <div class="text-center mb-16">
                <h1 class="font-heading text-5xl font-bold mb-4 tracking-tight">How do you prefer to read?</h1>
                <p class="text-[#7f7667] text-lg max-w-lg mx-auto">Help us understand your ideal pacing and book length to finalize your profile.</p>
            </div>

            <!-- Pacing -->
            <div class="mb-10">
                <h3 class="font-heading text-2xl font-bold mb-4">Pacing</h3>
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="pacing-btn p-6 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors text-left" data-value="Fast">
                        <h4 class="font-bold text-lg mb-1">Fast-paced</h4>
                        <p class="text-sm text-[#7f7667]">Plot-driven and quick to the point.</p>
                    </button>
                    <button type="button" class="pacing-btn p-6 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors text-left" data-value="Slow">
                        <h4 class="font-bold text-lg mb-1">Slow-burn</h4>
                        <p class="text-sm text-[#7f7667]">Character-driven with rich details.</p>
                    </button>
                </div>
            </div>

            <!-- Length -->
            <div class="mb-20">
                <h3 class="font-heading text-2xl font-bold mb-4">Book Length</h3>
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="length-btn p-6 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors text-left" data-value="Short">
                        <h4 class="font-bold text-lg mb-1">Short & Concise</h4>
                        <p class="text-sm text-[#7f7667]">Under 300 pages.</p>
                    </button>
                    <button type="button" class="length-btn p-6 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors text-left" data-value="Long">
                        <h4 class="font-bold text-lg mb-1">Epic & In-depth</h4>
                        <p class="text-sm text-[#7f7667]">300+ pages of deep immersion.</p>
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('quiz.step2') }}" class="text-[#7f7667] font-bold hover:text-[#775a19] transition-colors">Back</a>
                <button type="button" onclick="submitForm()" class="bg-[#c5a059] hover:bg-[#b08e4f] text-[#2c251f] font-bold py-4 px-8 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    Complete Setup
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                </button>
            </div>
        </form>
    </div>

    <script>
        const pacingBtns = document.querySelectorAll('.pacing-btn');
        const lengthBtns = document.querySelectorAll('.length-btn');
        const pacingInput = document.getElementById('pacingInput');
        const lengthInput = document.getElementById('lengthInput');

        pacingBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                pacingBtns.forEach(b => b.classList.remove('selected-card'));
                btn.classList.add('selected-card');
                pacingInput.value = btn.dataset.value;
            });
        });

        lengthBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                lengthBtns.forEach(b => b.classList.remove('selected-card'));
                btn.classList.add('selected-card');
                lengthInput.value = btn.dataset.value;
            });
        });

        function submitForm() {
            if(!pacingInput.value || !lengthInput.value) {
                alert('Please select both your pacing and length preferences.');
                return;
            }
            document.getElementById('quizForm').submit();
        }
    </script>
</body>
</html>
