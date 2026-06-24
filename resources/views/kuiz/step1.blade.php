<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Step 1 - MindMatch Library</title>
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
            <p class="text-xs font-bold text-[#7f7667] tracking-widest uppercase mb-3">Step 1 of 3</p>
            <div class="w-64 h-1 bg-[#e9e1d8] rounded-full overflow-hidden">
                <div class="h-full bg-[#775a19] w-1/3"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('quiz.step1') }}" id="quizForm">
            @csrf
            <input type="hidden" name="mood" id="moodInput" value="">
            <input type="hidden" name="goal" id="goalInput" value="">

            <!-- Mood Section -->
            <div class="text-center mb-16">
                <h1 class="font-heading text-5xl font-bold mb-4 tracking-tight">How is your mood today?</h1>
                <p class="text-[#7f7667] text-lg max-w-lg mx-auto">Select the feeling that best describes your current state of mind to help us curate your perfect reading alcove.</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-20">
                <!-- Relaxed -->
                <button type="button" class="mood-btn flex flex-col items-center justify-center p-8 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors gap-4" data-value="Relaxed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#775a19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span class="font-heading font-bold text-xl">Relaxed</span>
                </button>
                <!-- Focused -->
                <button type="button" class="mood-btn flex flex-col items-center justify-center p-8 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors gap-4" data-value="Focused">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#775a19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    <span class="font-heading font-bold text-xl">Focused</span>
                </button>
                <!-- Tired -->
                <button type="button" class="mood-btn flex flex-col items-center justify-center p-8 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors gap-4" data-value="Tired">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#775a19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                    <span class="font-heading font-bold text-xl">Tired</span>
                </button>
                <!-- Inspired -->
                <button type="button" class="mood-btn flex flex-col items-center justify-center p-8 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors gap-4" data-value="Inspired">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#775a19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"/></svg>
                    <span class="font-heading font-bold text-xl">Inspired</span>
                </button>
            </div>

            <!-- Goal Section -->
            <div class="text-center mb-10">
                <h2 class="font-heading text-4xl font-bold tracking-tight">What is your reading goal?</h2>
            </div>

            <div class="space-y-4 mb-16">
                <!-- Goal 1 -->
                <button type="button" class="goal-btn w-full text-left flex items-center justify-between p-6 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors" data-value="Deep Dive Learning">
                    <div>
                        <h3 class="font-heading font-bold text-xl mb-1">Deep Dive Learning</h3>
                        <p class="text-[#7f7667] text-sm">Master a complex new subject over time.</p>
                    </div>
                    <div class="goal-icon text-[#e9e1d8]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </div>
                </button>
                <!-- Goal 2 -->
                <button type="button" class="goal-btn w-full text-left flex items-center justify-between p-6 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors" data-value="Light Escapism">
                    <div>
                        <h3 class="font-heading font-bold text-xl mb-1">Light Escapism</h3>
                        <p class="text-[#7f7667] text-sm">Unwind with an engaging, easy narrative.</p>
                    </div>
                    <div class="goal-icon text-[#e9e1d8]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </div>
                </button>
                <!-- Goal 3 -->
                <button type="button" class="goal-btn w-full text-left flex items-center justify-between p-6 rounded-xl bg-white border border-[#e9e1d8] hover:border-[#c5a059] transition-colors" data-value="Quick Inspiration">
                    <div>
                        <h3 class="font-heading font-bold text-xl mb-1">Quick Inspiration</h3>
                        <p class="text-[#7f7667] text-sm">Short essays or articles to spark creativity.</p>
                    </div>
                    <div class="goal-icon text-[#e9e1d8]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </div>
                </button>
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="submitForm()" class="bg-[#c5a059] hover:bg-[#b08e4f] text-[#2c251f] font-bold py-4 px-8 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    Next Step
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </div>
        </form>
    </div>

    <script>
        const moodBtns = document.querySelectorAll('.mood-btn');
        const goalBtns = document.querySelectorAll('.goal-btn');
        const moodInput = document.getElementById('moodInput');
        const goalInput = document.getElementById('goalInput');

        moodBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                moodBtns.forEach(b => b.classList.remove('selected-card'));
                btn.classList.add('selected-card');
                moodInput.value = btn.dataset.value;
            });
        });

        goalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                goalBtns.forEach(b => {
                    b.classList.remove('selected-card');
                    b.querySelector('.goal-icon').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>';
                    b.querySelector('.goal-icon').classList.replace('text-[#775a19]', 'text-[#e9e1d8]');
                });
                btn.classList.add('selected-card');
                btn.querySelector('.goal-icon').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>';
                btn.querySelector('.goal-icon').classList.replace('text-[#e9e1d8]', 'text-[#775a19]');
                goalInput.value = btn.dataset.value;
            });
        });

        function submitForm() {
            if(!moodInput.value || !goalInput.value) {
                alert('Please select both a mood and a reading goal.');
                return;
            }
            document.getElementById('quizForm').submit();
        }
    </script>
</body>
</html>
