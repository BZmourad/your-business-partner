<script>
    document.addEventListener('DOMContentLoaded', function() {
        var scrollTopButton = document.getElementById('scroll-to-top');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 40) {
                scrollTopButton.style.display = 'block';
                scrollTopButton.style.opacity = '1';
                scrollTopButton.style.transition = 'opacity 0.5s';
            } else {
                scrollTopButton.style.opacity = '0';
                scrollTopButton.style.transition = 'opacity 0.5s';
                setTimeout(function() {
                    if (window.scrollY <= 40) {
                        scrollTopButton.style.display = 'none';
                    }
                }, 500); // attendre la transition avant de cacher
            }
        });

        scrollTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
