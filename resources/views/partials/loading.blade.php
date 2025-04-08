<!-- Loading Screen -->
<div id="loading-screen"
    class="fixed inset-0 bg-white flex items-center justify-center z-50 transition-opacity duration-300 opacity-100">
    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-green-500 border-opacity-50"></div>
</div>

<script>
    window.addEventListener('beforeunload', () => {
        const loadingScreen = document.getElementById('loading-screen');
        loadingScreen.style.opacity = '1';
        loadingScreen.style.display = 'flex';
    });

    window.addEventListener('load', () => {
        const loadingScreen = document.getElementById('loading-screen');
        setTimeout(() => {
            loadingScreen.style.opacity = '0';
            setTimeout(() => loadingScreen.style.display = 'none', 300);
        }, 200);
    });
</script>
