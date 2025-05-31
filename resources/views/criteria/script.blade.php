<script>
    $(document).ready(function() {
        var table = $('#criteria').DataTable({
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
        const criteriaForm = document.getElementById('criteria-form');
        const nameInput = document.getElementById('name');

        if (action === 'add') {
            modalTitle.textContent = 'Tambah Data Kriteria';
            criteriaForm.action = "{{ route('criteria.store') }}";
            nameInput.value = '';
        } else if (action === 'edit') {
            modalTitle.textContent = 'Edit Data Kriteria';
            criteriaForm.action = `{{ route('criteria.store') }}/${id}`;
            nameInput.value = name;
        }

        document.querySelectorAll('[data-modal-hide="criteria-modal"]').forEach(element => {
            element.addEventListener('click', () => {
                document.getElementById('criteria-modal').classList.add('hidden');
            });
        });

        document.getElementById('criteria-modal').classList.remove('hidden');
    }

</script>
