@extends('layouts.frontend.app')

@section('title', 'Register - Xuravex')

@section('content')
    <div class="login-bg">
        <!-- Side Vials -->
        <img src="https://via.placeholder.com/200x300?text=BAC+Water" class="login-side-img left" alt="Vial Decoration">
        <img src="https://via.placeholder.com/200x300?text=BAC+Water" class="login-side-img right" alt="Vial Decoration">

        <div class="container" x-data="{ step: 1 }">
            <!-- Stepper -->
            <div class="registration-stepper">
                <div class="step-item" :class="step >= 1 ? 'active' : ''">
                    <div class="step-circle">1</div>
                    <div class="step-label">Account Setup</div>
                    <div class="step-line" :class="step > 1 ? 'active' : ''"></div>
                </div>
                <div class="step-item" :class="step >= 2 ? 'active' : ''">
                    <div class="step-circle">2</div>
                    <div class="step-label">Billing Details</div>
                    <div class="step-line" :class="step > 2 ? 'active' : ''"></div>
                </div>
                <div class="step-item" :class="step >= 3 ? 'active' : ''">
                    <div class="step-circle">3</div>
                    <div class="step-label">Shipping Details</div>
                </div>
            </div>

            <div class="login-container">
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    
                    <!-- Step 1: Account Setup -->
                    <div x-show="step === 1" x-transition>
                        <h2>Account Setup</h2>
                        <div style="width: 100px; height: 2px; background: var(--secondary-color); margin: 0 auto 30px;"></div>

                        <div class="login-form">
                            <div class="form-group">
                                <label>Email *</label>
                                <div class="input-with-icon" style="padding-left: 0;">
                                    <input type="email" name="email" placeholder="Enter your email address" required style="padding-left: 15px;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password *</label>
                                <div class="input-with-icon" style="padding-left: 0;">
                                    <input type="password" name="password" id="reg-password" placeholder="Enter your password" required style="padding-left: 15px;">
                                    <i class="fa-solid fa-eye-slash toggle-password" onclick="toggleRegPass()"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Intended Use *</label>
                                <div class="input-with-icon" style="padding-left: 0;">
                                    <select name="intended_use" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option>Independent Research</option>
                                        <option>Institutional Research</option>
                                        <option>Commercial Research</option>
                                    </select>
                                </div>
                            </div>

                            <button type="button" @click="step = 2" class="btn btn-primary" style="width: 100%; padding: 15px; margin-top: 20px;">Save and Continue <i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Billing Details -->
                    <div x-show="step === 2" x-transition>
                        <div style="position: relative;">
                            <button type="button" @click="step = 1" style="position: absolute; left: -30px; top: -5px; background: none; border: 1px solid rgba(255,255,255,0.2); color: white; width: 35px; height: 35px; border-radius: 50%; cursor: pointer;">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <h2>Billing Details</h2>
                        </div>
                        <div style="width: 100px; height: 2px; background: var(--secondary-color); margin: 0 auto 30px;"></div>
                        
                        <div class="login-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Title *</label>
                                    <select name="billing_title" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option>Select Title</option>
                                        <option>Mr.</option>
                                        <option>Ms.</option>
                                        <option>Dr.</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>First Name *</label>
                                    <input type="text" name="first_name" placeholder="Enter your first name" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                                <div class="form-group">
                                    <label>Last Name *</label>
                                    <input type="text" name="last_name" placeholder="Enter your last name" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Street address *</label>
                                <input type="text" name="address" placeholder="Enter your address" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                            </div>

                            <div class="form-group">
                                <label>Apartment, suite, unit (optional)</label>
                                <input type="text" name="apartment" placeholder="Enter apartment name (optional)" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>City *</label>
                                    <input type="text" name="city" placeholder="Enter your city" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                                <div class="form-group">
                                    <label>State / Province *</label>
                                    <input type="text" name="state" placeholder="Enter your state" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                                <div class="form-group">
                                    <label>ZIP / Postal code *</label>
                                    <input type="text" name="zip" placeholder="Enter your ZIP / Postal code" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Country *</label>
                                    <select name="country" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option>Select Country / region ...</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Phone *</label>
                                    <input type="text" name="phone" placeholder="Enter your phone" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                                <div class="form-group">
                                    <label>Company (optional)</label>
                                    <input type="text" name="company" placeholder="Enter your company" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                            </div>

                            <button type="button" @click="step = 3" class="btn btn-primary" style="width: 100%; padding: 15px; margin-top: 20px;">Save and Continue <i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Shipping Details -->
                    <div x-show="step === 3" x-transition>
                        <div style="display: flex; justify-content: space-between; align-items: center; position: relative;">
                            <button type="button" @click="step = 2" style="background: none; border: 1px solid rgba(255,255,255,0.2); color: white; width: 35px; height: 35px; border-radius: 50%; cursor: pointer;">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <h2 style="margin: 0;">Shipping Details</h2>
                            <label style="display: flex; gap: 8px; font-size: 13px; color: var(--gray-300); cursor: pointer;">
                                <input type="checkbox"> Same as billing address
                            </label>
                        </div>
                        <div style="width: 100px; height: 2px; background: var(--secondary-color); margin: 15px auto 30px;"></div>
                        
                        <div class="login-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Title *</label>
                                    <select name="shipping_title" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option>Select Title</option>
                                        <option>Mr.</option>
                                        <option>Ms.</option>
                                        <option>Dr.</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>First Name *</label>
                                    <input type="text" name="ship_first_name" placeholder="Enter your first name" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                                <div class="form-group">
                                    <label>Last Name *</label>
                                    <input type="text" name="ship_last_name" placeholder="Enter your last name" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Street address *</label>
                                <input type="text" name="ship_address" placeholder="Enter your address" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                            </div>

                            <div class="form-group">
                                <label>Apartment, suite, unit (optional)</label>
                                <input type="text" name="ship_apartment" placeholder="Enter apartment name (optional)" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>City *</label>
                                    <input type="text" name="ship_city" placeholder="Enter your city" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                                <div class="form-group">
                                    <label>State / Province *</label>
                                    <input type="text" name="ship_state" placeholder="Enter your state" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                                <div class="form-group">
                                    <label>ZIP / Postal code *</label>
                                    <input type="text" name="ship_zip" placeholder="Enter your ZIP / Postal code" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Country *</label>
                                    <select name="ship_country" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option>Select Country / region ...</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Phone *</label>
                                    <input type="text" name="ship_phone" placeholder="Enter your phone" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                                <div class="form-group">
                                    <label>Company (optional)</label>
                                    <input type="text" name="ship_company" placeholder="Enter your company" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; margin-top: 20px;">Save and Submit</button>

                            <div class="social-login">
                                <p style="position: relative; font-size: 13px;">
                                    <span style="background: rgba(20,20,20,1); padding: 0 15px; position: relative; z-index: 2;">or continue with</span>
                                    <span style="position: absolute; left: 0; top: 50%; width: 100%; height: 1px; background: rgba(255,255,255,0.1); z-index: 1;"></span>
                                </p>
                                
                                <div class="social-btn google" style="margin-bottom: 10px;">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="20" alt="Google">
                                    Continue with Google
                                </div>
                                <div class="social-btn microsoft">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" width="20" alt="Microsoft">
                                    Continue with Microsoft
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="login-signup-link">
                    Already have an account? <a href="{{ route('login') }}">Log in</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleRegPass() {
        const passInput = document.getElementById('reg-password');
        const icon = document.querySelector('.toggle-password');
        if (passInput.type === 'password') {
            passInput.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            passInput.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    }
</script>
@endpush
