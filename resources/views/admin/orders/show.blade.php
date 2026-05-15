@extends('layouts.admin.app')

@section('title', 'Order Details')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h2 style="margin: 0;">Order #ORD-1001</h2>
        <p style="color: #666; margin: 5px 0 0;">Placed on May 14, 2026 at 10:45 AM</p>
    </div>
    <div style="display: flex; gap: 15px;">
        <button class="btn-draft" style="padding: 10px 20px;">Print Invoice</button>
        <select class="admin-select" style="width: 180px; background: #3E2703; color: white; border: none;">
            <option>Mark as Shipped</option>
            <option>Mark as Completed</option>
            <option>Mark as Cancelled</option>
        </select>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
    <!-- Left Column: Items & Payment -->
    <div>
        <div class="admin-card">
            <h3 style="border: none; margin-bottom: 20px;">Order Items</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="table-thumb"><img src="https://via.placeholder.com/40x50?text=Vial" alt=""></div>
                                <div>
                                    <div style="font-weight: 700;">5-Amino-1MQ</div>
                                    <div style="font-size: 12px; color: #888;">SKU: XUR-P-001</div>
                                </div>
                            </div>
                        </td>
                        <td>$55.00</td>
                        <td>2</td>
                        <td style="text-align: right;">$110.00</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="table-thumb"><img src="https://via.placeholder.com/40x50?text=Vial" alt=""></div>
                                <div>
                                    <div style="font-weight: 700;">BPC-157</div>
                                    <div style="font-size: 12px; color: #888;">SKU: XUR-P-042</div>
                                </div>
                            </div>
                        </td>
                        <td>$170.00</td>
                        <td>1</td>
                        <td style="text-align: right;">$170.00</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right; padding-top: 20px; border: none; font-weight: 600;">Subtotal:</td>
                        <td style="text-align: right; padding-top: 20px; border: none;">$280.00</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; border: none; font-weight: 600;">Shipping:</td>
                        <td style="text-align: right; border: none;">$15.00</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; border: none; font-size: 18px; font-weight: 800; color: #3E2703;">Total:</td>
                        <td style="text-align: right; border: none; font-size: 18px; font-weight: 800; color: #3E2703;">$295.00</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="admin-card" style="margin-top: 30px;">
            <h3 style="border: none; margin-bottom: 20px;">Payment Information</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <p style="font-size: 13px; color: #888; margin-bottom: 5px;">Payment Method</p>
                    <p style="font-weight: 600;">Credit Card (Visa ending in 4242)</p>
                </div>
                <div>
                    <p style="font-size: 13px; color: #888; margin-bottom: 5px;">Transaction ID</p>
                    <p style="font-weight: 600;">#TXN_9283740192</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Customer Info & Shipping -->
    <div>
        <div class="admin-card">
            <h3 style="border: none; margin-bottom: 20px;">Customer Details</h3>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                <div style="width: 50px; height: 50px; background: #F3E9D9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #3E2703;">JD</div>
                <div>
                    <div style="font-weight: 700;">John Doe</div>
                    <div style="font-size: 13px; color: #666;">john.doe@example.com</div>
                </div>
            </div>
            <hr style="border: none; border-top: 1px solid #eee; margin-bottom: 20px;">
            <p style="font-weight: 700; margin-bottom: 10px; font-size: 14px;">Shipping Address</p>
            <p style="font-size: 14px; line-height: 1.6; color: #555;">
                245 Madison Avenue, Suite 1200<br>
                New York, NY 10016<br>
                United States<br>
                Ph: +1 (212) 555-7834
            </p>
        </div>

        <div class="admin-card" style="margin-top: 30px;">
            <h3 style="border: none; margin-bottom: 20px;">Order Notes</h3>
            <p style="font-size: 14px; color: #555; font-style: italic;">"Please deliver before 5 PM. Leave with concierge if not available."</p>
        </div>
    </div>
</div>
@endsection
