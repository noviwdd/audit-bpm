<script>
    function addChoice() {
        const choiceContainer = document.getElementById('choices');
        const newChoice = `
            <div class="mb-2 flex items-center">
                <input type="text" name="choices[new][value]" class="flex w-1/5 p-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Value">
                <input type="text" name="choices[new][description]" class="flex-1 w-3/4 p-3 border border-gray-300 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi">
                <button type="button" class="ml-2 text-[#D32F2F]" onclick="removeChoice(this)">Hapus</button>
            </div>
        `;
        choiceContainer.insertAdjacentHTML('beforeend', newChoice);
    }

    function removeChoice(button) {
        button.parentElement.remove();
    }

    function addInput() {
        const inputContainer = document.getElementById('inputs');
        const newInput = `
            <div class="mb-2 flex items-center">
                <input type="text" name="inputs[new][label]" class="flex w-1/5 p-3 border h-12 text-sm border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Label">
                <textarea name="inputs[new][input_question]" rows="2" class="flex-1 w-3/4 p-3 h-12 text-sm border border-gray-300 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Pertanyaan Input"></textarea>
                <button type="button" class="ml-2 text-red-500" onclick="removeInput(this)">Hapus</button>
            </div>
        `;
        inputContainer.insertAdjacentHTML('beforeend', newInput);
    }

    function removeInput(button) {
        button.parentElement.remove();
    }
</script>
