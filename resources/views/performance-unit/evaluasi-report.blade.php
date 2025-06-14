@extends('layout.dashboard')
@section('title', 'Penilaian Unit')
@section('content')
    <div class="flex flex-row justify-between items-center pb-3">
        <p class="text-xl font-bold text-gray-600 whitespace-nowrap">Hasil Evaluasi Kinerja Unit</p>
    </div>


    <div class="grid grid-cols-3 gap-4 mt-4">
        <div class="px-6 py-3 text-gray-600 bg-white rounded-lg shadow border-s-4 border-s-caribbean/75">
            <p class="font-medium mb-2">Terlampaui</p>
            <p class="text-3xl font-bold">{{ $persentaseTerlampaui }}%</p>
        </div>
        <div class="px-6 py-3 text-gray-600 bg-white rounded-lg shadow border-s-4 border-s-amber/75">
            <p class="font-medium mb-2">Tercapai</p>
            <p class="text-3xl font-bold">{{ $persentaseTercapai }}%</p>
        </div>
        <div class="px-6 py-3 text-gray-600 bg-white rounded-lg shadow border-s-4 border-s-[#D32F2F]/75">
            <p class="font-medium mb-2">Tidak Tercapai</p>
            <p class="text-3xl font-bold">{{ $persentaseTidakTercapai }}%</p>
        </div>
    </div>

    <div class="grid grid-cols-6 gap-3 mt-4">
        {{-- Filter Unit --}}
        <select id="unit_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="" disabled {{ request('unit_id') ? '' : 'selected' }}>Pilih Unit</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                    {{ $unit->name }}
                </option>
            @endforeach
        </select>

        {{-- Filter Tahun --}}
        <select id="year"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="" disabled {{ request('year') ? '' : 'selected' }}>Pilih Tahun</option>
            @foreach ($years as $year)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="bg-white p-4 mt-3 rounded-lg shadow overflow-x-auto">
        <table id="user" class="w-screen text-center">
            <thead class="">
                <tr>
                    <th>Kriteria</th>
                    <th>Sub Kriteria</th>
                    <th>Rencana Kerja</th>
                    <th>Target</th>
                    <th>Capaian</th>
                    <th>Sebutan</th>
                    <th>Ketercapaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tableData as $item)
                    <tr data-criteria="{{ $item['criteria_id'] }}" class="hover:bg-gray-50">
                        {{-- <td class="text-center">
                            <p data-popover-target="popover-question-{{ $item['code'] }}">{{ $item['code'] }}</p>
                            <div id="popover-question-{{ $item['code'] }}" data-popover role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0">
                                <div class="px-3 py-2">
                                    <p class="whitespace-pre-wrap">{{ $item['question'] }}</p>
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                        </td> --}}
                        <td><p class="text-left whitespace-pre-wrap">{{ $item['criteria_name'] }}</p></td>
                        <td><p class="text-left whitespace-pre-wrap">{{ $item['sub_criteria_name'] }}</p></td>
                        <td><p class="text-left whitespace-pre-wrap">{{ $item['work_planning'] }}</p></td>
                        <td class="text-center">{{ $item['target_score'] }}</td>
                        <td class="text-center">{{ $item['achieve_score'] }}</td>
                        <td class="text-center">
                            <span class="bg-{{ $item['sebutan_class'] }} p-2 text-white text-sm rounded-lg w-full inline-block">
                                {{ $item['sebutan'] }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="bg-{{ $item['ketercapaian_class'] }} p-2 text-white text-sm rounded-lg w-full inline-block">
                                {{ $item['ketercapaian'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <input type="hidden" name="" class="bg-cerulean">

    </div>
    @include('performance-unit.evaluasi-report-script')
@endsection
