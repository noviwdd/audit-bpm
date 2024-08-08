<script>
    $(document).ready(function() {
        var table = $('#management-unit').DataTable({
            processing: false,
            serverSide: false,
            searching: false,
            paginate: false,
            info: false,
            columnDefs: [
                {
                    orderable: false,
                    targets: 0
                },
                {
                    orderable: false,
                    targets: 2
                }
            ],
            order: [[1, 'asc']]
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
