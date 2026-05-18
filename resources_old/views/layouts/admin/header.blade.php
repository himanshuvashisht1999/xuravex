<header class="admin-header" style="height: 70px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; padding: 0 25px; background: white;">
    <div class="header-left" style="display: flex; align-items: center; gap: 20px;">
        <i class="fa-solid fa-bars toggle-sidebar" style="cursor: pointer; font-size: 20px;"></i>
        <h2 style="font-size: 18px; margin: 0;">Admin Panel</h2>
    </div>
    <div class="header-right" style="display: flex; align-items: center; gap: 25px;">
        <a href="{{ route('admin.products.create') }}" class="btn-submit" style="padding: 8px 20px; font-size: 13px; text-decoration: none;">
            <i class="fa-solid fa-plus"></i> Add New Product
        </a>
        
        <div class="notifications" style="position: relative; cursor: pointer;">
            <i class="fa-solid fa-bell" style="font-size: 20px; color: #666;"></i>
            <span style="position: absolute; top: -5px; right: -5px; background: #C18B39; color: white; font-size: 10px; padding: 2px 5px; border-radius: 50%;">5</span>
        </div>

        <a href="{{ route('admin.profile.edit') }}" class="user-profile" style="display: flex; align-items: center; gap: 12px; cursor: pointer; text-decoration: none; color: inherit;">
            @php
                $admin = auth('admin')->user();
                $firstLetter = strtoupper(substr($admin->name, 0, 1));
            @endphp
            @if($admin->image)
                <img src="{{ asset('uploads/admins/' . $admin->image) }}" alt="Profile" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;">
            @else
                <div style="width: 35px; height: 35px; background: #3E2703; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">{{ $firstLetter }}</div>
            @endif
            <div style="text-align: left;">
                <div style="font-size: 13px; font-weight: 700;">{{ $admin->name }} <i class="fa-solid fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i></div>
            </div>
        </a>
            
        <a href="#" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();" style="color: #666; margin-left: 10px;">
            <i class="fa-solid fa-right-from-bracket" style="font-size: 18px;"></i>
        </a>
        <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>
