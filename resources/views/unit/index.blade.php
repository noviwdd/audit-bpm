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
		<th>Detail</th>
	</tr>
	@foreach ($tables as $table)
		<tr>
			<td>{{ $table->name }}</td>
			<td>
				<a href="{{ route('unit-detail.view', ['unit_id' => 1]) }}">Add Detail</a>
			</td>
		</tr>
	@endforeach
</table>
@endisset
@endsection