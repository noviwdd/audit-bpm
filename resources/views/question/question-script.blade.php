<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
            const navigateIndex = document.getElementById('navigateIndex');
            navigateIndex.addEventListener('change', function () {
                const selectedIndex = navigateIndex.value;
                const baseUrl = window.location.href.includes('capaian') ? '{{ url('capaian') }}' : '{{ url('target') }}';
                window.location.href = `${baseUrl}?index=${selectedIndex}`;
            });

            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
        });
</script>
