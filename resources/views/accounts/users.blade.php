@extends('layouts.app')
@section('content')
<div class="section-head"><div><div class="eyebrow">Accounts / users</div><h1>{{ $title }}</h1><p>{{ $subtitle }}</p></div><a class="button" href="/customers">View customers</a></div><div class="table-wrap"><table><thead><tr><th>Account ID</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th></tr></thead><tbody>@foreach ($records as $record)<tr><td>{{ $record['id'] }}</td><td><strong>{{ $record['name'] }}</strong></td><td class="muted">{{ $record['email'] }}</td><td class="muted">{{ $record['role'] }}</td><td><span class="tag {{ strtolower($record['status']) }}">{{ $record['status'] }}</span></td></tr>@endforeach</tbody></table></div><p class="empty-note">Showing {{ count($records) }} sample records from a static PHP array.</p>
@endsection
