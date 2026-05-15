@extends('layouts.admin.app')

@section('title', 'Edit Category')

@section('content')
<div class="admin-card">
    <h3>Edit Category: {{ $category->name }}</h3>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
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
                <input type="text" name="name" class="admin-input" value="{{ old('name', $category->name) }}" required>
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="status" class="admin-select">
                    <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Category Image <span style="font-weight: 400; color: #888; font-size: 11px;">(JPG, JPEG, PNG only)</span></label>
            <div style="display: flex; align-items: flex-start; gap: 20px;">
                <div style="flex-grow: 1;">
                    <input type="file" name="image" id="category_image" class="admin-input" style="padding: 8px;" accept="image/jpeg,image/png,image/jpg">
                </div>
                <div id="image_preview_container">
                    @if($category->image)
                        <img id="image_preview" src="{{ asset('uploads/categories/' . $category->image) }}" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                    @else
                        <img id="image_preview" src="" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; display: none;">
                    @endif
                </div>
            </div>
        </div>

        <script>
            document.getElementById('category_image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const previewImage = document.getElementById('image_preview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        previewImage.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>

        <div class="admin-form-group">
            <label>Description</label>
            <textarea name="description" class="admin-input" rows="5">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="admin-actions">
            <a href="{{ route('admin.categories.index') }}" class="btn-draft" style="text-decoration: none;">Cancel</a>
            <button type="submit" class="btn-submit">Update Category</button>
        </div>
    </form>
</div>
@endsection
