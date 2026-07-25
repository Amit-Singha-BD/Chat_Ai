document.getElementById("year").textContent = new Date().getFullYear();

/* ---------- Mobile nav ---------- */
const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");
navToggle.addEventListener("click", () => {
    const open = navMenu.classList.toggle("is-open");
    navToggle.classList.toggle("is-active", open);
    navToggle.setAttribute("aria-expanded", open ? "true" : "false");
});
navMenu.querySelectorAll("a").forEach((a) =>
    a.addEventListener("click", () => {
        navMenu.classList.remove("is-open");
        navToggle.classList.remove("is-active");
        navToggle.setAttribute("aria-expanded", "false");
    }),
);

/* ---------- Active nav link on scroll ---------- */
const navLinks = navMenu.querySelectorAll("a");
const navSections = document.querySelectorAll("section[id]");
const navObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                navLinks.forEach((l) =>
                    l.classList.toggle(
                        "is-active",
                        l.getAttribute("href") === "#" + entry.target.id,
                    ),
                );
            }
        });
    },
    { rootMargin: "-45% 0px -45% 0px" },
);
navSections.forEach((s) => navObserver.observe(s));

/* ---------- Scroll reveal ---------- */
const revealItems = document.querySelectorAll(".reveal");
revealItems.forEach((item) => {
    const siblings = Array.from(item.parentElement.children).filter((c) =>
        c.classList.contains("reveal"),
    );
    const idx = siblings.indexOf(item);
    if (idx > 0) item.style.transitionDelay = Math.min(idx * 0.1, 0.5) + "s";
});
const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                revealObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.12, rootMargin: "0px 0px -40px 0px" },
);
revealItems.forEach((item) => revealObserver.observe(item));

/* ---------- Skill bars ---------- */
const skillsSection = document.getElementById("skills");
let skillsAnimated = false;
const skillObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting && !skillsAnimated) {
                skillsAnimated = true;
                document.querySelectorAll(".skill-fill").forEach((fill) => {
                    fill.style.width = fill.getAttribute("data-val") + "%";
                });
                document.querySelectorAll(".skill-val").forEach((val) => {
                    const target = parseInt(val.getAttribute("data-val"), 10);
                    let cur = 0;
                    const step = Math.max(1, Math.round(target / 40));
                    const interval = setInterval(() => {
                        cur += step;
                        if (cur >= target) {
                            cur = target;
                            clearInterval(interval);
                        }
                        val.textContent = cur + "%";
                    }, 25);
                });
            }
        });
    },
    { threshold: 0.3 },
);
skillObserver.observe(skillsSection);

/* ---------- Carousels (Services + Projects) ---------- */
document.querySelectorAll("[data-carousel]").forEach((carousel) => {
    const viewport = carousel.querySelector(".carousel-viewport");
    const track = carousel.querySelector(".carousel-track");
    const slides = Array.from(track.children);
    const prevBtn = carousel.querySelector("[data-carousel-prev]");
    const nextBtn = carousel.querySelector("[data-carousel-next]");
    let index = 0;

    function metrics() {
        const slideWidth = slides[0].getBoundingClientRect().width || 1;
        const perView = Math.max(
            1,
            Math.round(viewport.clientWidth / slideWidth),
        );
        const maxIndex = Math.max(0, slides.length - perView);
        return { slideWidth, maxIndex };
    }

    function render() {
        const { slideWidth, maxIndex } = metrics();
        index = Math.min(index, maxIndex);
        track.style.transform = "translateX(-" + index * slideWidth + "px)";
        prevBtn.classList.toggle("is-disabled", index <= 0);
        nextBtn.classList.toggle("is-disabled", index >= maxIndex);
    }

    prevBtn.addEventListener("click", () => {
        index = Math.max(0, index - 1);
        render();
    });
    nextBtn.addEventListener("click", () => {
        const { maxIndex } = metrics();
        index = Math.min(maxIndex, index + 1);
        render();
    });

    window.addEventListener("resize", render);
    render();
});

/* ---------- Modals ---------- */
function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.add("is-open");
    document.body.classList.add("modal-lock");
}
function closeModal(modal) {
    modal.classList.remove("is-open");
    document.body.classList.remove("modal-lock");
}
document.querySelectorAll("[data-modal-open]").forEach((btn) => {
    btn.addEventListener("click", () =>
        openModal(btn.getAttribute("data-modal-open")),
    );
});
document
    .querySelectorAll('[role="button"][data-modal-open]')
    .forEach((card) => {
        card.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                openModal(card.getAttribute("data-modal-open"));
            }
        });
    });
document.querySelectorAll(".modal").forEach((modal) => {
    modal.addEventListener("click", (e) => {
        if (e.target === modal) closeModal(modal);
    });
    modal
        .querySelector(".modal-close")
        ?.addEventListener("click", () => closeModal(modal));
});
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape")
        document
            .querySelectorAll(".modal.is-open")
            .forEach((m) => closeModal(m));
});

/* ---------- Ambient network-grid background ---------- */
(function () {
    const canvas = document.getElementById("bgCanvas");
    const ctx = canvas.getContext("2d");
    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
    ).matches;
    let w, h, cols, rows;
    const gap = 86;
    let packets = [];

    function makePacket() {
        const horizontal = Math.random() < 0.5;
        const lineIndex = horizontal
            ? Math.floor(Math.random() * (rows + 1))
            : Math.floor(Math.random() * (cols + 1));
        const dir = Math.random() < 0.5 ? 1 : -1;
        const speed = 0.5 + Math.random() * 0.9;
        const color = Math.random() < 0.5 ? "52,215,192" : "245,169,63";
        const span = horizontal ? w : h;
        const pos = dir > 0 ? -gap : span + gap;
        return { horizontal, lineIndex, dir, speed, color, pos };
    }

    function initPackets() {
        packets = [];
        const count = Math.min(16, Math.max(6, Math.floor((cols * rows) / 16)));
        for (let i = 0; i < count; i++) packets.push(makePacket());
    }

    function resize() {
        w = canvas.width = window.innerWidth;
        h = canvas.height = window.innerHeight;
        cols = Math.ceil(w / gap);
        rows = Math.ceil(h / gap);
        initPackets();
    }

    function drawGrid() {
        ctx.fillStyle = "rgba(255,255,255,0.045)";
        for (let x = 0; x <= cols; x++) {
            for (let y = 0; y <= rows; y++) {
                ctx.beginPath();
                ctx.arc(x * gap, y * gap, 1.3, 0, Math.PI * 2);
                ctx.fill();
            }
        }
    }

    function drawPackets() {
        packets.forEach((p) => {
            const x = p.horizontal ? p.pos : p.lineIndex * gap;
            const y = p.horizontal ? p.lineIndex * gap : p.pos;
            const grad = ctx.createRadialGradient(x, y, 0, x, y, 11);
            grad.addColorStop(0, "rgba(" + p.color + ",0.85)");
            grad.addColorStop(1, "rgba(" + p.color + ",0)");
            ctx.fillStyle = grad;
            ctx.beginPath();
            ctx.arc(x, y, 11, 0, Math.PI * 2);
            ctx.fill();

            p.pos += p.speed * p.dir;
            const span = p.horizontal ? w : h;
            if (p.pos > span + gap || p.pos < -gap)
                Object.assign(p, makePacket());
        });
    }

    function loop() {
        ctx.clearRect(0, 0, w, h);
        drawGrid();
        drawPackets();
        requestAnimationFrame(loop);
    }

    window.addEventListener("resize", resize);
    resize();
    if (!reduceMotion) requestAnimationFrame(loop);
    else drawGrid();
})();
