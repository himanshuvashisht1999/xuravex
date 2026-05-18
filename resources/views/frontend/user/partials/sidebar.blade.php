<aside class="dashboard-sidebar">
    <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow-sm);">
        <div style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid var(--gray-100);">
            <div style="width: 80px; height: 80px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 15px; font-weight: 700;">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <h4 style="margin: 0; color: var(--primary-color);">{{ auth()->user()->name }}</h4>
            <p style="font-size: 0.85rem; color: var(--gray-500); margin: 5px 0 0;">{{ auth()->user()->email }}</p>
        </div>

        <ul style="list-style: none; padding: 0; margin: 0;">
            <li style="margin-bottom: 10px;">
                <a href="{{ route('user.dashboard') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; 
                    background: {{ request()->routeIs('user.dashboard') ? 'rgba(193, 139, 57, 0.1)' : 'transparent' }};
                    color: {{ request()->routeIs('user.dashboard') ? 'var(--secondary-color)' : 'var(--gray-600)' }};">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>
            </li>
            <li style="margin-bottom: 10px;">
                <a href="{{ route('user.profile') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; 
                    background: {{ request()->routeIs('user.profile') ? 'rgba(193, 139, 57, 0.1)' : 'transparent' }};
                    color: {{ request()->routeIs('user.profile') ? 'var(--secondary-color)' : 'var(--gray-600)' }};">
                    <i class="fa-solid fa-user"></i> My Profile
                </a>
            </li>
            <li style="margin-bottom: 10px;">
                <a href="{{ route('user.shipping') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; 
                    background: {{ request()->routeIs('user.shipping') ? 'rgba(193, 139, 57, 0.1)' : 'transparent' }};
                    color: {{ request()->routeIs('user.shipping') ? 'var(--secondary-color)' : 'var(--gray-600)' }};">
                    <i class="fa-solid fa-location-dot"></i> Shipping Addresses
                </a>
            </li>
            <li style="margin-top: 20px; border-top: 1px solid var(--gray-100); padding-top: 20px;">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; color: #ff4d4d;">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</aside>
