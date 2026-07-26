document.addEventListener("DOMContentLoaded", () => {
    /*  Password Visibility Toggle */
    const toggleButtons = document.querySelectorAll(".password-toggle-btn");

    toggleButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const targetId = btn.getAttribute("data-toggle-target");
            const input = document.getElementById(targetId);
            const icon = btn.querySelector("i");
            if (!input) return;

            const isHidden = input.type === "password";
            input.type = isHidden ? "text" : "password";
            icon.classList.toggle("bi-eye", !isHidden);
            icon.classList.toggle("bi-eye-slash", isHidden);
            btn.setAttribute(
                "aria-label",
                isHidden ? "Hide password" : "Show password",
            );
        });
    });

    /* Button Ripple Effect (shared with main app) */
    const rippleTargets = document.querySelectorAll(
        ".btn-auth-submit, .btn-social",
    );
    rippleTargets.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            const rect = this.getBoundingClientRect();
            const ripple = document.createElement("span");
            const size = Math.max(rect.width, rect.height);
            const x =
                (e.clientX ?? rect.left + rect.width / 2) -
                rect.left -
                size / 2;
            const y =
                (e.clientY ?? rect.top + rect.height / 2) - rect.top - size / 2;

            ripple.className = "ripple";
            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;

            this.style.position = this.style.position || "relative";
            this.style.overflow = "hidden";
            this.appendChild(ripple);

            window.setTimeout(() => ripple.remove(), 550);
        });
    });

    /* Login Form — visual-only submit feedback */
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", (e) => {
            e.preventDefault();
            // Backend integration (Laravel) hooks in here.
            pulseSubmitButton(document.getElementById("loginSubmitBtn"));
        });
    }

    function pulseSubmitButton(btn) {
        if (!btn) return;
        btn.style.transform = "scale(0.98)";
        window.setTimeout(() => {
            btn.style.transform = "";
        }, 150);
    }

    /* Register Form — password strength meter (visual only) */
    const registerPassword = document.getElementById("registerPassword");
    const strengthBars = document.querySelectorAll(
        "#strengthMeter .strength-bar",
    );
    const strengthLabel = document.getElementById("strengthLabel");

    const strengthConfig = [
        {
            label: "Use 8+ characters with a mix of letters, numbers & symbols",
            color: "var(--color-border)",
        },
        { label: "Weak — add more variety", color: "#EF4444" },
        { label: "Fair — getting there", color: "#F59E0B" },
        { label: "Good — solid password", color: "#3B82F6" },
        { label: "Strong — great password", color: "var(--color-success)" },
    ];

    function scorePassword(value) {
        let score = 0;
        if (value.length >= 8) score++;
        if (/[A-Z]/.test(value) && /[a-z]/.test(value)) score++;
        if (/\d/.test(value)) score++;
        if (/[^A-Za-z0-9]/.test(value)) score++;
        return value.length === 0 ? 0 : Math.max(1, score);
    }

    if (registerPassword && strengthBars.length) {
        registerPassword.addEventListener("input", () => {
            const score = scorePassword(registerPassword.value);
            const state = strengthConfig[score];

            strengthBars.forEach((bar, i) => {
                bar.style.background =
                    i < score ? state.color : "var(--color-border)";
            });
            strengthLabel.textContent = state.label;
            strengthLabel.style.color =
                score === 0 ? "var(--color-text-muted)" : state.color;
        });
    }

    /* Register Form — confirm password match hint (visual only) */
    const confirmPassword = document.getElementById("confirmPassword");
    const confirmHint = document.getElementById("confirmHint");

    function checkPasswordMatch() {
        if (!confirmPassword || !confirmHint || !registerPassword) return;
        if (confirmPassword.value.length === 0) {
            confirmHint.textContent = "";
            confirmHint.className = "field-hint";
            return;
        }
        const matches = confirmPassword.value === registerPassword.value;
        confirmHint.textContent = matches
            ? "Passwords match"
            : "Passwords do not match";
        confirmHint.className = `field-hint ${matches ? "is-valid" : "is-invalid"}`;
    }

    if (confirmPassword) {
        confirmPassword.addEventListener("input", checkPasswordMatch);
        registerPassword?.addEventListener("input", checkPasswordMatch);
    }

    /* Register Form — simple email format hint (visual only) */
    const registerEmail = document.getElementById("registerEmail");
    const emailHint = document.getElementById("emailHint");
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (registerEmail && emailHint) {
        registerEmail.addEventListener("blur", () => {
            if (registerEmail.value.length === 0) {
                emailHint.textContent = "";
                emailHint.className = "field-hint";
                return;
            }
            const valid = emailPattern.test(registerEmail.value);
            emailHint.textContent = valid
                ? "Looks good"
                : "Enter a valid email address";
            emailHint.className = `field-hint ${valid ? "is-valid" : "is-invalid"}`;
        });
    }

    /* Register Form — visual-only submit feedback */
    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", (e) => {
            e.preventDefault();
            // Backend integration (Laravel) hooks in here.
            pulseSubmitButton(document.getElementById("registerSubmitBtn"));
        });
    }
});
