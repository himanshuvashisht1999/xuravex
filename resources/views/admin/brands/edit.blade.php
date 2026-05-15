@extends('layouts.admin.app')

@section('title', 'Edit Brand')

@section('content')
<div class="admin-card">
    <h3>Edit Brand: {{ $brand->name }}</h3>
    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST">
        @csrf
        
        @if ($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 25px; font-size: 13px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>Brand Name <span class="required">*</span></label>
                <input type="text" name="name" class="admin-input" value="{{ old('name', $brand->name) }}" required>
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="status" class="admin-select">
                    <option value="1" {{ $brand->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$brand->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="admin-actions">
            <a href="{{ route('admin.brands.index') }}" class="btn-draft" style="text-decoration: none;">Cancel</a>
            <button type="submit" class="btn-submit">Update Brand</button>
        </div>
    </form>
</div>
@endsection
