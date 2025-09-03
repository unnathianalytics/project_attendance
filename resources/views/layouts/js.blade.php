<script src="{{ asset('dist/js/overlayscrollbars.browser.es6.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
{{-- livewire --}}
@livewireScripts
<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper"
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true
    }
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER)
        if (
            sidebarWrapper &&
            OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll
                }
            })
        }
    })
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cssLink = document.querySelector('link[href*="css/adminlte.css"]');
        if (!cssLink) {
            return;
        }
        const cssHref = cssLink.getAttribute('href');
        const deploymentPath = cssHref.slice(0, cssHref.indexOf('css/adminlte.css'));

        document.querySelectorAll('img[src^="/assets/"]').forEach(img => {
            const originalSrc = img.getAttribute('src');
            if (originalSrc) {
                const relativeSrc = originalSrc.slice(1);
                img.src = deploymentPath + relativeSrc;
            }
        });
    });

    document.querySelectorAll('input, textarea').forEach(el => {
        el.addEventListener('focus', function() {
            this.select();
        });
    });
</script>
