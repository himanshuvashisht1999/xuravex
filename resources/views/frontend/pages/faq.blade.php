@extends('layouts.frontend.app')

@section('title', 'Frequently Asked Questions - Xuravex')

@section('content')
<section class="page-header" style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important; padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 15px;">FAQ</h1>
        <p style="font-size: 1.1rem; opacity: 0.8;">Find answers to commonly asked questions about our products and services.</p>
    </div>
</section>

<section style="padding: 80px 0;" x-data="{ activeFaq: null }">
    <div class="container" style="max-width: 900px;">
        <div style="margin-bottom: 50px;">
            <h2 style="color: var(--primary-color); font-size: 2rem; margin-bottom: 20px;">General Questions</h2>
            <div style="display: flex; flex-direction: column; gap: 15px;">
                @php
                    $faqs = [
                        ['q' => 'What are research peptides?', 'a' => 'Research peptides are small chains of amino acids used by scientists in laboratory settings to study various biological processes and potential therapeutic effects.'],
                        ['q' => 'Are your products intended for human consumption?', 'a' => 'No. All products sold on Xuravex are strictly for laboratory research and in-vitro testing only. They are NOT intended for human or animal consumption or diagnostic use.'],
                        ['q' => 'How should I store my peptides?', 'a' => 'For long-term stability, lyophilized (powder) peptides should be stored in a freezer at -20°C. Once reconstituted, they should be stored in a refrigerator at 2-8°C and used within a recommended timeframe.'],
                        ['q' => 'Do you provide COA (Certificate of Analysis)?', 'a' => 'Yes, we provide third-party HPLC and Mass Spec analysis reports for all our peptide batches to ensure the highest purity and quality.'],
                        ['q' => 'What is your shipping policy?', 'a' => 'We offer fast, discreet shipping worldwide. Orders are typically processed within 24-48 hours. Please refer to our Shipping & Returns page for more detailed information.'],
                    ];
                @endphp

                @foreach($faqs as $index => $faq)
                <div style="background: white; border-radius: 15px; border: 1px solid var(--gray-200); overflow: hidden; box-shadow: var(--shadow-sm);">
                    <button @click="activeFaq === {{ $index }} ? activeFaq = null : activeFaq = {{ $index }}" style="width: 100%; padding: 25px; border: none; background: none; display: flex; justify-content: space-between; align-items: center; cursor: pointer; text-align: left;">
                        <span style="font-size: 1.1rem; font-weight: 700; color: var(--primary-color);">{{ $faq['q'] }}</span>
                        <i class="fa-solid" :class="activeFaq === {{ $index }} ? 'fa-minus' : 'fa-plus'" style="color: var(--secondary-color);"></i>
                    </button>
                    <div x-show="activeFaq === {{ $index }}" x-collapse x-transition>
                        <div style="padding: 0 25px 25px; color: var(--gray-600); line-height: 1.6;">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
