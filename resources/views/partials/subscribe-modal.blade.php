{{-- LuxLight eNewsletter Subscribe Modal (matches original #pum-11677 popup) --}}
<div id="pum-11677" class="pum pum-overlay lux-subscribe-overlay" role="dialog" aria-modal="true" aria-labelledby="pum_popup_title_11677" style="display:none;">
    <div class="lux-subscribe-container" id="popmake-11677">
        <button type="button" class="lux-subscribe-close" aria-label="Close" onclick="closeSubscribeModal()">&#x2715;</button>
        
        <div class="lux-subscribe-title" id="pum_popup_title_11677">
            Sign Up for eNewsletter Now!
        </div>

        <div class="lux-subscribe-body" id="subscribe-form-wrapper">
            <form id="lux-subscribe-form" method="POST" action="{{ route('newsletter.subscribe') }}" onsubmit="handleSubscribeSubmit(event)">
                @csrf
                <div class="lux-form-group">
                    <input type="text" name="first_name" id="sub_first_name" placeholder="First Name*" required class="lux-input">
                </div>

                <div class="lux-form-group">
                    <input type="text" name="last_name" id="sub_last_name" placeholder="Last Name*" required class="lux-input">
                </div>

                <div class="lux-form-group">
                    <input type="email" name="email" id="sub_email" placeholder="Email*" required class="lux-input">
                </div>

                <div class="lux-form-group">
                    <input type="text" name="company" id="sub_company" placeholder="Company*" class="lux-input">
                </div>

                <div class="lux-form-group lux-select-group">
                    <select name="referral" id="sub_referral" class="lux-select">
                        <option value="">Where do you know us?</option>
                        <option value="Search Engine">Search Engine</option>
                        <option value="Social Media">Social Media</option>
                        <option value="Referral">Referral</option>
                        <option value="Event / Exhibition">Event / Exhibition</option>
                        <option value="Other">Other</option>
                    </select>
                    <span class="lux-select-arrow">&#x25BE;</span>
                </div>

                <div class="lux-checkbox-group">
                    <label class="lux-checkbox-label">
                        <input type="checkbox" name="agree" id="sub_agree" value="1" required class="lux-checkbox">
                        <span class="lux-checkbox-text">I would like to subscribe to updates from LuxLight.</span>
                    </label>
                </div>

                <div id="subscribe-msg" class="lux-form-feedback" style="display:none;"></div>

                <div class="lux-form-footer">
                    <button type="submit" id="lux-subscribe-btn" class="lux-submit-btn">Submit Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Subscribe Modal Scoped Styling */
.lux-subscribe-overlay {
    position: fixed !important;
    inset: 0 !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    background-color: rgba(0, 0, 0, 0.65) !important;
    z-index: 2147483647 !important;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 16px;
    box-sizing: border-box;
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
}

.lux-subscribe-overlay.active {
    display: flex !important;
    animation: luxFadeIn 0.25s ease-out forwards;
}

@keyframes luxFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.lux-subscribe-container {
    position: relative !important;
    background: #ffffff !important;
    width: 100% !important;
    max-width: 520px !important;
    border-radius: 4px !important;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3) !important;
    padding: 40px 38px 36px 38px !important;
    box-sizing: border-box !important;
    border: none !important;
    margin: auto !important;
    transform: scale(0.96);
    animation: luxPopIn 0.25s ease-out forwards;
}

@keyframes luxPopIn {
    from { transform: scale(0.94); }
    to { transform: scale(1); }
}

.lux-subscribe-close {
    position: absolute !important;
    top: 14px !important;
    right: 18px !important;
    background: transparent !important;
    border: none !important;
    outline: none !important;
    font-size: 26px !important;
    line-height: 1 !important;
    color: #111111 !important;
    cursor: pointer !important;
    padding: 4px 8px !important;
    font-weight: 300 !important;
    transition: transform 0.15s ease, color 0.15s ease !important;
    z-index: 10 !important;
}

.lux-subscribe-close:hover {
    color: #AB9A71 !important;
    transform: scale(1.1);
}

.lux-subscribe-title {
    font-family: "ACaslonPro", Garamond, "Times New Roman", serif !important;
    color: #AB9A71 !important;
    font-size: 28px !important;
    font-weight: 400 !important;
    line-height: 1.25 !important;
    margin: 0 0 24px 0 !important;
    padding-right: 30px !important;
    text-align: left !important;
    letter-spacing: -0.2px !important;
}

.lux-form-group {
    position: relative !important;
    margin-bottom: 20px !important;
    width: 100% !important;
}

.lux-input {
    width: 100% !important;
    border: none !important;
    border-bottom: 1px solid #d4d4d4 !important;
    border-radius: 0 !important;
    padding: 10px 0 !important;
    font-family: "Din", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    font-size: 15px !important;
    color: #222222 !important;
    background: transparent !important;
    outline: none !important;
    box-sizing: border-box !important;
    transition: border-color 0.2s ease !important;
}

.lux-input::placeholder {
    color: #767676 !important;
    opacity: 1 !important;
    font-weight: 400 !important;
}

.lux-input:focus {
    border-bottom: 1.5px solid #AB9A71 !important;
}

.lux-select-group {
    position: relative !important;
}

.lux-select {
    width: 100% !important;
    border: none !important;
    border-bottom: 1px solid #d4d4d4 !important;
    border-radius: 0 !important;
    padding: 10px 24px 10px 0 !important;
    font-family: "Din", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    font-size: 15px !important;
    color: #767676 !important;
    background: transparent !important;
    outline: none !important;
    cursor: pointer !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    box-sizing: border-box !important;
    transition: border-color 0.2s ease !important;
}

.lux-select:focus {
    border-bottom: 1.5px solid #AB9A71 !important;
    color: #222222 !important;
}

.lux-select option {
    color: #222222 !important;
    background: #ffffff !important;
}

.lux-select-arrow {
    position: absolute !important;
    right: 4px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    font-size: 16px !important;
    color: #222222 !important;
    pointer-events: none !important;
}

.lux-checkbox-group {
    margin: 22px 0 24px 0 !important;
    text-align: left !important;
}

.lux-checkbox-label {
    display: flex !important;
    align-items: flex-start !important;
    cursor: pointer !important;
    user-select: none !important;
}

.lux-checkbox {
    margin: 3px 10px 0 0 !important;
    cursor: pointer !important;
    width: 16px !important;
    height: 16px !important;
    accent-color: #0B1523 !important;
    flex-shrink: 0 !important;
}

.lux-checkbox-text {
    font-family: "Din", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    font-size: 14px !important;
    color: #333333 !important;
    line-height: 1.4 !important;
}

.lux-form-footer {
    text-align: left !important;
    margin-top: 8px !important;
}

.lux-submit-btn {
    display: inline-block !important;
    background-color: #000000 !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 0 !important;
    padding: 13px 34px !important;
    font-family: "Din", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    letter-spacing: 0.3px !important;
    cursor: pointer !important;
    transition: background-color 0.25s ease, transform 0.15s ease !important;
    text-align: center !important;
}

.lux-submit-btn:hover {
    background-color: #AB9A71 !important;
}

.lux-submit-btn:active {
    transform: scale(0.98);
}

.lux-form-feedback {
    font-family: "Din", sans-serif !important;
    font-size: 14px !important;
    margin: 12px 0 !important;
    padding: 10px 14px !important;
    border-radius: 3px !important;
    text-align: left !important;
}

.lux-form-feedback.success {
    background-color: #f0f8f0 !important;
    color: #2e7d32 !important;
    border: 1px solid #c8e6c9 !important;
}

.lux-form-feedback.error {
    background-color: #fef2f2 !important;
    color: #d32f2f !important;
    border: 1px solid #ffcdd2 !important;
}

@media (max-width: 600px) {
    .lux-subscribe-container {
        padding: 30px 22px 26px 22px !important;
    }
    .lux-subscribe-title {
        font-size: 23px !important;
    }
    .lux-submit-btn {
        width: 100% !important;
    }
}
</style>

<script>
function openSubscribeModal(e) {
    if (e && e.preventDefault) e.preventDefault();
    var modal = document.getElementById('pum-11677');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        var firstInput = document.getElementById('sub_first_name');
        if (firstInput) setTimeout(function() { firstInput.focus(); }, 100);
    }
}

function closeSubscribeModal() {
    var modal = document.getElementById('pum-11677');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function handleSubscribeSubmit(e) {
    e.preventDefault();
    var form = document.getElementById('lux-subscribe-form');
    var btn = document.getElementById('lux-subscribe-btn');
    var msg = document.getElementById('subscribe-msg');
    
    if (!form) return;
    
    btn.disabled = true;
    var origText = btn.innerText;
    btn.innerText = 'Submitting...';
    
    var formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(function(res) {
        return res.json().then(function(data) {
            return { ok: res.ok, data: data };
        });
    })
    .then(function(result) {
        btn.disabled = false;
        btn.innerText = origText;
        if (result.ok && result.data.success) {
            msg.className = 'lux-form-feedback success';
            msg.style.display = 'block';
            msg.innerText = result.data.message || 'Thank you for subscribing to LuxLight updates!';
            form.reset();
            setTimeout(function() {
                closeSubscribeModal();
                msg.style.display = 'none';
            }, 3000);
        } else {
            msg.className = 'lux-form-feedback error';
            msg.style.display = 'block';
            msg.innerText = result.data.message || 'Please verify the submitted details.';
        }
    })
    .catch(function(err) {
        btn.disabled = false;
        btn.innerText = origText;
        msg.className = 'lux-form-feedback error';
        msg.style.display = 'block';
        msg.innerText = 'An error occurred. Please try again later.';
    });
}

// Global click delegation for Subscribe triggers
document.addEventListener('DOMContentLoaded', function() {
    // Backdrop click to close
    var overlay = document.getElementById('pum-11677');
    if (overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeSubscribeModal();
            }
        });
    }

    // Escape key to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSubscribeModal();
        }
    });

    // Delegate click to any subscribe button or trigger
    document.addEventListener('click', function(e) {
        var trigger = e.target.closest('.popmake-11677, [data-open-subscribe], a[href="#subscribe"], a[href="#popmake-11677"]');
        if (!trigger) {
            // Also check if clicked button text is Subscribe
            var btn = e.target.closest('.elementor-widget-button a, .elementor-button');
            if (btn && btn.textContent && btn.textContent.trim().toLowerCase() === 'subscribe') {
                trigger = btn;
            }
        }
        if (trigger) {
            e.preventDefault();
            openSubscribeModal();
        }
    });

    // Update select color on change
    var sel = document.getElementById('sub_referral');
    if (sel) {
        sel.addEventListener('change', function() {
            if (this.value) {
                this.style.color = '#222222';
            } else {
                this.style.color = '#767676';
            }
        });
    }
});
</script>
