<script>
    $(document).ready(function() {
        var table = $('#management-unit').DataTable({
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
        })
    })

    function openModal(action, id = null, name = null) {
        const modalTitle = document.getElementById('modal-title');
        const unitForm = document.getElementById('unit-form');
        const nameInput = document.getElementById('name');

        if (action === 'add') {
            modalTitle.textContent = 'Tambah Data Unit';
            unitForm.action = "{{ route('management-unit.store') }}";
            nameInput.value = '';
        } else if (action === 'edit') {
            modalTitle.textContent = 'Edit Data Unit';
            unitForm.action = `{{ route('management-unit.store') }}/${id}`;
            nameInput.value = name;
        }

        document.querySelectorAll('[data-modal-hide="unit-modal"]').forEach(element => {
            element.addEventListener('click', () => {
                document.getElementById('unit-modal').classList.add('hidden');
            });
        });

        document.getElementById('unit-modal').classList.remove('hidden');
    }

</script>
