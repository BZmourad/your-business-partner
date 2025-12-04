<script>
    window.addEventListener('load', function() {
        setTimeout(function() {
            var loadingArea = document.getElementById('loading-area');
            if (loadingArea) {
                loadingArea.style.transition = 'opacity 0.5s ease';
                loadingArea.style.opacity = '0';
                setTimeout(function() {
                    loadingArea.style.display = 'none';
                }, 500); 
            }
        }, 500);
    });
</script>
