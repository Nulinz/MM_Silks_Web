<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Carousel -->
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Lazy Loading -->
<script src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<!-- Script -->
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- Tooltip -->
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map((tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl));
</script>

<!-- File Input Filename -->
<script>
    function updateFileName(inputId, textId) {
        const fileInput = document.getElementById(inputId);
        const fileText = document.getElementById(textId);
        fileText.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : "Click to upload image";
    }
</script>

<!-- File Input Filename -->
<script>
    function updateFileName(inputId, textId) {
        const fileInput = document.getElementById(inputId);
        const fileText = document.getElementById(textId);
        fileText.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : "Click to upload image";
    }
</script>

<!-- Dark Theme Logo and Theme Switching -->
<script>
    const themeSwitch = document.querySelector('#themeSwitcher');
    const lightLogo = document.querySelector('.lightLogo');
    const darkLogo = document.querySelector('.darkLogo');
    const defaultTheme = localStorage.getItem('theme') || 'theme-light';
    setTheme(defaultTheme);
    // themeSwitch.checked = defaultTheme === 'theme-dark';
    // themeSwitch.addEventListener('change', () => {
    //     const selectedTheme = themeSwitch.checked ? 'theme-dark' : 'theme-light';
    //     setTheme(selectedTheme);
    // });
    // function setTheme(theme) {
    //     document.documentElement.className = theme;
    //     localStorage.setItem('theme', theme);
    // }
    function setTheme(theme) {
        document.documentElement.className = theme;
        localStorage.setItem('theme', theme);

        if (theme === 'theme-dark') {
            lightLogo.style.display = 'none';
            darkLogo.style.display = 'block';
        } else {
            lightLogo.style.display = 'block';
            darkLogo.style.display = 'none';
        }
    }
</script>

</body>

</html>