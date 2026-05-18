@extends('layouts.admin.app')

@section('title', 'Add New Category')

@section('content')
<div class="admin-card">
    <h3>Category Information</h3>
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
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
                <label>Category Name <span class="required">*</span></label>
                <input type="text" name="name" class="admin-input" placeholder="Enter category name" required value="{{ old('name') }}">
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="status" class="admin-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Category Image <span style="font-weight: 400; color: #888; font-size: 11px;">(JPG, JPEG, PNG only)</span></label>
            <div style="display: flex; align-items: flex-start; gap: 20px;">
                <input type="file" name="image" id="category_image" class="admin-input" style="padding: 8px;" accept="image/jpeg,image/png,image/jpg">
                <div id="image_preview_container" style="display: none;">
                    <img id="image_preview" src="" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                </div>
            </div>
        </div>

        <script>
            document.getElementById('category_image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const previewContainer = document.getElementById('image_preview_container');
                const previewImage = document.getElementById('image_preview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        previewContainer.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewContainer.style.display = 'none';
                }
            });
        </script>

        <div class="admin-form-group">
            <label>Description</label>
            <textarea name="description" class="admin-input" rows="5" placeholder="Enter category description...">{{ old('description') }}</textarea>
        </div>

        <div class="admin-actions">
            <a href="{{ route('admin.categories.index') }}" class="btn-draft" style="text-decoration: none;">Cancel</a>
            <button type="submit" class="btn-submit">Save Category</button>
        </div>
    </form>
</div>
@endsection
