@extends('layouts.frontend.app')

@section('title', '5-Amino-1MQ - Xuravex')

@section('content')
    <!-- Page Title -->
    <div class="shop-page-title">
        <div class="container">
            <h1>5-Amino-1MQ</h1>
        </div>
    </div>

    <!-- Product Detail Section -->
    <section class="product-detail-section">
        <div class="container">
            <div class="product-detail-flex">
                <!-- Left: Gallery -->
                <div class="product-gallery">
                    <div class="main-img">
                        <img src="https://via.placeholder.com/400x600?text=BAC+Water" alt="5-Amino-1MQ">
                    </div>
                    <div class="thumb-grid">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="thumb-box">
                            <img src="https://via.placeholder.com/80x120?text=Vial" alt="Thumb">
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Right: Info -->
                <div class="product-info-right">
                    <h1>5-Amino-1MQ</h1>
                    <div class="price-range">$55.00 – $75.00</div>
                    <p class="short-desc">5-Amino-1MQ is a synthetic research compound studied for its ability to inhibit the enzyme nicotinamide N-methyltransferase (NNMT), which plays a regulatory role in metabolic signaling and energy balance.</p>
                    
                    <div class="vial-info"><strong>Vial Size:</strong> 2mL</div>

                    <table class="discount-table">
                        <thead>
                            <tr>
                                <th>Quantity</th>
                                <th>Discounted Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>5-9</td>
                                <td>$50.00</td>
                            </tr>
                            <tr>
                                <td>10+</td>
                                <td>$45.00</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="selector-grid">
                        <div>
                            <label>Size</label>
                            <select>
                                <option>20mg</option>
                                <option>50mg</option>
                            </select>
                        </div>
                        <div>
                            <label>Quantity</label>
                            <select>
                                <option>1 Vial</option>
                                <option>5 Vials</option>
                                <option>10 Vials</option>
                            </select>
                        </div>
                    </div>

                    <div class="total-price-box">
                        <span class="total">$55.00</span>
                        <span class="stock-status"><i class="fa-solid fa-circle-check"></i> In Stock</span>
                    </div>

                    <a href="#" class="btn btn-primary" style="width: 100%; padding: 15px;">Add to Cart</a>
                </div>
            </div>

            <!-- Features Bar (Dark) -->
            @include('frontend.partials.why_choose_bar')

            <!-- Tabs -->
            <div class="product-tabs" x-data="{ tab: 'description' }">
                <div class="tabs-nav">
                    <button class="tab-btn" :class="tab === 'description' ? 'active' : ''" @click="tab = 'description'">Description</button>
                    <button class="tab-btn" :class="tab === 'info' ? 'active' : ''" @click="tab = 'info'">Additional Information</button>
                    <button class="tab-btn" :class="tab === 'reviews' ? 'active' : ''" @click="tab = 'reviews'">Reviews</button>
                    <button class="tab-btn" :class="tab === 'usp' ? 'active' : ''" @click="tab = 'usp'">USP</button>
                </div>
                <div class="tabs-content">
                    <div class="tab-pane" :class="tab === 'description' ? 'active' : ''">
                        <h3>Overview of 5-Amino-1MQ Research Applications</h3>
                        <p>5-Amino-1MQ is a synthetic compound that laboratories use to study enzyme-related metabolic pathways. Research focuses on this compound's role in inhibiting the activity of nicotinamide N-methyltransferase (NNMT). This enzyme helps regulate cellular metabolism by influencing levels of nicotinamide and s-adenosyl-methionine, which are molecules that can influence how cells handle energy and gene expression—effects that can be traced back to their impact on cellular metabolism.</p>
                        <p>In various research settings, scientists actively investigate enzyme inhibition changes metabolic behavior. As a result, laboratories can study cellular responses while keeping high levels of metabolic factors and health parameters.</p>
                    </div>
                    <div class="tab-pane" :class="tab === 'info' ? 'active' : ''">
                        <p>Additional technical specifications and chemical properties go here.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section class="faq-accordion">
        <div class="container">
            <h2 class="text-center">Frequently Asked Questions</h2>
            <div class="accordion-list" x-data="{ active: 1 }">
                <div class="accordion-item" :class="active === 1 ? 'active' : ''">
                    <div class="accordion-header" @click="active = (active === 1 ? 0 : 1)">
                        <span>What is 5-Amino-1MQ and how does it work?</span>
                        <i class="fa-solid" :class="active === 1 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </div>
                    <div class="accordion-content">
                        <p>5-Amino-1MQ is a synthetic small-molecule compound studied for its ability to inhibit the enzyme nicotinamide N-methyltransferase (NNMT), commonly referred to as the NNMT enzyme plays a regulatory role in metabolic signaling and energy balance, and low-level activity in NNMT is linked to improved metabolic health, as this compound works by reducing the enzyme activity to prevent excess adiposity and metabolic dysfunction, research suggests that inhibiting NNMT can increase cellular NAD+ levels, which can enhance mitochondrial efficiency.</p>
                    </div>
                </div>
                <div class="accordion-item" :class="active === 2 ? 'active' : ''">
                    <div class="accordion-header" @click="active = (active === 2 ? 0 : 2)">
                        <span>What is 5-Amino-1MQ used for in research settings?</span>
                        <i class="fa-solid" :class="active === 2 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </div>
                    <div class="accordion-content">
                        <p>Research applications include metabolic studies, enzyme inhibition research, and cellular energy production analysis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Disclaimer Section -->
    <section class="disclaimer-section">
        <div class="container">
            <h3>Research Use Only – Legal Disclaimer</h3>
            <p>The research products sold on this website are strictly for in vitro laboratory research only. They are not intended for human consumption, or diagnostic use, and must be used solely for laboratory experimentation by qualified experts. Xuravex research products are not medications, food items, or cosmetic products, and users must follow all relevant laws and regulations in their respective jurisdictions.</p>
            <p>By purchasing Xuravex research products, you agree that you will follow all safety and security protocols and only use them for legitimate research purposes and only by professionals. Xuravex does not provide medical advice or instructions, and all research findings are for educational purposes. Under no circumstances should products be administered to humans or animals, and molecular therapy research and data are intended for professionals in the field.</p>
        </div>
    </section>
@endsection
