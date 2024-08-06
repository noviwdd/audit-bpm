@extends('layout.dashboard')
@section('title', 'Manajemen Pengguna')
@section('content')
    <div class="flex flex-row justify-between items-center pb-3">
        <p class="text-xl font-bold text-gray-600 whitespace-nowrap">Penilaian Unit</p>
        <a href="{{ route('formula.generate') }}"
            class="px-4 py-2 text-sm text-center font-medium inline-flex items-center rounded-md bg-teal text-white hover:bg-white hover:text-teal hover:border hover:border-teal">
            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
            </svg>
            <p>Generate Nilai</p>
        </a>

    </div>

    {{--  Alert  --}}
    <div class="flex items-center py-2 px-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-100 max-w-" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <p>Apabila data tidak tampil, silakan tekan tombol <span class="font-bold">Generate Nilai</span> untuk melakukan
                generate.</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4 mt-4">
        <div class="px-6 py-3 text-gray-600 bg-white rounded-lg shadow border-s-4 border-s-caribbean/75">
            <p class="font-medium mb-2">Terlampaui</p>
            <p class="text-3xl font-bold">5.88%</p>
        </div>
        <div class="px-6 py-3 text-gray-600 bg-white rounded-lg shadow border-s-4 border-s-amber/75">
            <p class="font-medium mb-2">Tercapai</p>
            <p class="text-3xl font-bold">84.71%</p>
        </div>
        <div class="px-6 py-3 text-gray-600 bg-white rounded-lg shadow border-s-4 border-s-[#D32F2F]/75">
            <p class="font-medium mb-2">Tidak Tercapai</p>
            <p class="text-3xl font-bold">9.41%</p>
        </div>
    </div>

    <div class="flex flex-row items-center gap-3 pb-3">
        {{--  Dropdown Kriteria  --}}
        <div class="mt-5">
            <button id="kriteria" data-dropdown-toggle="dropdown-criteria"
                class="text-jet bg-white shadow rounded-lg text-sm px-4 py-2 text-center inline-flex items-center"
                type="button">Kriteria
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <div id="dropdown-criteria" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="kriteria">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:text-white">Earnings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:text-white">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>

        {{--  Dropdown Filter  --}}
        <div class="mt-5">
            <button id="kriteria" data-dropdown-toggle="dropdownFilter"
                class="text-jet bg-white shadow rounded-lg text-sm px-4 py-2 text-center inline-flex items-center"
                type="button">Filter
                <svg class="w-4 h-4 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
                </svg>
            </button>

            <div id="dropdownFilter" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="kriteria">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:text-white">Terlampaui</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:text-white">Tercapai</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:text-white">Tidak Tercapai</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
        <table id="example" class="w-full text-center">
            <thead class="">
                <tr>
                    <th>Kode Pertanyaan</th>
                    {{--  <th>Indikator</th>  --}}
                    <th>Target</th>
                    <th>Capaian</th>
                    <th>Sebutan</th>
                    <th>Ketercapaian</th>
                    {{--  <th>Prediksi Capaian Akreditasi</th>  --}}
                </tr>
            </thead>
            <tbody>
                @foreach($questionData as $code => $data)
                <tr>
                    <td class="text-center">{{ $code }}</td>
                    {{--  <td><p class="whitespace-pre-wrap">Konsistensi dengan hasil analisis SWOT dan/atau analisis lain serta rencana pengembangan ke depan. Unit Pengelola Program Studi (UPPS) mampu: \n1. Mengidentifikasi kondisi lingkungan dan industri yang relevan secara komprehensif dan strategis, \n2. Menetapkan posisi relatif program studi terhadap lingkungannya, \n3. Menggunakan hasil identifikasi dan posisi yang ditetapkan untuk melakukan analisis (SWOT/metoda analisis lain yang relevan) untuk pengembangan program studi,  \n4. Merumuskan strategi pengembangan program studi yang berkesesuaian untuk menghasilkan program-program pengembangan alternatif yang tepat.</p></td>  --}}
                    <td class="text-center">
                        {{ $data['targetScore'] !== null ? number_format($data['targetScore'], 2) : null }}
                    </td>
                    <td class="text-center">
                        {{ $data['achieveScore'] !== null ? number_format($data['achieveScore'], 2) : null }}
                    </td>
                    <td class="text-center"><span class="bg-caribbean/75 p-2 text-white text-sm rounded-lg">{{ $data['sebutan'] }}</span></td>
                    <td class="text-center"><span class="bg-blue-800/75 p-2 text-white text-sm rounded-lg">{{ $data['ketercapaian'] }}</span></td>
                    {{--  <td class="text-center">{{ $predAccreditation[$code] }}</td>  --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('results.score-script')
@endsection
