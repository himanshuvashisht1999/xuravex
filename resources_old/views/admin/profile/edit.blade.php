@extends('layouts.admin.app')

@section('title', 'Admin Profile')

@section('content')
<div class="admin-card">
    <h3 style="margin-bottom: 25px;">Personal Information</h3>
    
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px; font-size: 13px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="admin-form-group">
            <label>Profile Image</label>
            <div style="display: flex; align-items: center; gap: 20px;">
                <img id="profile_preview" src="{{ $admin->image ? asset('uploads/admins/' . $admin->image) : 'https://via.placeholder.com/100' }}" alt="Profile" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 3px solid #C18B39;">
                <input type="file" name="image" id="profile_image" class="admin-input" style="padding: 8px;">
            </div>
        </div>

        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="admin-input" value="{{ old('name', $admin->name) }}" required>
            </div>
            <div class="admin-form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="admin-input" value="{{ old('email', $admin->email) }}" required>
            </div>
        </div>

        <h3 style="margin: 40px 0 25px; border-top: 1px solid #ddd; padding-top: 30px;">Security <span style="font-weight: 400; color: #888; font-size: 11px;">(Leave password fields blank if not changing)</span></h3>
        
        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr 1fr;">
            <div class="admin-form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="admin-input" placeholder="Required only for new password">
            </div>
            <div class="admin-form-group">
                <label>New Password</label>
                <input type="password" name="password" class="admin-input" placeholder="Leave blank to keep current">
            </div>
            <div class="admin-form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="admin-input" placeholder="Repeat new password">
            </div>
        </div>

        <div class="admin-actions" style="justify-content: flex-start; margin-top: 20px;">
            <button type="submit" class="btn-submit" style="width: 250px;">Save Profile Changes</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('profile_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('profile_preview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
