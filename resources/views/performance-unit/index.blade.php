@extends('layout.dashboard')
@section('title', 'Performance Unit')
@section('content')
<div class="flex flex-row justify-between items-center pb-3">
    <p class="text-base font-semibold text-gray-600 whitespace-nowrap">Evaluasi Kinerja Unit per Tahun</p>
</div>

<div class="bg-white p-4 mt-3 rounded-lg shadow overflow-x-auto min-w-full text-xs">
    <div class="mb-4">
        <form method="GET" action="{{ route('performance-unit.index') }}">
            <table class="text-xs">
                @if (in_array($role_name, ['Auditor', 'Super Admin']))
                <tr>
                    <th class="text-left">Unit</th>
                    <th>:</th>
                    <td class="pl-2 pt-2 align-middle">
                        <select name="unit_id" onchange="this.form.submit()" class="text-xs bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">
                            @foreach ($allUnits as $unitOption)
                                <option value="{{ $unitOption->id }}" {{ $unitOption->id == $unit->id ? 'selected' : '' }}>
                                    {{ $unitOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @else
                <tr>
                    <th class="text-left">Unit</th>
                    <th>:</th>
                    <td class="pl-2 capitalize">{{ $unit->name }}</td>
                </tr>
                @endif

                <tr>
                    <th class="text-left">Tahun</th>
                    <th>:</th>
                    <td class="pl-2 pt-2 align-middle">
                        <select name="year" onchange="this.form.submit()" class="text-xs bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
        </form>
    </div>


    <div class="flex justify-between items-center mb-4">
        @if ($role_name === 'Unit' || $role_name == 'Super Admin')
            <form action="{{ route('performance-unit.import') }}" method="POST" enctype="multipart/form-data" class="inline-block bg-caribbean rounded text-white font-bold p-2">
                @csrf
                <input type="hidden" name="year" value="{{ $selectedYear }}">
                <label for="import_file" class="hover:bg-green-700 text-xs py-2 px-3 rounded cursor-pointer">
                    📥 Import
                </label>
                <input id="import_file" type="file" name="import_file" class="hidden" onchange="this.form.submit()">
            </form>
        @endif
        <a href="{{ asset('storage/template/Template_Import_Evaluasi_Kinerja.xlsx') }}"
            class="inline-block text-xs font-semibold py-2 px-3 rounded mb-2"
            download>
            Download Template Excel
        </a>
    </div>

    <form action="{{ request()->has('edit_id') ? url('performance-unit/' . request()->edit_id . '?year=' . $selectedYear) : url('performance-unit?year=' . $selectedYear) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (request()->has('edit_id'))
            @method('PUT')
        @endif
        <input type="hidden" name="parent" value="{{ request()->parent }}">
        <input type="hidden" name="year" value="{{ $selectedYear }}">
        <input type="hidden" name="unit_id" value="{{ request()->unit_id ?? $unit->id }}">

        <table class="border-collapse border border-slate-500 w-full mt-4 text-xs text-jet">
            <thead>
                <tr>
                    <th colspan="6" class="border border-gray-400 p-2">Ketercapaian Kinerja Unit</th>
                    <th colspan="3" class="border border-gray-400 p-2">Penilaian Auditor</th>
                </tr>
                <tr>
                    <th class="border border-gray-400 p-2">NO</th>
                    <th class="border border-gray-400 p-2">Keterangan</th>
                    <th class="border border-gray-400 p-2">Target</th>
                    <th class="border border-gray-400 p-2">Realisasi</th>
                    <th class="border border-gray-400 p-2">Waktu Pelaksanaan</th>
                    <th class="border border-gray-400 p-2">Dokumen</th>
                    <th class="border border-gray-400 p-2">Evaluasi</th>
                    <th class="border border-gray-400 p-2">Catatan</th>
                    <th class="border border-gray-400 p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    @if (request()->edit_id == $item->id)
                        @php
                            $docPath = asset('storage/' . $item->document);
                            $extension = pathinfo($item->document, PATHINFO_EXTENSION);
                        @endphp
                        <tr>
                            <td class="border border-gray-400 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-400 p-2">
                                @if ($role_name === 'Unit' || $role_name === 'Super Admin')
                                    <input type="text" name="work_planning" class="w-full border border-gray-300 p-1 rounded" value="{{ $item->work_planning }}">
                                @else
                                    {{ $item->work_planning }}
                                @endif
                            </td>

                            <td class="border border-gray-400 p-2">
                                @if ($role_name === 'Unit' || $role_name === 'Super Admin')
                                    <input type="text" name="target" class="w-full border border-gray-300 p-1 rounded" value="{{ $item->target }}">
                                @else
                                    {{ $item->target }}
                                @endif
                            </td>

                            <td class="border border-gray-400 p-2">
                                @if ($role_name === 'Unit' || $role_name === 'Super Admin')
                                    <input type="text" name="achieve" class="w-full border border-gray-300 p-1 rounded" value="{{ $item->achieve }}">
                                @else
                                    {{ $item->achieve }}
                                @endif
                            </td>

                            <td class="border border-gray-400 p-2">
                                @if ($role_name === 'Unit' || $role_name === 'Super Admin')
                                    <input type="date" name="time_target" class="w-full border border-gray-300 p-1 rounded" value="{{ $item->time_target }}">
                                @else
                                    {{ $item->time_target }}
                                @endif
                            </td>

                            <td class="border border-gray-400 p-2">
                                @if ($role_name === 'Unit' || $role_name === 'Super Admin')
                                    <input type="file" name="document" class="block w-full text-xs">
                                @endif

                                @if ($item->document)
                                    <div class="mt-1 space-y-1">
                                        <button type="button" onclick="previewDocument('{{ $docPath }}', '{{ $extension }}')" class="text-blue-500 text-xs underline">Lihat Dokumen</button>
                                    </div>
                                @endif
                            </td>
                            <td class="border border-gray-400 p-2">
                            @if ($role_name === 'Auditor' || $role_name === 'Super Admin')
                                <select id="criteria_id" name="criteria_id" class="text-xs border rounded w-full mb-1">
                                    <option value="">Pilih Kriteria</option>
                                    @foreach ($criteriaList as $criteria)
                                        <option value="{{ $criteria->id }}" {{ $criteria->id == $item->criteria_id ? 'selected' : '' }}>
                                            {{ $criteria->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <select id="sub_criteria_id" name="sub_criteria_id" class="text-xs border rounded w-full mb-1">
                                    <option value="">Pilih Sub Kriteria</option>
                                    @foreach ($subCriteriaList as $sub)
                                        @if ($sub->criteria_id == $item->criteria_id)
                                            <option value="{{ $sub->id }}" {{ $sub->id == $item->sub_criteria_id ? 'selected' : '' }}>
                                                {{ $sub->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                <select name="evaluation_score" class="text-xs border rounded w-full mb-1">
                                    <option value="">Pilih Nilai Penilaian</option>
                                    <option value="4" {{ $item->evaluation_score == 4 ? 'selected' : '' }}>4 - Sangat Baik</option>
                                    <option value="3" {{ $item->evaluation_score == 3 ? 'selected' : '' }}>3 - Baik</option>
                                    <option value="2" {{ $item->evaluation_score == 2 ? 'selected' : '' }}>2 - Cukup</option>
                                    <option value="1" {{ $item->evaluation_score == 1 ? 'selected' : '' }}>1 - Kurang</option>
                                    <option value="0" {{ $item->evaluation_score === 0 ? 'selected' : '' }}>0 - Sangat Kurang</option>
                                </select>

                                <div class="text-xs text-gray-500 mt-1 italic">*Nilai awal dari sistem (auto suggest), boleh diedit</div>
                            @endif
                        </td>
                        <td class="border border-gray-400 p-2">
                            @if ($role_name === 'Auditor' || $role_name === 'Super Admin')
                                <textarea name="note" class="text-xs border rounded w-full" rows="2">{{ $item->note }}</textarea>
                            @endif
                        </td>
                            <td class="border border-gray-400 p-2 text-center">
                                <button type="submit" class="px-2 py-1 bg-caribbean text-white rounded">Simpan</button>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="border border-gray-400 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-400 p-2">{{ $item->work_planning }}</td>
                            <td class="border border-gray-400 p-2 text-center">{{ $item->target }}</td>
                            <td class="border border-gray-400 p-2 text-center">{{ $item->achieve }}</td>
                            <td class="border border-gray-400 p-2 text-center">{{ $item->time_target }}</td>
                            <td class="border border-gray-400 p-2 text-center">
                                @if ($item->document)
                                    @php $docPath = asset('storage/' . $item->document); $extension = pathinfo($item->document, PATHINFO_EXTENSION); @endphp
                                    <button type="button" onclick="previewDocument('{{ $docPath }}', '{{ $extension }}')" class="text-blue-500 text-xs underline">View Document</button>
                                @endif
                            </td>
                            <td class="border border-gray-400 p-2 text-center">
                                @php
                                    $badge = '';
                                    $label = '';
                                    if ($item->evaluation_score === 4) { $badge = 'bg-caribbean text-white'; $label = 'Sangat Baik'; }
                                    elseif ($item->evaluation_score === 3) { $badge = 'bg-emerald-800 text-white'; $label = 'Baik'; }
                                    elseif ($item->evaluation_score === 2) { $badge = 'bg-amber text-white'; $label = 'Cukup'; }
                                    elseif ($item->evaluation_score === 1) { $badge = 'bg-[#FF9800] text-white'; $label = 'Kurang'; }
                                    elseif ($item->evaluation_score === 0) { $badge = 'bg-[#D32F2F] text-white'; $label = 'Sangat Kurang'; }
                                @endphp
                                @if (!is_null($item->evaluation_score))
                                    <div class="mb-4">
                                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $badge }}">
                                            {{ $item->evaluation_score }} - {{ $label }}
                                        </span>
                                        @if ($item->evaluation_auto)
                                            <span class="text-[10px] italic text-gray-400">(auto)</span>
                                        @endif
                                    </div>
                                    <div class="space-y-1 text-[10px] text-gray-600">
                                        <span class="block bg-gray-100 rounded px-1 py-0.5">
                                            <strong>Kriteria:</strong> {{ optional($criteriaList->firstWhere('id', $item->criteria_id))->name ?? '-' }}
                                        </span>
                                        <span class="block bg-gray-100 rounded px-1 py-0.5">
                                            <strong>Sub:</strong> {{ optional($subCriteriaList->firstWhere('id', $item->sub_criteria_id))->name ?? '-' }}
                                        </span>
                                    </div>
                                @else
                                    <span class="italic text-xs text-gray-400">Belum dinilai</span>
                                @endif
                            </td>
                            <td class="border border-gray-400 p-2 text-center">
                                {{ $item->description }}
                            </td>
                            <td class="border border-gray-400 p-2 text-center">
                                @if ($role_name === 'Unit' || $role_name == 'Super Admin' || $role_name == 'Auditor')
                                    <div class="flex gap-1 justify-center">
                                        <a href="?edit_id={{ $item->id }}&year={{ $selectedYear }}&unit_id={{ request('unit_id', $unit->id) }}" class="px-1 bg-yellow-100 text-yellow-700 rounded text-xs">✎</a>
                                        <button type="button" onclick="hapus('{{ $item->id }}')" class="px-1 bg-red-100 text-red-700 rounded text-xs">🗑</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach

                @if (!request()->edit_id)
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">{{ request()->parent }}</td>
                        <td class="border border-gray-400 p-2"><input type="text" name="work_planning" class="w-full border border-gray-300 p-1 rounded"></td>
                        <td class="border border-gray-400 p-2"><input type="text" name="target" class="w-full border border-gray-300 p-1 rounded"></td>
                        <td class="border border-gray-400 p-2"><input type="text" name="achieve" class="w-full border border-gray-300 p-1 rounded"></td>
                        <td class="border border-gray-400 p-2"><input type="date" name="time_target" class="w-full border border-gray-300 p-1 rounded"></td>
                        <td class="border border-gray-400 p-2"><input type="file" name="document" class="block w-full text-xs"></td>
                        <td class="border border-gray-400 p-2">
                            @if ($role_name === 'Auditor' || $role_name === 'Super Admin')
                                <select id="criteria_id" name="criteria_id" class="text-xs border rounded w-full mb-1">
                                    <option value="">Pilih Kriteria</option>
                                    @foreach ($criteriaList as $criteria)
                                        <option value="{{ $criteria->id }}">
                                            {{ $criteria->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <select id="sub_criteria_id" name="sub_criteria_id" class="text-xs border rounded w-full mb-1">
                                    <option value="">Pilih Sub Kriteria</option>
                                    @foreach ($subCriteriaList as $sub)
                                        <option value="{{ $sub->id }}">
                                            {{ $sub->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <select name="evaluation_score" class="text-xs border rounded w-full mb-1">
                                    <option value="">Pilih Nilai Penilaian</option>
                                    <option value="4">4 - Sangat Baik</option>
                                    <option value="3">3 - Baik</option>
                                    <option value="2">2 - Cukup</option>
                                    <option value="1">1 - Kurang</option>
                                    <option value="0">0 - Sangat Kurang</option>
                                </select>

                                <div class="text-xs text-gray-500 mt-1 italic">*Nilai awal dari sistem (auto suggest), boleh diedit</div>
                            @endif
                        </td>
                        <td class="border border-gray-400 p-2">
                            @if ($role_name === 'Auditor' || $role_name === 'Super Admin')
                                <textarea name="note" class="text-xs border rounded w-full" rows="2"></textarea>
                            @endif
                        </td>
                        <td class="border border-gray-400 p-2 text-center">
                            <button type="submit" class="px-2 py-1 bg-caribbean text-white rounded">Simpan</button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </form>

    @foreach ($data as $item)
        <form id="delete-form-{{ $item->id }}" action="{{ route('performance-unit.delete', $item->id) }}?year={{ $selectedYear }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
</div>

<!-- Modal Preview -->
<div id="docModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white w-full max-w-7xl max-h-full h-full rounded-lg overflow-hidden shadow-lg">

        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-sm font-semibold">Preview Dokumen</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-red-600">✕</button>
        </div>
        <div id="docPreview" class="h-full overflow-auto"></div>

    </div>
</div>

<script>
   const subCriteriaList = @json($subCriteriaList);

    const criteriaSelect = document.getElementById('criteria_id');
    const subCriteriaSelect = document.getElementById('sub_criteria_id');

    function populateSubCriteria(criteriaId) {

        subCriteriaSelect.innerHTML = '<option value="">Pilih Sub Kriteria</option>';

        subCriteriaList.forEach(sub => {
            if (sub.criteria_id == criteriaId) {
                const option = document.createElement('option');
                option.value = sub.id;
                option.textContent = sub.name;
                subCriteriaSelect.appendChild(option);
            }
        });
    }

    criteriaSelect.addEventListener('change', function () {
        populateSubCriteria(this.value);
    });

    @if (request()->has('edit_id'))
        populateSubCriteria('{{ old('criteria_id', $item->criteria_id ?? '') }}');
        document.getElementById('sub_criteria_id').value = '{{ old('sub_criteria_id', $item->sub_criteria_id ?? '') }}';
    @endif

function hapus(id) {
    if (confirm('Yakin ingin menghapus?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}

function previewDocument(url, extension) {
    let viewerUrl = '';
    const ext = extension.toLowerCase();
    if (ext === 'pdf') {
        viewerUrl = url;
    } else if (['doc', 'docx', 'xls', 'xlsx'].includes(ext)) {
        viewerUrl = 'https://docs.google.com/gview?url=' + encodeURIComponent(url) + '&embedded=true';
    } else {
        viewerUrl = url;
    }
    const iframe = `<iframe src="${viewerUrl}" class="w-full h-full" frameborder="0"></iframe>`;
    document.getElementById('docPreview').innerHTML = iframe;
    document.getElementById('docModal').classList.remove('hidden');
    document.getElementById('docModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('docModal').classList.add('hidden');
    document.getElementById('docModal').classList.remove('flex');
    document.getElementById('docPreview').innerHTML = '';
}
</script>
@endsection
