@extends('Auth.Layout.MasterLayout')
@section('Content')
    <a href="#registerForm" class="skip-link">Skip to form</a>

    <div class="auth-shell">

        <!-- ============================= -->
        <!-- LEFT SHOWCASE PANEL            -->
        <!-- ============================= -->
        <section class="auth-showcase d-none d-lg-flex" aria-hidden="true">
            <div class="auth-showcase-brand">
                <span class="brand-mark">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z" fill="white" />
                    </svg>
                </span>
                <span class="brand-name">Aurea</span>
            </div>

            <div class="auth-showcase-content">
                <p class="auth-showcase-quote">Everything you need to <span>think faster</span>, in one clean workspace.</p>
                <ul class="auth-feature-list">
                    <li><i class="bi bi-people"></i> Built for individuals and growing teams alike</li>
                    <li><i class="bi bi-clock-history"></i> Full conversation history, searchable anytime</li>
                    <li><i class="bi bi-stars"></i> Start free — upgrade only when you need to</li>
                </ul>
            </div>

            <div class="auth-showcase-foot">
                <span class="auth-showcase-avatars">
                    <img src="https://i.pravatar.cc/64?img=32" alt="">
                    <img src="https://i.pravatar.cc/64?img=45" alt="">
                    <img src="https://i.pravatar.cc/64?img=12" alt="">
                </span>
                <span>Trusted by 40,000+ teams worldwide</span>
            </div>
        </section>

        <!-- ============================= -->
        <!-- RIGHT FORM PANEL                -->
        <!-- ============================= -->
        <main class="auth-panel mx-auto">

            <div class="auth-panel-mobile-brand">
                <span class="brand-mark">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"
                            fill="url(#brandGradMobile2)" />
                        <defs>
                            <linearGradient id="brandGradMobile2" x1="2" y1="2" x2="22"
                                y2="22" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#2563EB" />
                                <stop offset="1" stop-color="#7C3AED" />
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
                <span class="brand-name">Aurea</span>
            </div>

            <header class="auth-panel-header">
                <p class="auth-eyebrow">Get started</p>
                <h1 class="auth-heading">Create your account</h1>
                <p class="auth-subtext">Already have an account? <a href="login.html">Log in</a></p>
            </header>

            <!-- Social auth (UI only) -->
            <div class="social-auth-group">
                <button type="button" class="btn-social" aria-label="Sign up with Google">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M23.52 12.27c0-.85-.08-1.67-.22-2.45H12v4.64h6.47a5.53 5.53 0 0 1-2.4 3.63v3h3.88c2.27-2.09 3.57-5.17 3.57-8.82z" />
                        <path fill="#34A853"
                            d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3c-1.08.72-2.45 1.15-4.05 1.15-3.11 0-5.75-2.1-6.69-4.93H1.3v3.09A12 12 0 0 0 12 24z" />
                        <path fill="#FBBC05"
                            d="M5.31 14.31A7.2 7.2 0 0 1 4.93 12c0-.8.14-1.58.38-2.31V6.6H1.3A12 12 0 0 0 0 12c0 1.94.46 3.77 1.3 5.4z" />
                        <path fill="#EA4335"
                            d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.44-3.44C17.95 1.19 15.24 0 12 0A12 12 0 0 0 1.3 6.6l4.01 3.09C6.25 6.85 8.89 4.75 12 4.75z" />
                    </svg>
                    Google
                </button>
                <button type="button" class="btn-social" aria-label="Sign up with GitHub">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#111827">
                        <path
                            d="M12 .3a12 12 0 0 0-3.79 23.39c.6.11.82-.26.82-.58v-2.02c-3.34.73-4.04-1.61-4.04-1.61-.55-1.39-1.34-1.76-1.34-1.76-1.09-.75.08-.73.08-.73 1.2.09 1.84 1.24 1.84 1.24 1.07 1.84 2.81 1.3 3.5.99.11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.12-.3-.54-1.53.12-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 6 0c2.29-1.55 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.8 5.62-5.48 5.92.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58A12 12 0 0 0 12 .3z" />
                    </svg>
                    GitHub
                </button>
            </div>

            <div class="auth-divider">or sign up with email</div>

            <!-- Registration Form (UI only — no submission logic) -->
            <form class="auth-form" id="registerForm" novalidate>
                <div class="form-group">
                    <label for="fullName" class="auth-label">Full name</label>
                    <div class="input-affix">
                        <i class="bi bi-person" aria-hidden="true"></i>
                        <input type="text" id="fullName" class="auth-input" placeholder="Amelia Hart"
                            autocomplete="name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="registerEmail" class="auth-label">Email address</label>
                    <div class="input-affix">
                        <i class="bi bi-envelope" aria-hidden="true"></i>
                        <input type="email" id="registerEmail" class="auth-input" placeholder="you@company.com"
                            autocomplete="email" required>
                    </div>
                    <span class="field-hint" id="emailHint"></span>
                </div>

                <div class="form-group">
                    <label for="registerPassword" class="auth-label">Password</label>
                    <div class="input-affix">
                        <i class="bi bi-lock" aria-hidden="true"></i>
                        <input type="password" id="registerPassword" class="auth-input" placeholder="Create a password"
                            autocomplete="new-password" required>
                        <button type="button" class="password-toggle-btn" data-toggle-target="registerPassword"
                            aria-label="Show password">
                            <i class="bi bi-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="password-strength" id="strengthMeter" aria-hidden="true">
                        <span class="strength-bar"></span>
                        <span class="strength-bar"></span>
                        <span class="strength-bar"></span>
                        <span class="strength-bar"></span>
                    </div>
                    <span class="strength-label" id="strengthLabel">Use 8+ characters with a mix of letters, numbers &amp;
                        symbols</span>
                </div>

                <div class="form-group">
                    <label for="confirmPassword" class="auth-label">Confirm password</label>
                    <div class="input-affix">
                        <i class="bi bi-shield-lock" aria-hidden="true"></i>
                        <input type="password" id="confirmPassword" class="auth-input"
                            placeholder="Re-enter your password" autocomplete="new-password" required>
                        <button type="button" class="password-toggle-btn" data-toggle-target="confirmPassword"
                            aria-label="Show password">
                            <i class="bi bi-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    <span class="field-hint" id="confirmHint"></span>
                </div>

                <div class="auth-row-between" style="margin-bottom: 8px;">
                    <label class="auth-checkbox">
                        <input type="checkbox" id="agreeTerms" required>
                        I agree to the <a href="#" class="auth-link-muted">Terms</a> &amp; <a href="#"
                            class="auth-link-muted">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="btn-auth-submit mt-3" id="registerSubmitBtn">
                    <span>Create account</span>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="auth-footnote">Protected by industry-standard encryption. Your data stays private, always.</p>

        </main>
    </div>
@endsection