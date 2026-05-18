@extends('layouts.frontend.app')

@section('title', 'About Us - Xuravex')

@section('content')
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1532187875605-2fe358a3d46a?auto=format&fit=crop&q=80&w=2000'); background-size: cover; background-position: center; padding: 100px 0; color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; font-weight: 800; margin-bottom: 20px;">Advancing Scientific Discovery</h1>
        <p style="font-size: 1.2rem; max-width: 700px; margin: 0 auto; opacity: 0.9;">Xuravex is a leading provider of high-quality research peptides and laboratory supplies, dedicated to supporting researchers worldwide.</p>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div>
                <h2 style="color: var(--primary-color); font-size: 2.5rem; margin-bottom: 25px;">Our Mission</h2>
                <p style="color: var(--gray-700); line-height: 1.8; margin-bottom: 20px;">At Xuravex, our mission is to empower the scientific community by providing access to ultra-pure research materials and cutting-edge laboratory solutions. We understand that the integrity of your research depends on the quality of your supplies.</p>
                <p style="color: var(--gray-700); line-height: 1.8;">Every product in our catalog undergoes rigorous quality control and third-party testing to ensure it meets the highest standards of purity and potency. We are committed to transparency, reliability, and excellence in everything we do.</p>
            </div>
            <div style="position: relative;">
                <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&q=80&w=800" alt="Laboratory" style="width: 100%; border-radius: 20px; box-shadow: var(--shadow-lg);">
                <div style="position: absolute; -bottom: 30px; -left: 30px; background: var(--secondary-color); color: white; padding: 30px; border-radius: 15px; box-shadow: var(--shadow-md);">
                    <h3 style="font-size: 2rem; margin-bottom: 5px;">99.9%</h3>
                    <p style="margin: 0; font-size: 0.9rem; opacity: 0.9;">Purity Guaranteed</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--gray-100); padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="color: var(--primary-color); font-size: 2.5rem;">Why Choose Xuravex?</h2>
            <div style="width: 80px; height: 3px; background: var(--secondary-color); margin: 20px auto;"></div>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <div style="background: white; padding: 40px; border-radius: 20px; text-align: center; box-shadow: var(--shadow-sm); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 70px; height: 70px; background: rgba(193, 139, 57, 0.1); color: var(--secondary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 1.8rem;">
                    <i class="fa-solid fa-microscope"></i>
                </div>
                <h3 style="margin-bottom: 15px;">Purity & Quality</h3>
                <p style="color: var(--gray-600); font-size: 0.95rem;">All our peptides are manufactured to exceed 99% purity standards, verified by HPLC and MS analysis.</p>
            </div>
            
            <div style="background: white; padding: 40px; border-radius: 20px; text-align: center; box-shadow: var(--shadow-sm); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 70px; height: 70px; background: rgba(193, 139, 57, 0.1); color: var(--secondary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 1.8rem;">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <h3 style="margin-bottom: 15px;">Fast Shipping</h3>
                <p style="color: var(--gray-600); font-size: 0.95rem;">Discreet and fast shipping worldwide, with temperature-controlled packaging where necessary.</p>
            </div>
            
            <div style="background: white; padding: 40px; border-radius: 20px; text-align: center; box-shadow: var(--shadow-sm); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 70px; height: 70px; background: rgba(193, 139, 57, 0.1); color: var(--secondary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 1.8rem;">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 style="margin-bottom: 15px;">Expert Support</h3>
                <p style="color: var(--gray-600); font-size: 0.95rem;">Our team of specialists is available to answer your technical questions and support your research.</p>
            </div>
        </div>
    </div>
</section>
@endsection
