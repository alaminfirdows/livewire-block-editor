<div id="home" class="bg-gradient-to-b from-[#1f0434] to-gray-900 pt-48 pb-20 text-white">
    <div class="container">
        <div class="flex flex-wrap items-center">
            <div class="w-full px-4">
                <div class="mx-auto max-w-5xl text-center">
                    <h1 class="font-bold leading-tight text-6xl mb-10">
                        <span>{{ $data['heading_1'] }}</span>
                        <div>
                            <span>Ultimate AI</span>
                            <span id="typewriter"
                                class="bg-gradient-to-br from-amber-400 to-fuchsia-600 text-transparent bg-clip-text"
                                data-words="{{ $data['words'] }}"></span>
                        </div>
                    </h1>

                    <p class="mx-auto mb-10 max-w-[500px] text-lg">
                        {{ $data['description'] }}
                    </p>
                    <a
                        class="inline-block text-white rounded-xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 px-6 py-4 text-center text-base font-medium transition duration-300 ease-in-out hover:text-gray-90">
                        SignUp Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ----- Typewriter Start -----
        let i = 0, j = 0, isDeleting = false;
        const words = document.getElementById('typewriter').dataset.words.split(',');

        function type() {
            const currentWord = words[i];
            const newText = isDeleting
                ? currentWord.substring(0, j - 1)
                : currentWord.substring(0, j + 1);

            document.getElementById('typewriter').textContent = newText;
            j += isDeleting ? -1 : 1;

            if ((isDeleting && j === 0) || (!isDeleting && j === currentWord.length)) {
                isDeleting = !isDeleting;
                i = isDeleting ? (i + 1) % words.length : i;
                setTimeout(type, isDeleting ? 1500 : 75);
            } else {
                setTimeout(type, 75);
            }
        }

        type();
    </script>
</div>
