@if(session('message'))
    <div id="flash-message" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-{{ session('type', 'blue') }}-500 text-white px-6 py-3 rounded shadow-lg flex items-center justify-between w-96 z-10">
        <span>{{ session('message') }}</span>
        <button onclick="document.getElementById('flash-message').style.display='none'" class="ml-4 text-lg font-bold hover:cursor-pointer">×</button>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                const flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.display = 'none';  // Hide the message after 5 seconds
                }
            }, 5000); // Auto-hide after 5 seconds
        });
    </script>
@endif