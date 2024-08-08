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
        const userForm = document.getElementById('user-form');
        const nameInput = document.getElementById('name');

        if (action === 'add') {
            modalTitle.textContent = 'Tambah Data User';
            userForm.action = "{{ route('management-user.store') }}";
            nameInput.value = '';
        } else if (action === 'edit') {
            modalTitle.textContent = 'Edit Data User';
            userForm.action = `{{ route('management-user.store') }}/${id}`;
            nameInput.value = name;
        }

        document.querySelectorAll('[data-modal-hide="user-modal"]').forEach(element => {
            element.addEventListener('click', () => {
                document.getElementById('user-modal').classList.add('hidden');
            });
        });

        document.getElementById('user-modal').classList.remove('hidden');
    }

</script>
