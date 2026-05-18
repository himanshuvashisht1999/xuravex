@extends('layouts.admin.app')

@section('title', 'Customer Profile')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
    <!-- Left: Profile Summary -->
    <div>
        <div class="admin-card" style="text-align: center;">
            <div style="width: 100px; height: 100px; background: #F3E9D9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #3E2703; font-size: 32px; margin: 0 auto 20px;">JD</div>
            <h2 style="margin-bottom: 5px;">John Doe</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Customer since April 2026</p>
            <span class="badge badge-active">Active</span>
            
            <hr style="border: none; border-top: 1px solid #eee; margin: 25px 0;">
            
            <div style="text-align: left;">
                <div style="margin-bottom: 15px;">
                    <p style="font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 5px;">Email Address</p>
                    <p style="font-weight: 600;">john.doe@example.com</p>
                </div>
                <div style="margin-bottom: 15px;">
                    <p style="font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 5px;">Phone Number</p>
                    <p style="font-weight: 600;">+1 212 555 7834</p>
                </div>
                <div>
                    <p style="font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 5px;">Address</p>
                    <p style="font-weight: 600;">245 Madison Avenue, Suite 1200, New York, NY 10016, USA</p>
                </div>
            </div>
        </div>

        <div class="admin-card" style="margin-top: 30px; background: #3E2703; color: white;">
            <h3 style="color: white; border-color: rgba(255,255,255,0.1);">Quick Stats</h3>
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <span>Total Orders</span>
                <span style="font-weight: 700;">12</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Lifetime Value</span>
                <span style="font-weight: 700;">$1,420.00</span>
            </div>
        </div>
    </div>

    <!-- Right: Recent Activity / Orders -->
    <div>
        <div class="admin-card">
            <h3 style="border: none;">Recent Orders</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>#ORD-1001</strong></td>
                        <td>2026-05-14</td>
                        <td><span class="badge badge-processing">Processing</span></td>
                        <td>$225.00</td>
                    </tr>
                    <tr>
                        <td><strong>#ORD-0952</strong></td>
                        <td>2026-04-28</td>
                        <td><span class="badge badge-shipped">Shipped</span></td>
                        <td>$185.00</td>
                    </tr>
                </tbody>
            </table>
            <a href="#" style="display: block; text-align: center; margin-top: 20px; color: #C18B39; font-weight: 600; text-decoration: none; font-size: 13px;">View All Orders</a>
        </div>

        <div class="admin-card" style="margin-top: 30px;">
            <h3 style="border: none;">Account Settings</h3>
            <div style="display: flex; gap: 15px;">
                <button class="btn-draft" style="width: auto;">Reset Password</button>
                <button class="btn-draft" style="width: auto; background: #dc3545; color: white;">Deactivate Account</button>
            </div>
        </div>
    </div>
</div>
@endsection
