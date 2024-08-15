<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const choicesDiv = document.getElementById('choices');
        const inputsDiv = document.getElementById('inputs');

        typeSelect.addEventListener('change', function () {
            if (this.value === 'option') {
                choicesDiv.classList.remove('hidden');
                inputsDiv.classList.add('hidden');
            } else if (this.value === 'input') {
                choicesDiv.classList.add('hidden');
                inputsDiv.classList.remove('hidden');
            } else {
                choicesDiv.classList.add('hidden');
                inputsDiv.classList.add('hidden');
            }
        });
    });

    const subCriteriaData = @json($subCriteria);
    const oldCriteria = "{{ old('criteria', $question->subCriteria->criteria->id ?? '') }}";
    const oldSubCriteria = "{{ old('sub_criteria', $question->subCriteria->id ?? '') }}";

     document.getElementById('criteria').addEventListener('change', function() {
        updateSubCriteria(this.value);
    });

    function updateSubCriteria(selectedCriteria) {
        const subCriteriaDropdown = document.getElementById('sub_criteria');
        subCriteriaDropdown.innerHTML = '<option value="" disabled selected>Pilih Sub Kriteria</option>';

        if (subCriteriaData[selectedCriteria]) {
            subCriteriaData[selectedCriteria].forEach(function(sub) {
                const option = document.createElement('option');
                option.value = sub.id;
                option.textContent = sub.name;
                if (sub.id == oldSubCriteria) {
                    option.selected = true;
                }
                subCriteriaDropdown.appendChild(option);
            });
        }
    }

    if (oldCriteria) {
        updateSubCriteria(oldCriteria);
    }

    let choiceIndex = {{ count(old('choices', $question->choices ?? [])) }};

    function addChoice() {
        choiceIndex++;
        const choiceContainer = document.getElementById('choices');
        const newChoice = `
            <div class="mb-2 flex items-center">
                <input type="text" name="choices[${choiceIndex}][value]" class="flex w-1/5 p-3 text-sm border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Value">
                <input type="text" name="choices[${choiceIndex}][description]" class="flex-1 w-3/4 p-3 text-sm border border-gray-300 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi">
                <button type="button" class="ml-2 px-2 bg-[#D32F2F] text-white rounded-full" onclick="removeChoice(this)">-</button>
            </div>
        `;
        choiceContainer.insertAdjacentHTML('beforeend', newChoice);
    }

    function removeChoice(button) {
        button.parentElement.remove();
    }

    function addInput() {
        choiceIndex++;
        const inputContainer = document.getElementById('inputs');
        const newInput = `
            <div class="mb-2 flex items-center">
                <input type="text" name="inputs[${choiceIndex}][label]" class="flex w-1/5 p-3 text-sm border h-12 text-sm border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Label">
                <textarea name="inputs[${choiceIndex}][input_question]" rows="2" class="flex-1 w-3/4 p-3 h-12 text-sm border border-gray-300 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Pertanyaan Input"></textarea>
                <button type="button" class="ml-2 px-2 bg-[#D32F2F] text-white rounded-full" onclick="removeInput(this)">-</button>
            </div>
        `;
        inputContainer.insertAdjacentHTML('beforeend', newInput);
    }

    function removeInput(button) {
        button.parentElement.remove();
    }
</script>
