@extends('layout.dashboard')
@section('content')
<form action="{{ isset($data) ? '/management-user/' . $data->id : '/management-user' }}" method="POST">
	@csrf
	@if (isset($data))
		@method('PUT')
	@endif
	<input type="text" name="name" value="{{ $data['name'] ?? null }}" placeholder="Nama">
	<input type="text" name="email" value="{{ $data['email'] ?? null }}" placeholder="Email">
	<input type="text" name="password" value="" placeholder="Password">
	
	<select name="role_id">
		@foreach ($roles as $role)			
			<option value="{{ $role->id }}" {{ $role->id === (isset($data) ? $data->role_id : null) ? 'selected' : '' }}>{{ $role->name }}</option>
		@endforeach
	</select>

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
			<td>{{ $table->email }}</td>
			<td>{{ $table->role_id }}</td>
		</tr>
	@endforeach
</table>
@endisset
@endsection