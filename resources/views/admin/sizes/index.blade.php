@extends('layouts.admin.app')

@section('title', 'All Sizes')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; border: none; padding: 0;">Size Management</h3>
        <a href="{{ route('admin.sizes.create') }}" class="btn-submit" style="text-decoration: none; padding: 10px 20px;">+ Add Size</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="admin-table">
        <thead>
            <tr>
                <th>Size Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sizes as $size)
            <tr>
                <td><strong>{{ $size->name }}</strong></td>
                <td>
                    <span class="badge {{ $size->status ? 'badge-active' : 'badge-pending' }}">
                        {{ $size->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.sizes.edit', $size->id) }}" class="btn-icon btn-icon-edit" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-icon btn-icon-delete" title="Delete" onclick="if(confirm('Are you sure you want to delete this size?')) { document.getElementById('delete-form-{{ $size->id }}').submit(); }">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <form id="delete-form-{{ $size->id }}" action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center; padding: 30px; color: #999;">No sizes found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
