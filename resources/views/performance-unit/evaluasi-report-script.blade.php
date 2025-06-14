<script>
    $(document).ready(function () {
        // Inisialisasi DataTable
        var table = $('#user').DataTable({
            processing: false,
            serverSide: false,
            responsive: true,
            language: {
                search: 'Cari: ',
                lengthMenu: "_MENU_ entri per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                infoFiltered: "(difilter dari total _MAX_ entri)",
            },
            dom: '<"flex justify-between items-center"<"flex items-center justify-start"l><"flex items-center justify-end"f>>' +
                '<"mt-4"t>' +
                '<"flex justify-between items-center"<"flex items-center justify-start mt-4"i><"flex items-center justify-end mt-4"p>>',
        });

        // Redirect URL berdasarkan unit
        const unitDropdown = document.getElementById('unit_id');
        unitDropdown.addEventListener('change', function () {
            const selectedUnitId = this.value;
            const currentUrl = new URL(window.location.href);
            if (selectedUnitId) {
                currentUrl.searchParams.set('unit_id', selectedUnitId);
            } else {
                currentUrl.searchParams.delete('unit_id');
            }
            window.location.href = currentUrl.toString();
        });

        // Redirect URL berdasarkan tahun
        const yearDropdown = document.getElementById('year');
        if (yearDropdown) {
            yearDropdown.addEventListener('change', function () {
                const selectedYear = this.value;
                const currentUrl = new URL(window.location.href);
                if (selectedYear) {
                    currentUrl.searchParams.set('year', selectedYear);
                } else {
                    currentUrl.searchParams.delete('year');
                }
                window.location.href = currentUrl.toString();
            });
        }

        // (Opsional) Bootstrap popover (hapus jika tidak digunakan)
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });
</script>
