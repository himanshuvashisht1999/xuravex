@extends('layouts.frontend.app')

@section('title', 'About Us - Xuravex')

@section('content')
<section class="page-header" style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important; padding: 100px 0; color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; font-weight: 800; margin-bottom: 20px;">About Us</h1>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container" style="max-width: 1000px;">
        
        <div style="background: #f8d7da; color: #721c24; padding: 20px; border-radius: 5px; margin-bottom: 40px; border: 1px solid #f5c6cb; text-align: center;">
            <strong>FOR RESEARCH USE ONLY<br>
            NOT FOR HUMAN OR ANIMAL CONSUMPTION</strong><br>
            All Xuravex products are sold exclusively for lawful, non clinical research purposes.
        </div>

        <div style="background: white; padding: 40px; border-radius: 10px; border: 1px solid #c18b39; line-height: 1.8; color: var(--gray-700);">
            
            <div style="margin-bottom: 40px;">
                <h2 style="color: var(--primary-color); margin-bottom: 20px; font-size: 2rem;">Who We Are</h2>
                <p style="margin-bottom: 15px;">Xuravex LLC is a Wyoming based company specializing in the distribution of high purity, research grade peptides sold exclusively for research use only (RUO). We operate under a rigorous framework of quality assurance, third party laboratory verification, and strict regulatory compliance, serving researchers, biotechnology companies, and institutional buyers who require reliable, fully documented research compounds.</p>
                <p>Founded on a commitment to transparency and scientific integrity, Xuravex was established to raise the standard of what responsible RUO peptide distribution looks like, combining the traceability expectations of the pharmaceutical supply chain with the agility of a specialized research supply operation.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h2 style="color: var(--primary-color); margin-bottom: 20px; font-size: 2rem;">What We Do</h2>
                <p style="margin-bottom: 15px;">We source, qualify, and distribute research grade peptides for research use only. Every product we carry is subject to our multi layer supplier qualification protocol, which includes:</p>
                <ul style="list-style-type: disc; margin-left: 20px; margin-bottom: 15px;">
                    <li>Third party analytical testing via ISO 17025 accredited laboratories</li>
                    <li>HPLC purity analysis with full chromatogram documentation</li>
                    <li>Mass spectrometry confirmation of molecular identity</li>
                    <li>Certificate of Analysis (COA) review and archiving for every lot</li>
                    <li>Supplier verification through registered company credentials and quality management documentation</li>
                </ul>
                <p>Our catalog includes peptide compounds spanning multiple molecular classes and structural families, supplied exclusively for in vitro research and non clinical laboratory use. All compounds are characterized by their chemical and molecular properties and are supplied with full analytical documentation.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h2 style="color: var(--primary-color); margin-bottom: 20px; font-size: 2rem;">Our Standards</h2>
                <p style="margin-bottom: 15px;">Xuravex operates within a compliance first culture. We partner exclusively with manufacturers who can demonstrate verifiable quality infrastructure, and we decline to work with any supplier whose documentation does not meet our standards regardless of price. Our internal vetting process has screened and excluded multiple suppliers who could not substantiate the integrity of their materials.</p>
                <p>We believe the research community deserves better than opaque sourcing, unverified purity claims, and inconsistent lot quality. Our goal is to be the supplier that researchers and procurement teams trust when those standards matter.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h2 style="color: var(--primary-color); margin-bottom: 20px; font-size: 2rem;">Who We Serve</h2>
                <p style="margin-bottom: 15px;">Xuravex primarily serves the research and scientific community. Our customers include:</p>
                <ul style="list-style-type: disc; margin-left: 20px; margin-bottom: 15px;">
                    <li>Independent research laboratories</li>
                    <li>Biotechnology and life science companies</li>
                    <li>Academic and institutional research programs</li>
                    <li>Organizations and individuals engaged in lawful peptide research and development</li>
                </ul>
                <p>All purchasers must agree that products will be used solely for lawful research purposes and will not be used for human or animal consumption, self administration, or any non research application. By completing a purchase, you accept these conditions in full.</p>
            </div>

            <div style="margin-bottom: 20px;">
                <h2 style="color: var(--primary-color); margin-bottom: 20px; font-size: 2rem;">Our Commitment</h2>
                <p style="margin-bottom: 15px;">Research depends on reliable materials. Xuravex exists to provide exactly that, consistent quality, full documentation, and a sourcing partner you can trust to stand behind every lot it distributes.</p>
                <p>Contact us through the form below and a member of our team will be in touch.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top: 10px;">Contact Us</a>
            </div>

        </div>
    </div>
</section>
@endsection
