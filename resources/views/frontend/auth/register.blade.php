@extends('layouts.frontend.app')

@section('title', 'Register - Xuravex')

@section('content')
    <div class="login-bg" style="background-image:url({{asset('images/login-page-bg.png')}})">
       
        <div class="container" x-data="{ 
            step: {{ $errors->any() ? ( $errors->has('email') || $errors->has('password') || $errors->has('intended_use') ? 1 : ($errors->has('shipping_title') || $errors->has('ship_first_name') ? 3 : 2) ) : 1 }}, 
            sameAsBilling: false,
            billing: {
                title: '{{ old('billing_title') }}',
                first_name: '{{ old('first_name') }}',
                last_name: '{{ old('last_name') }}',
                address: '{{ old('address') }}',
                apartment: '{{ old('apartment') }}',
                city: '{{ old('city') }}',
                state: '{{ old('state') }}',
                zip: '{{ old('zip') }}',
                country: '{{ old('country') }}',
                phone: '{{ old('phone') }}',
                company: '{{ old('company') }}'
            },
            shipping: {
                title: '{{ old('shipping_title') }}',
                first_name: '{{ old('ship_first_name') }}',
                last_name: '{{ old('ship_last_name') }}',
                address: '{{ old('ship_address') }}',
                apartment: '{{ old('ship_apartment') }}',
                city: '{{ old('ship_city') }}',
                state: '{{ old('ship_state') }}',
                zip: '{{ old('ship_zip') }}',
                country: '{{ old('ship_country') }}',
                phone: '{{ old('ship_phone') }}',
                company: '{{ old('ship_company') }}'
            },
            syncShipping() {
                if (this.sameAsBilling) {
                    this.shipping.title = this.billing.title;
                    this.shipping.first_name = this.billing.first_name;
                    this.shipping.last_name = this.billing.last_name;
                    this.shipping.address = this.billing.address;
                    this.shipping.apartment = this.billing.apartment;
                    this.shipping.city = this.billing.city;
                    this.shipping.state = this.billing.state;
                    this.shipping.zip = this.billing.zip;
                    this.shipping.country = this.billing.country;
                    this.shipping.phone = this.billing.phone;
                    this.shipping.company = this.billing.company;
                }
            }
        }">
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

            <div class="login-container"style="width: 100%;
    max-width: 100%;">
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    
                    <!-- Step 1: Account Setup -->
                    <div x-show="step === 1" x-transition>
                        <h2>Account Setup</h2>
                        <div style="width: 100px; height: 2px; background: var(--secondary-color); margin: 0 auto 30px;"></div>

                        <div class="login-form">
                            <div class="form-group">
                                <label>Email <span style="color: red;">*</span></label>
                                <div class="input-with-icon" style="padding-left: 0;">
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required style="padding-left: 15px;">
                                </div>
                                @error('email') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Password <span style="color: red;">*</span></label>
                                <div class="input-with-icon" style="padding-left: 0;">
                                    <input type="password" name="password" id="reg-password" placeholder="Enter your password" required style="padding-left: 15px;">
                                    <i class="fa-solid fa-eye-slash toggle-password" onclick="toggleRegPass()"></i>
                                </div>
                                @error('password') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Intended Use <span style="color: red;">*</span></label>
                                <div class="input-with-icon" style="padding-left: 0;">
                                    <select name="intended_use" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option value="Independent Research" {{ old('intended_use') == 'Independent Research' ? 'selected' : '' }}>Independent Research</option>
                                        <option value="Institutional Research" {{ old('intended_use') == 'Institutional Research' ? 'selected' : '' }}>Institutional Research</option>
                                        <option value="Commercial Research" {{ old('intended_use') == 'Commercial Research' ? 'selected' : '' }}>Commercial Research</option>
                                    </select>
                                </div>
                                @error('intended_use') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                            </div>

                            <button type="button" @click="step = 2" class="btn btn-primary" style="width: 100%; padding: 15px; margin-top: 20px;">Save and Continue <i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Billing Details -->
                    <div x-show="step === 2" x-transition>
                        <div style="position: relative;">
                            <button class="back-btn-login"  type="button" @click="step = 1">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <h2>Billing Details</h2>
                        </div>
                        <div style="width: 100px; height: 2px; background: var(--secondary-color); margin: 0 auto 30px;"></div>
                        
                        <div class="login-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Title *</label>
                                    <select name="billing_title" x-model="billing.title" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option value="">Select Title</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Dr.">Dr.</option>
                                    </select>
                                    @error('billing_title') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>First Name *</label>
                                    <input type="text" name="first_name" x-model="billing.first_name" placeholder="Enter your first name" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('first_name') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Last Name *</label>
                                    <input type="text" name="last_name" x-model="billing.last_name" placeholder="Enter your last name" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('last_name') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Street address *</label>
                                <input type="text" name="address" x-model="billing.address" placeholder="Enter your address" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                @error('address') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Apartment, suite, unit (optional)</label>
                                <input type="text" name="apartment" x-model="billing.apartment" placeholder="Enter apartment name (optional)" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>City *</label>
                                    <input type="text" name="city" x-model="billing.city" placeholder="Enter your city" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('city') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>State / Province *</label>
                                    <input type="text" name="state" x-model="billing.state" placeholder="Enter your state" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('state') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>ZIP / Postal code *</label>
                                    <input type="text" name="zip" x-model="billing.zip" placeholder="Enter your ZIP / Postal code" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('zip') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Country *</label>
                                    <select name="country" x-model="billing.country" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option value="">Select Country / region ...</option>
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                    </select>
                                    @error('country') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone *</label>
                                    <input type="text" name="phone" x-model="billing.phone" placeholder="Enter your phone" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('phone') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Company (optional)</label>
                                    <input type="text" name="company" x-model="billing.company" placeholder="Enter your company" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                            </div>

                            <button type="button" @click="step = 3; syncShipping();" class="btn btn-primary" style="width: 100%; padding: 15px; margin-top: 20px;">Save and Continue <i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Shipping Details -->
                    <div x-show="step === 3" x-transition>
                        <div style="display: flex; justify-content: space-between; align-items: center; position: relative;"class="login-main-heading">
                            <button class="back-btn-login" type="button" @click="step = 2" >
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <h2 style="margin: auto; padding-left: 149px;">Shipping Details</h2>
                            <label style="display: flex; gap: 8px; font-size: 13px; color: var(--gray-300); cursor: pointer;    align-items: center;">
                                <input type="checkbox" name="same_as_billing" value="1" x-model="sameAsBilling" @change="syncShipping()"> Same as billing address
                            </label>
                        </div>
                        <div style="width: 100px; height: 2px; background: var(--secondary-color); margin: 15px auto 30px;"></div>
                        
                        <div class="login-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Title *</label>
                                    <select name="shipping_title" x-model="shipping.title" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option value="">Select Title</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Dr.">Dr.</option>
                                    </select>
                                    @error('shipping_title') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>First Name *</label>
                                    <input type="text" name="ship_first_name" x-model="shipping.first_name" placeholder="Enter your first name" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('ship_first_name') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Last Name *</label>
                                    <input type="text" name="ship_last_name" x-model="shipping.last_name" placeholder="Enter your last name" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('ship_last_name') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Street address *</label>
                                <input type="text" name="ship_address" x-model="shipping.address" placeholder="Enter your address" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                @error('ship_address') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Apartment, suite, unit (optional)</label>
                                <input type="text" name="ship_apartment" x-model="shipping.apartment" placeholder="Enter apartment name (optional)" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>City *</label>
                                    <input type="text" name="ship_city" x-model="shipping.city" placeholder="Enter your city" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('ship_city') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>State / Province *</label>
                                    <input type="text" name="ship_state" x-model="shipping.state" placeholder="Enter your state" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('ship_state') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>ZIP / Postal code *</label>
                                    <input type="text" name="ship_zip" x-model="shipping.zip" placeholder="Enter your ZIP / Postal code" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('ship_zip') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Country *</label>
                                    <select name="ship_country" x-model="shipping.country" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option value="">Select Country / region ...</option>
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                    </select>
                                    @error('ship_country') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone *</label>
                                    <input type="text" name="ship_phone" x-model="shipping.phone" placeholder="Enter your phone" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                    @error('ship_phone') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Company (optional)</label>
                                    <input type="text" name="ship_company" x-model="shipping.company" placeholder="Enter your company" class="form-input-checkout" style="background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; margin-top: 20px;">Save and Submit</button>

                            {{-- 
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
                            --}}
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
