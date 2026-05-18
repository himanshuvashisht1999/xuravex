@extends('layouts.frontend.app')

@section('title', 'Contact Us - Xuravex')

@section('content')
<section class="page-header" style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important; padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 15px;">Get In Touch</h1>
        <p style="font-size: 1.1rem; opacity: 0.8;">Have questions? Our team of experts is here to help.</p>
    </div>
</section>

<section style="padding: 80px 0;"class="contact-page">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 60px;">
            <div>
                <h2 style="color: var(--primary-color); font-size: 2rem; margin-bottom: 30px;">Contact Information</h2>
                
                <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                    <div style="width: 50px; height: 50px; background: rgba(193, 139, 57, 0.1); color: var(--secondary-color); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1.2rem;">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 5px;">Our Location</h4>
                        <p style="color: var(--gray-600); font-size: 0.95rem; line-height: 1.5;">{{ $gs['site_address'] ?? '123 Science Park Drive, Research Triangle, North Carolina, USA' }}</p>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                    <div style="width: 50px; height: 50px; background: rgba(193, 139, 57, 0.1); color: var(--secondary-color); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1.2rem;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 5px;">Phone Number</h4>
                        <p style="color: var(--gray-600); font-size: 0.95rem;">{{ $gs['site_phone'] ?? '+1 (800) 123-4567' }}</p>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                    <div style="width: 50px; height: 50px; background: rgba(193, 139, 57, 0.1); color: var(--secondary-color); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1.2rem;">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 5px;">Email Address</h4>
                        <p style="color: var(--gray-600); font-size: 0.95rem;">{{ $gs['site_email'] ?? 'support@xuravex.com' }}</p>
                    </div>
                </div>

                <div style="margin-top: 50px;">
                    <h4 style="margin-bottom: 20px;">Follow Us</h4>
                    <div style="display: flex; gap: 15px;">
                        @if(isset($gs['social_facebook']))
                            <a href="{{ $gs['social_facebook'] }}" target="_blank" style="width: 40px; height: 40px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-facebook-f"></i></a>
                        @endif
                        @if(isset($gs['social_twitter']))
                            <a href="{{ $gs['social_twitter'] }}" target="_blank" style="width: 40px; height: 40px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-twitter"></i></a>
                        @endif
                        @if(isset($gs['social_linkedin']))
                            <a href="{{ $gs['social_linkedin'] }}" target="_blank" style="width: 40px; height: 40px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-linkedin-in"></i></a>
                        @endif
                        @if(isset($gs['social_instagram']))
                            <a href="{{ $gs['social_instagram'] }}" target="_blank" style="width: 40px; height: 40px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <div style="background: white; padding: 50px; border-radius: 30px; box-shadow: var(--shadow-lg);">
                <h3 style="font-size: 1.8rem; margin-bottom: 30px;">Send Us a Message</h3>

                @if(session('success'))
                    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 25px; border: 1px solid #c3e6cb;">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" style="width: 100%; padding: 12px 15px; border: 1px solid var(--gray-200); border-radius: 10px; outline: none;" required>
                            @error('name') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" style="width: 100%; padding: 12px 15px; border: 1px solid var(--gray-200); border-radius: 10px; outline: none;" required>
                            @error('email') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="How can we help?" style="width: 100%; padding: 12px 15px; border: 1px solid var(--gray-200); border-radius: 10px; outline: none;">
                        @error('subject') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Message *</label>
                        <textarea name="message" rows="5" placeholder="Write your message here..." style="width: 100%; padding: 12px 15px; border: 1px solid var(--gray-200); border-radius: 10px; outline: none; resize: none;" required>{{ old('message') }}</textarea>
                        @error('message') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="display: flex; gap: 10px; align-items: flex-start; cursor: pointer; font-size: 0.9rem; color: var(--gray-600);">
                            <input type="checkbox" name="consent" value="1" required style="margin-top: 4px;">
                            <span>I agree to the <a href="{{ route('terms') }}" target="_blank" style="color: var(--secondary-color);">Terms & Conditions</a> and <a href="{{ route('privacy') }}" target="_blank" style="color: var(--secondary-color);">Privacy Policy</a>. I understand that these products are for research purposes only.</span>
                        </label>
                        @error('consent') <span style="color: #ff4d4d; font-size: 12px;">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-weight: 700;">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
