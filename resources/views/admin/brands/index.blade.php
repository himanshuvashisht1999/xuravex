@extends('layouts.admin.app')

@section('title', 'All Brands')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; border: none; padding: 0;">Brand Management</h3>
        <a href="{{ route('admin.brands.create') }}" class="btn-submit" style="text-decoration: none; padding: 10px 20px;">+ Add Brand</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="admin-table">
        <thead>
            <tr>
                <th>Brand Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($brands as $brand)
            <tr>
                <td><strong>{{ $brand->name }}</strong></td>
                <td>{{ $brand->slug }}</td>
                <td>
                    <span class="badge {{ $brand->status ? 'badge-active' : 'badge-pending' }}">
                        {{ $brand->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn-icon btn-icon-edit" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-icon btn-icon-delete" title="Delete" onclick="if(confirm('Are you sure you want to delete this brand?')) { document.getElementById('delete-form-{{ $brand->id }}').submit(); }">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <form id="delete-form-{{ $brand->id }}" action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 30px; color: #999;">No brands found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
