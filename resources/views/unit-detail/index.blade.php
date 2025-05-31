@extends('layout.dashboard')
@section('content')
<form action="{{ isset($data) ? '/unit/' . $unitID . '/details/' . $data->id : '/unit/' . $unitID . '/details/' }}" method="POST">
	@csrf
	@if (isset($data))
		@method('PUT')
	@endif
	<input type="hidden" name="unit_id" value="{{ $unitID }}">
	<input type="text" name="name" value="{{ $data['name'] ?? null }}" placeholder="Nama">
	
	<button type="submit">Simpan</button>
</form>

@isset($tables)	
<table>
	<tr>
		<th>Nama</th>
	</tr>
	@foreach ($tables as $table)
		<tr>
			<td>{{ $table->name }}</td>
		</tr>
	@endforeach
</table>
@endisset
@endsection