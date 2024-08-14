@extends('layout.dashboard')
@section('title', 'Performance Unit')
@section('content')
    <div class="block text-center">INSTITIT BISNIS DAN INFORMATIKA KESATUAN</div>
    <div class="block text-center">EVAPORASI KINERJA TAHUN 2023</div>
    <div class="block text-center">UNIT : PROGRAM STUDI S1 AKUNTANSI</div>

    <form action="{{ url('performace-unit', ['id' => request()->edit_id]) }}" method="POST">
        @csrf
        @if (request()->has('edit_id'))
            @method('PUT')
        @endif
        <input type="hidden" name="parent" value="{{ request()->parent }}">
        <table class="border-collapse border border-slate-500 w-full mt-4">
            <tr>
                <th colspan="6" class="border border-slate-600 bg-slate-200">Ketercapaian Kinerja Unit</th>
                <th colspan="4" class="border border-slate-600 bg-slate-200">Penilaian Auditor</th>
                <th></th>
            </tr>
            <tr>
                <th rowspan="2" class="border border-slate-600 bg-slate-200">NO</th>
                <th rowspan="2" class="border border-slate-600 bg-slate-200">Keterangan</th>
                <th rowspan="2" class="border border-slate-600 bg-slate-200">Target</th>
                <th rowspan="2" class="border border-slate-600 bg-slate-200">Realisasi</th>
                <th rowspan="2" class="border border-slate-600 bg-slate-200">Waktu Pelaksanaan</th>
                <th rowspan="2" class="border border-slate-600 bg-slate-200">Dokumen</th>

                <th colspan="3" class="border border-slate-600 bg-slate-200">Evaluasi</th>
                <th rowspan="2" class="border border-slate-600 bg-slate-200">Catatan</th>
                <th></th>
            </tr>
            <tr>
                <th class="border border-slate-600 bg-slate-200">Tidak Terpenuhi</th>
                <th class="border border-slate-600 bg-slate-200">Terpenuhi</th>
                <th class="border border-slate-600 bg-slate-200">Terlampaui</th>
                <th></th>
            </tr>
            @foreach ($data as $index => $item)
                @if (request()->edit_id == $item->id)
                    <tr>
                        <td class="border border-slate-600 bg-slate-200 text-center">
                            {{ $index + 1 }}
                        </td>
                        <td class="border border-slate-600 bg-slate-200">
                            <input type="text" name="work_planing" class="bg-transparent h-8 w-full" value="{{ $item->work_planing }}">
                        </td>
                        <td class="border border-slate-600 bg-slate-200">
                            <input type="text" name="target" class="bg-transparent h-8 w-full" value="{{ $item->target }}">
                        </td>
                        <td class="border border-slate-600 bg-slate-200">
                            <input type="text" name="achieve" class="bg-transparent h-8 w-full" value="{{ $item->achieve }}">
                        </td>
                        <td class="border border-slate-600 bg-slate-200">
                            <input type="text" name="time_target" class="bg-transparent h-8 w-full" value="{{ $item->time_target }}">
                        </td>
                        <td class="border border-slate-600 bg-slate-200">
                            <input type="text" name="document" class="bg-transparent h-8 w-full" value="{{ $item->document }}">
                        </td>
                        <td class="border border-slate-600 bg-slate-200"></td>
                        <td class="border border-slate-600 bg-slate-200"></td>
                        <td class="border border-slate-600 bg-slate-200"></td>
                        <td class="border border-slate-600 bg-slate-200"></td>
                        <td class="border border-slate-600 bg-slate-200">
                            <button type="submit">Simpan</button>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td class="border border-slate-600 bg-slate-200 text-center">{{ $index + 1 }}</td>
                        <td class="border border-slate-600 bg-slate-200">{{ $item->work_planing }}</td>
                        <td class="border border-slate-600 bg-slate-200 text-center">{{ $item->target }}</td>
                        <td class="border border-slate-600 bg-slate-200 text-center">{{ $item->achieve }}</td>
                        <td class="border border-slate-600 bg-slate-200 text-center">{{ $item->time_target }}</td>
                        <td class="border border-slate-600 bg-slate-200 text-center">{{ $item->document }}</td>
                        <td class="border border-slate-600 bg-slate-200 text-center"></td>
                        <td class="border border-slate-600 bg-slate-200 text-center"></td>
                        <td class="border border-slate-600 bg-slate-200 text-center"></td>
                        <td class="border border-slate-600 bg-slate-200 text-center"></td>
                        <td>
                            <select onchange="actions(this, '{{ $item->id }}')">
                                <option value="" selected></option>
                                <option value="add_above">Add Above</option>
                                <option value="add_below">Add Below</option>
                                <option value="edit_id">Edit</option>
                            </select>
                        </td>
                    </tr>
                @endif
            @endforeach
            
            @if (!request()->edit_id)
            <tr>
                <td class="border border-slate-600 bg-slate-200 text-center">
                    {{ request()->parent }}.
                </td>
                <td class="border border-slate-600 bg-slate-200">
                    <input type="text" name="work_planing" class="bg-transparent h-8 w-full">
                </td>
                <td class="border border-slate-600 bg-slate-200">
                    <input type="text" name="target" class="bg-transparent h-8 w-full">
                </td>
                <td class="border border-slate-600 bg-slate-200">
                    <input type="text" name="achieve" class="bg-transparent h-8 w-full">
                </td>
                <td class="border border-slate-600 bg-slate-200">
                    <input type="text" name="time_target" class="bg-transparent h-8 w-full">
                </td>
                <td class="border border-slate-600 bg-slate-200">
                    <input type="text" name="document" class="bg-transparent h-8 w-full">
                </td>
                <td class="border border-slate-600 bg-slate-200"></td>
                <td class="border border-slate-600 bg-slate-200"></td>
                <td class="border border-slate-600 bg-slate-200"></td>
                <td class="border border-slate-600 bg-slate-200"></td>
                <td class="border border-slate-600 bg-slate-200">
                    <button type="submit">Simpan</button>
                </td>
            </tr>
            @endif
        </table>
    </form>

    <script>
        function actions(event, id) {
            location.href = 'performace-unit?' + event.value + '=' + id
        }
    </script>
@endsection
