<!-- Modern Footer -->
<footer class="modern-footer">
    <div class="container">
        <!-- Top Section - Links and GDPR -->
        <div class="container row py-4">
            <!-- Left Section - Links -->
            <div class="col-md-8">
                <div class="footer-links-container">
                    <div class="footer-links-row">
                        <a href="{{ url('/api-docs') }}" class="footer-link">Become a partner</a>
                        <a href="{{ url('/terms-and-conditions#term-of-use') }}" class="footer-link">Term of use</a>
                        <a href="{{ url('/terms-and-conditions#privacy') }}" class="footer-link">Privacy policy</a>
                    </div>
                    <div class="footer-links-row">
                        <a href="{{ url('/blog') }}" class="footer-link">Blog</a>
                        <a href="{{ url('/terms-and-conditions#disclaimers') }}" class="footer-link">Disclaimer</a>
                        <a href="{{ url('/#contact-us') }}" class="footer-link">Contact us</a>
                    </div>
                </div>
            </div>

            <!-- Right Section - GDPR Badge -->
            <div class="col-md-4 text-end">
                <div class="gdpr-badge">
                    <a href="{{ url('/terms-and-conditions#gdpr') }}" class="gdpr-link">
                        <img src="https://mmcertify.com/images/GDPR.png" alt="GDPR Compliant" class="gdpr-logo">
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="container row align-items-center py-3">
            <!-- Copyright -->
            <div class="col-md-4">
                <div class="copyright-text">
                    <i class="far fa-copyright me-2"></i>
                    <span>2025 www.mmcertify.com - All rights reserved</span>
                </div>
            </div>

            <!-- Contact Email -->
            <div class="col-md-4 text-center">
                <div class="contact-email">
                    <i class="fas fa-envelope me-2"></i>
                    <span>support@mmcertify.com</span>
                </div>
            </div>

            <!-- Social Media -->
            <div class="col-md-4 text-end">
                <div class="social-section">
                    <span class="follow-text me-3">Follow us on</span>
                    <a href="https://www.facebook.com/mmcertify" target="_blank" class="social-link facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/mmcertify" target="_blank" class="social-link linkedin">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="searchModalLabel">
                    <i class="fas fa-search me-2"></i>Search Certificate
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="searchForm" method="POST" action="{{ url('/search') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control modern-input" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Number</label>
                        <input type="number" class="form-control modern-input" id="number" name="number" min="0" max="999999" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary modern-btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modern-btn-primary">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.modern-footer {
    background: #4285f4;
    color: white;
    font-family: 'Inter', 'Segoe UI', sans-serif;
    margin-top: auto;
    padding: 30px 0;
}

.modern-footer .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    width: 100%;
}

.footer-links-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.footer-links-row {
    display: flex;
    gap: 80px;
    align-items: center;
}

.footer-link {
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: 400;
    transition: all 0.3s ease;
    opacity: 0.9;
    white-space: nowrap;
    padding: 8px 15px;
    margin: 0 5px;
}

.footer-link:hover {
    color: white;
    opacity: 1;
    text-decoration: underline;
}

.gdpr-badge {
    display: inline-flex;
    align-items: center;
    padding: 0;
}

.gdpr-link {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.gdpr-link:hover {
    opacity: 0.8;
}

.gdpr-logo {
    height: 50px;
    width: auto;
    max-width: 150px;
    object-fit: contain;
}

.copyright-text {
    color: white;
    font-size: 13px;
    display: flex;
    align-items: center;
    opacity: 0.9;
}

.contact-email {
    color: white;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.9;
}

.social-section {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.follow-text {
    color: white;
    font-size: 13px;
    opacity: 0.9;
}

.social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 4px;
    color: white;
    text-decoration: none;
    margin-left: 8px;
    transition: all 0.3s ease;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.2);
}

.social-link.facebook:hover {
    background: rgba(255, 255, 255, 0.3);
}

.social-link.linkedin:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Modal Styles */
.modern-modal {
    border-radius: 16px;
    border: none;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.modern-modal .modal-header {
    background: linear-gradient(135deg, #4285f4, #3367d6);
    color: white;
    border-radius: 16px 16px 0 0;
    padding: 20px 24px;
}

.modern-modal .modal-title {
    font-weight: 600;
    font-size: 18px;
}

.modern-modal .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.modern-modal .btn-close:hover {
    opacity: 1;
}

.modern-input {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.modern-input:focus {
    border-color: #4285f4;
    box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
}

.modern-btn-primary {
    background: linear-gradient(135deg, #4285f4, #3367d6);
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.modern-btn-primary:hover {
    background: linear-gradient(135deg, #3367d6, #2d5aa0);
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(66, 133, 244, 0.4);
}

.modern-btn-secondary {
    background: #6c757d;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    color: white;
    transition: all 0.3s ease;
}

.modern-btn-secondary:hover {
    background: #5a6268;
    color: white;
    transform: translateY(-1px);
}

/* Responsive Design */
@media (max-width: 992px) {
    .footer-links-row {
        gap: 50px;
    }
}

@media (max-width: 768px) {
    .modern-footer .container {
        padding: 0 15px;
    }
    
    .footer-links-row {
        flex-direction: column;
        gap: 12px;
        text-align: center;
    }
    
    .footer-link {
        padding: 4px 8px;
        margin: 0 2px;
    }
    
    .modern-footer .col-md-4,
    .modern-footer .col-md-8 {
        text-align: center !important;
        margin-bottom: 25px;
    }
    
    .gdpr-badge {
        justify-content: center;
        margin: 0 auto;
    }
    
    .social-section {
        justify-content: center;
    }
    
    .follow-text {
        display: block;
        margin-bottom: 10px;
    }
    
    .copyright-text,
    .contact-email {
        justify-content: center;
    }
    
    .footer-links-container {
        text-align: center;
    }
}

@media (max-width: 480px) {
    .footer-links-row {
        gap: 8px;
    }
    
    .footer-link {
        padding: 3px 5px;
        margin: 0 1px;
        font-size: 13px;
    }
    
    .modern-footer {
        padding: 25px 0;
    }
}
</style>