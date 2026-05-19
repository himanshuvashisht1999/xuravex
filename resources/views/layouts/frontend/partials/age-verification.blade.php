<div id="age-verification-overlay" class="age-gate-overlay" style="display: none;">
    <div class="age-gate-modal">
        <button class="age-gate-close" onclick="handleAgeDecline()">&times;</button>
        <div class="age-gate-header">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="age-gate-icon">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
        </div>
        <div class="age-gate-body">
            <h2>Age Verification</h2>
            <p class="age-gate-text-primary">You must be 21 years of age or older to enter this site.</p>
            <p class="age-gate-text-secondary">By entering this website, you confirm that you are at least 21 years old and understand that the products offered are for research purposes only.</p>
            
            <div class="age-gate-buttons">
                <button class="btn-age-confirm" onclick="handleAgeConfirm()">YES</button>
                <button class="btn-age-decline" onclick="handleAgeDecline()">NO</button>
            </div>
        </div>
    </div>
</div>

<style>
.age-gate-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    z-index: 999999;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.age-gate-modal {
    background: #F4F5F6;
    width: 100%;
    max-width: 480px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    position: relative;
    animation: ageGateFadeIn 0.4s ease-out;
}

.age-gate-close {
    position: absolute;
    top: 15px;
    right: 20px;
    background: none;
    border: none;
    font-size: 28px;
    color: rgba(255, 255, 255, 0.8);
    cursor: pointer;
    z-index: 10;
    transition: color 0.2s;
    line-height: 1;
}

.age-gate-close:hover {
    color: #ffffff;
}

.age-gate-header {
    background: #E85A4F;
    padding: 35px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.age-gate-icon {
    width: 70px;
    height: 70px;
    color: #ffffff;
}

.age-gate-body {
    padding: 35px 40px;
    text-align: center;
}

.age-gate-body h2 {
    font-size: 26px;
    font-weight: 700;
    color: #333333;
    margin: 0 0 15px 0;
    font-family: inherit;
}

.age-gate-text-primary {
    font-size: 16px;
    font-weight: 600;
    color: #444444;
    margin: 0 0 12px 0;
    line-height: 1.4;
}

.age-gate-text-secondary {
    font-size: 13.5px;
    color: #777777;
    margin: 0 0 25px 0;
    line-height: 1.6;
}

.age-gate-buttons {
    display: flex;
    gap: 15px;
}

.btn-age-confirm,
.btn-age-decline {
    flex: 1;
    border: none;
    border-radius: 25px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-age-confirm {
    background: #24B1C1;
    color: #ffffff;
}

.btn-age-confirm:hover {
    background: #1C9BAA;
    transform: translateY(-1px);
}

.btn-age-decline {
    background: #24B1C1;
    color: #ffffff;
}

.btn-age-decline:hover {
    background: #1C9BAA;
    transform: translateY(-1px);
}

@keyframes ageGateFadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

<script>
(function() {
    var overlay = document.getElementById('age-verification-overlay');
    if (!localStorage.getItem('age_verified')) {
        overlay.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
})();

function handleAgeConfirm() {
    localStorage.setItem('age_verified', 'true');
    var overlay = document.getElementById('age-verification-overlay');
    overlay.style.opacity = '0';
    overlay.style.transition = 'opacity 0.3s ease';
    setTimeout(function() {
        overlay.style.display = 'none';
        document.body.style.overflow = '';
    }, 300);
}

function handleAgeDecline() {
    window.location.href = 'https://www.google.com';
}
</script>
