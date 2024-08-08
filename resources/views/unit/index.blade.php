@extends('layout.dashboard')
@section('content')
<form action="{{ isset($data) ? '/units/' . $data->id : '/units' }}" method="POST">
	@csrf
	@if (isset($data))
		@method('PUT')
	@endif
	<input type="text" name="name" value="{{ $data['name'] ?? null }}" placeholder="Nama">
	
	<button type="submit">Simpan</button>
</form>

@isset($tables)	
<table>
	<tr>
		<th>Nama</th>
		<th>Email</th>
		<th>Role</th>
	</tr>
	@foreach ($tables as $table)
		<tr>
			<td>{{ $table->name }}</td>
		</tr>
	@endforeach
</table>
@endisset
@endsection