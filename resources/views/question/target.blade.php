@extends('layout.dashboard')
@section('title', 'Manajemen Pengguna')
@section('content')
    <div class="flex flex-row justify-between pb-3">
        <div class="justify-start">
            <p class="text-xl font-bold text-jet whitespace-nowrap">Target</p>
        </div>
    </div>
    <form method="POST" action="{{ route('target.save') }}">
        @csrf
        <ul>
            <div class="px-6 py-3 m-2 my-4 bg-white border border-gray-200 rounded-lg shadow">
                <select id="navigateIndex" class="w-full border-0 focus:ring-0 font-bold">
                    @foreach($criteriaKeys as $index => $criteria)
                        <option value="{{ $index }}" {{ $currentIndex == $index ? 'selected' : '' }}>
                            {{ $criteria }}
                        </option>
                    @endforeach
                </select>
            </div>
            @foreach ($questions as $question)
                <div class="p-6 m-2 my-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <span class="bg-gray-100 text-caribbean text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mb-4 border border-caribbean ">{{ $question['code'] }}</span>
                    <span class="bg-gray-100 text-teal text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mb-4 border border-teal ">{{ $question['subCriteria'] }}</span>
                    @if (isset($question['type']) && $question['type'] === 'input')
                        <div>
                            <p class="mb-2.5 whitespace-pre-wrap dark:text-gray-400">{{ $question['question']['main'] }}</p>
                            @foreach ($question['question'] as $key => $inputQuestion)
                                @if (is_array($inputQuestion))
                                    <div class="text-sm mb-2">
                                        <p>{{ $inputQuestion['sub_main'] }}</p>
                                        <div class="grid grid-cols-4 gap-4">
                                            @foreach ($inputQuestion as $subkey => $subquestion)
                                                @if ($subkey !== 'sub_main')
                                                    <div class="mb-3">
                                                        <label for="{{ $question['code'] . $subkey }}" class="text-sm text-gray-600 mb-2">{{ $subquestion }}</label>
                                                        <input type="text" id="{{ $question['code'] . $subkey }}" name="answers[{{ $question['code'] }}][{{ $subkey }}]" value="{{ old('answers.' . $question['code'] . '.' . $subkey, $answers[$question['code'] . '-' . $subkey]->target_answer ?? '') }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg text-xs focus:ring-caribbean focus:border-caribbean">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif ($key !== 'main')
                                    <div class="mb-4">
                                        <label for="{{ $question['code'] . $key }}" class="text-sm mb-2">{{ $inputQuestion }}</label>
                                        <input type="text" id="{{ $question['code'] . $key }}" name="answers[{{ $question['code'] }}][{{ $key }}]" value="{{ old('answers.' . $question['code'] . '.' . $key, $answers[$question['code'] . '-' . $key]->target_answer ?? '') }}" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg focus:ring-caribbean focus:border-caribbean">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div>
                            <li>
                                <p class="mb-6 leading-relaxed dark:text-gray-400 whitespace-pre-wrap">{{ $question['question'] }}</p>
                                <ul>
                                    @foreach ($question['choices'] as $key => $choice)
                                        <li class="mb-2">
                                            <input type="radio" id="{{ $question['code'] . $key }}" name="answers[{{ $question['code'] }}]" value="{{ $key }}" class="hidden peer" {{ old('answers.' . $question['code'], $answers[$question['code']]->target_answer ?? '') == $key ? 'checked' : '' }} />
                                            <label for="{{ $question['code'] . $key }}"
                                                class="flex items-center gap-6 justify-between w-full p-2 text-sm text-gray-700 border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-white peer-checked:text-white peer-checked:bg-teal hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">
                                                    <div class="w-full whitespace-pre-wrap">{{ $choice }}</div>
                                                </div>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </div>
                    @endif
                </div>
            @endforeach
        </ul>
        <div class="m-2 my-4 flex justify-between">
            @if ($currentIndex > 0)
                <a href="{{ route('target.index', ['index' => $currentIndex - 1]) }}" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-gray-500 rounded-lg hover:bg-gray-500">Sebelumnya</a>
            @endif
            @if ($currentIndex < count($criteriaKeys) - 1)
                <button type="submit" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-teal rounded-lg hover:bg-teal">Selanjutnya</button>
            @endif
            @if ($currentIndex == count($criteriaKeys) - 1)
                <button type="submit" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-teal rounded-lg hover:bg-teal">Simpan</button>
            @endif
        </div>
        <input type="hidden" name="currentIndex" value="{{ $currentIndex }}">
    </form>

    @include('question.question-script')
@endsection

