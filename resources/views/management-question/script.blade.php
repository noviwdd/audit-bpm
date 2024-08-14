<script>
    $(document).ready(function() {
        var table = $('#question').DataTable({
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

    // Modal Detail
    function openModal(button) {
        // Fetch the data from the button's data attributes
        const question = button.getAttribute('data-question');
        const type = button.getAttribute('data-type');
        const choices = JSON.parse(button.getAttribute('data-choices'));
        const inputs = JSON.parse(button.getAttribute('data-inputs'));


        // Set the modal content
        document.getElementById('modal-question').textContent = question;

        let content = '';
        if (type === 'option' && choices) {
            content += '<ul class="list-inside">';
            choices.forEach(choice => {

                content += `<li>
                    <div class="flex items-center">
                        <input type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 disabled/>
                        <label for="" class="">
                            <p class="whitespace-pre-wrap p-2 text-sm text-gray-400">${choice.description}</p>
                        </label>
                    </div>
                </li>`;
                // content += `<li>${choice.value}: ${choice.description}</li>`;
            });
            content += '</ul>';
        } else if (type === 'input' && inputs) {
            content += '<ul class="list-inside">';
            inputs.forEach(input => {
                console.log(input)
                if (input.label.includes('-sub_main')) {
                    content += `<li>
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 font-semibold">${input.input_question}</p> <!-- Tampilkan teks tanpa inputan -->
                        </div>
                    </li>`;
                } else {
                    content += `<li>
                        <div class="mb-3">
                            <label class="text-sm text-gray-400 mb-2">${input.input_question}</label>
                            <input type="text" class="block w-full p-2 text-gray-400 border border-gray-300 rounded-lg text-xs focus:ring-caribbean focus:border-caribbean" disabled>
                        </div>
                    </li>`;
                }
            });
            content += '</ul>';
        }


        document.getElementById('modal-options-inputs').innerHTML = content;

        // Show the modal
        document.getElementById('question-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('question-modal').classList.add('hidden');
    }
</script>
