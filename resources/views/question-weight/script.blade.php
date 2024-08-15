<script>
    $(document).ready(function() {
        var table = $('#question-weight').DataTable({
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

    function openModal(action, id = null, weight = null) {
        const modalTitle = document.getElementById('modal-title');
        const questionWeight = document.getElementById('question-weight-form');
        const nameInput = document.getElementById('weight');
        const selectInput = document.querySelector('select[name="question_id"]');

        if (action === 'add') {
            modalTitle.textContent = 'Tambah Data Bobot Pertanyaan';
            questionWeight.action = "{{ route('question-weight.store') }}";
            nameInput.value = '';
            selectInput.value = '';
        } else if (action === 'edit') {
            modalTitle.textContent = 'Edit Data Bobot Pertanyaan';
            questionWeight.action = `{{ route('question-weight.store') }}/${id}`;
            nameInput.value = weight;
        }

        document.querySelectorAll('[data-modal-hide="question-weight-modal"]').forEach(element => {
            element.addEventListener('click', () => {
                document.getElementById('question-weight-modal').classList.add('hidden');
            });
        });

        document.getElementById('question-weight-modal').classList.remove('hidden');
    }

</script>
