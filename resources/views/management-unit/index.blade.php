@extends('layout.dashboard')
@section('content')
<form action="{{ isset($data) ? '/management-unit/' . $data->id : '/management-unit' }}" method="POST">
	@csrf
	@if (isset($data))
		@method('PUT')
	@endif
	<input type="text" name="target" value="{{ $data['target'] ?? null }}" placeholder="Target">
	<input type="text" name="realisasi" value="{{ $data['realisasi'] ?? null }}" placeholder="Realisasi">
	<input type="text" name="target_waktu_pelaksanaan" value="{{ $data['target_waktu_pelaksanaan'] ?? null }}" placeholder="Target Waktu Pelaksanaan">
	<input type="text" name="realisasi_waktu_pelaksanaan" value="{{ $data['realisasi_waktu_pelaksanaan'] ?? null }}" placeholder="Realisasi Waktu Pelaksanaan">
	<input type="text" name="dokumen" value="{{ $data['dokumen'] ?? null }}" placeholder="Dokumen">
	<input type="text" name="evaluasi_tidak_terpenuhi" value="{{ $data['evaluasi_tidak_terpenuhi'] ?? null }}" placeholder="Evaluasi Tidak Terpenuhi">
	<input type="text" name="evaluasi_terpenuhi" value="{{ $data['evaluasi_terpenuhi'] ?? null }}" placeholder="Evaluasi Terpenuhi">
	<input type="text" name="evaluasi_terlampaui" value="{{ $data['evaluasi_terlampaui'] ?? null }}" placeholder="Evaluasi Terlampaui">
	<input type="text" name="catatan" value="{{ $data['catatan'] ?? null }}" placeholder="Catatan">

	<button type="submit">Simpan</button>
</form>
@endsection