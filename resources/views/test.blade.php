@extends('layout.dashboard')
@section('title', 'Manajemen Pengguna')
@section('content')
    <div class="flex flex-row justify-between pb-3">
        <div class="justify-start">
            <p class="text-xl font-bold text-jet whitespace-nowrap">Target Penilaian</p>
        </div>

    </div>
    <div id="accordion-flush" data-accordion="collapse" data-active-classes="text-caribbean font-semibold" data-inactive-classes="text-gray-500 dark:text-gray-400">
        @foreach ($questions as $criteria => $questionsGroup)
        <h2 id="heading{{ $loop->iteration }}">
            <button type="button" class="flex justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-300 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                <span>{{ $criteria }}</span>
                <div class="flex items-center gap-3 md:w-1/4">
                    <div class="hidden md:block w-full bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 45%;">
                            {{ $questionCounts[$criteria] }}
                        </div>
                    </div>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </div>
            </button>
        </h2>

            <div id="collapse{{ $loop->iteration }}" class="hidden" aria-labelledby="heading{{ $loop->iteration }}">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <ul>
                        @foreach ($questionsGroup as $question)
                            <div class="p-6 m-2 my-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <span class="bg-gray-100 text-caribbean text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mb-4 border border-caribbean ">{{ $question['code'] }}</span>
                                <span class="bg-gray-100 text-teal text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mb-4 border border-teal ">{{ $question['subCriteria'] }}</span>
                                {{--  <p>{{ $question['weight'] }}</p>  --}}
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
                                                                <label for="{{ $subkey }}" class="text-sm text-gray-600 mb-2">{{ $subquestion }}</label>
                                                                <input type="text" id="{{ $subkey }}" name="{{ $subkey }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg text-xs focus:ring-caribbean focus:border-caribbean">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    </div>
                                                </div>
                                            @elseif ($key !== 'main')
                                                <div class="mb-4">
                                                    <label for="{{ $key }}" class="text-sm mb-2">{{ $inputQuestion }}</label>
                                                    <input type="text" id="{{ $key }}" name="{{ $key }}" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg focus:ring-caribbean focus:border-caribbean">
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
                                                        <input type="radio" id="{{ $question['code'] . $key }}" name="{{ $question['code'] }}" value="{{ $key }}" class="hidden peer" required />
                                                        <label for="{{ $question['code'] . $key }}"
                                                            class="flex items-center justify-between w-full p-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-white peer-checked:text-white peer-checked:bg-teal hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
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
                </div>
            </div>
        @endforeach
    </div>
@endsection
