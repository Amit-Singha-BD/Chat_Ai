@extends('Auth.Layout.MasterLayout')
@section('Content')
    <a href="#loginForm" class="skip-link">Skip to form</a>

    <div class="auth-shell">

        <!-- LEFT SHOWCASE PANEL -->
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
                <p class="auth-showcase-quote">Welcome back to <span>the calmest way</span> to work with AI.</p>
                <ul class="auth-feature-list">
                    <li><i class="bi bi-shield-check"></i> Private by default, every conversation encrypted</li>
                    <li><i class="bi bi-lightning-charge"></i> Instant answers across your whole workspace</li>
                    <li><i class="bi bi-layers"></i> Pick up any conversation exactly where you left it</li>
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

        <!-- RIGHT FORM PANEL -->
        <main class="auth-panel mx-auto">

            <div class="auth-panel-mobile-brand">
                <span class="brand-mark">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"
                            fill="url(#brandGradMobile)" />
                        <defs>
                            <linearGradient id="brandGradMobile" x1="2" y1="2" x2="22" y2="22"
                                gradientUnits="userSpaceOnUse">
                                <stop stop-color="#2563EB" />
                                <stop offset="1" stop-color="#7C3AED" />
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
                <span class="brand-name">Aurea</span>
            </div>

            <header class="auth-panel-header">
                <p class="auth-eyebrow">Welcome back</p>
                <h1 class="auth-heading">Log in to your account</h1>
                <p class="auth-subtext">New to Aurea? <a href="register.html">Create an account</a></p>
            </header>

            <!-- Social auth (UI only) -->
            <div class="social-auth-group">
                <button type="button" class="btn-social" aria-label="Continue with Google">
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
                <button type="button" class="btn-social" aria-label="Continue with GitHub">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#111827">
                        <path
                            d="M12 .3a12 12 0 0 0-3.79 23.39c.6.11.82-.26.82-.58v-2.02c-3.34.73-4.04-1.61-4.04-1.61-.55-1.39-1.34-1.76-1.34-1.76-1.09-.75.08-.73.08-.73 1.2.09 1.84 1.24 1.84 1.24 1.07 1.84 2.81 1.3 3.5.99.11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.12-.3-.54-1.53.12-3.18 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 6 0c2.29-1.55 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.8 5.62-5.48 5.92.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58A12 12 0 0 0 12 .3z" />
                    </svg>
                    GitHub
                </button>
            </div>

            <div class="auth-divider">or continue with email</div>

            <!-- Login Form (UI only — no submission logic) -->
            <form class="auth-form" id="loginForm" novalidate>
                <div class="form-group">
                    <label for="loginEmail" class="auth-label">Email address</label>
                    <div class="input-affix">
                        <i class="bi bi-envelope" aria-hidden="true"></i>
                        <input type="email" id="loginEmail" class="auth-input" placeholder="you@company.com"
                            autocomplete="email" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="loginPassword" class="auth-label mb-0">Password</label>
                    </div>
                    <div class="input-affix">
                        <i class="bi bi-lock" aria-hidden="true"></i>
                        <input type="password" id="loginPassword" class="auth-input" placeholder="Enter your password"
                            autocomplete="current-password" required>
                        <button type="button" class="password-toggle-btn" data-toggle-target="loginPassword"
                            aria-label="Show password">
                            <i class="bi bi-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <div class="auth-row-between">
                    <label class="auth-checkbox">
                        <input type="checkbox" id="rememberMe">
                        Remember me
                    </label>
                    <a href="#" class="auth-link-muted">Forgot password?</a>
                </div>

                <button type="submit" class="btn-auth-submit" id="loginSubmitBtn">
                    <span>Log in</span>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="auth-footnote">Protected by industry-standard encryption. By continuing you agree to our <a
                    href="#" class="auth-link-muted">Terms</a> and <a href="#"
                    class="auth-link-muted">Privacy Policy</a>.</p>

        </main>
    </div>
@endsection