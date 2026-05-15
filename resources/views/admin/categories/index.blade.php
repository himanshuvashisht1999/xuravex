@extends('layouts.admin.app')

@section('title', 'All Categories')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; border: none; padding: 0;">Category Management</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn-submit" style="text-decoration: none; padding: 10px 20px;">+ Add Category</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>
                    <div class="table-thumb">
                        <img src="{{ $category->image ? asset('uploads/categories/' . $category->image) : 'https://via.placeholder.com/40x50?text=Cat' }}" alt="Cat">
                    </div>
                </td>
                <td><strong>{{ $category->name }}</strong></td>
                <td>{{ $category->slug }}</td>
                <td>
                    <span class="badge {{ $category->status ? 'badge-active' : 'badge-pending' }}">
                        {{ $category->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-icon btn-icon-edit" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-icon btn-icon-delete" title="Delete" onclick="if(confirm('Are you sure you want to delete this category?')) { document.getElementById('delete-form-{{ $category->id }}').submit(); }">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 30px; color: #999;">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
