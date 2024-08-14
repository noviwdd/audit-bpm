@extends('layout.dashboard')
@section('title', $question ? 'Edit Pertanyaan' : 'Buat Pertanyaan')
@section('content')
    <div class="flex justify-between items-center pb-3">
        <h1 class="text-xl font-bold text-gray-700">{{ $question ? 'Edit Pertanyaan' : 'Buat Pertanyaan' }}</h1>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <form action="{{ $question ? route('questions.store', $question->id) : route('questions.store') }}" method="POST">
            @csrf
            @if($question)
                {{--  @method('PUT')  --}}

                <div class="mb-6 flex flex-row gap-2">
                    <p class="font-bold text-gray-700">Kode Pertanyaan:</p>
                    <p class="font-bold">{{ $question->code }}</p>
                </div>
            @endif

            <div class="mb-6">
                <label for="question" class="block font-medium text-gray-700">Pertanyaan:</label>
                <textarea id="question" name="main_question" rows="10" class="w-full mt-2 p-3 text-sm border border-gray-300 rounded-lg">{{ old('main_question', $question->main_question ?? '') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="type" class="block font-medium text-gray-700">Tipe Pertanyaan:</label>
                <select id="type" name="type" class="w-full mt-2 p-3 text-sm border border-gray-300 rounded-lg">
                    <option value="option" {{ old('type', $question->type ?? '') === 'option' ? 'selected' : '' }}>Pilihan</option>
                    <option value="input" {{ old('type', $question->type ?? '') === 'input' ? 'selected' : '' }}>Input</option>
                </select>
            </div>

            <div id="choices" class="mb-6 {{ old('type', $question->type ?? '') === 'option' ? '' : 'hidden' }}">
                <label class="block font-medium text-gray-700 mb-2">Pilihan:</label>
                @foreach(old('choices', $question->choices ?? []) as $index => $choice)
                    <div class="flex items-center mb-3 w-full">
                        <input type="text" name="choices[{{ $index }}][value]" value="{{ $choice['value'] ?? '' }}"
                            class="flex w-1/5 p-3 text-sm border border-gray-300 rounded-l-lg"
                            placeholder="Value">

                        <input type="text" name="choices[{{ $index }}][description]" value="{{ $choice['description'] ?? '' }}"
                            class="flex-1 w-3/4 p-3 text-sm border border-gray-300 rounded-r-lg"
                            placeholder="Deskripsi">

                        <button type="button" class="ml-2 px-2 bg-[#D32F2F] text-white rounded-full" onclick="removeChoice(this)">-</button>
                    </div>
                @endforeach
                <button type="button" class="text-caribbean hover:text-teal mb-2" onclick="addChoice()">+ Tambah Pilihan</button>
            </div>

            <div id="inputs" class="mb-6 {{ old('type', $question->type ?? '') === 'input' ? '' : 'hidden' }}">
                <label class="block font-medium text-gray-700 mb-2">Input:</label>
                @foreach(old('inputs', $question->inputs ?? []) as $index => $input)
                    <div class="flex items-center mb-3">
                        <input type="text" name="inputs[{{ $index }}][label]" value="{{ $input['label'] ?? '' }}"
                            class="flex w-1/4 p-3 h-12 text-sm border border-gray-300 rounded-l-lg"
                            placeholder="Label">

                        <textarea name="inputs[{{ $index }}][input_question]" rows="2"
                            class="flex-1 w-3/4 h-12 text-sm border border-gray-300 rounded-r-lg"
                            placeholder="Pertanyaan Input">{{ $input['input_question'] ?? '' }}</textarea>

                        <button type="button" class="ml-3 text-red-600 hover:text-red-800" onclick="removeInput(this)">Hapus</button>
                    </div>
                @endforeach
                <button type="button" class="text-caribbean hover:text-teal mb-2" onclick="addInput()">+ Tambah Input</button>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>

    @include('management-question.edit-script')
@endsection
