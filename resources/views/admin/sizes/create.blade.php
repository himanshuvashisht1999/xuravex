@extends('layouts.admin.app')

@section('title', 'Add New Size')

@section('content')
<div class="admin-card">
    <h3>Size Information</h3>
    <form action="{{ route('admin.sizes.store') }}" method="POST">
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
                <label>Size Name <span class="required">*</span></label>
                <input type="text" name="name" class="admin-input" placeholder="e.g. S, M, L, XL, 50ml" required value="{{ old('name') }}">
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="status" class="admin-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <div class="admin-actions">
            <a href="{{ route('admin.sizes.index') }}" class="btn-draft" style="text-decoration: none;">Cancel</a>
            <button type="submit" class="btn-submit">Save Size</button>
        </div>
    </form>
</div>
@endsection
