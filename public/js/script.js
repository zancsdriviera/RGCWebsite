// nav active states (keeps your original behavior)
document.querySelectorAll(".nav-link").forEach(function (link) {
    link.addEventListener("click", function (e) {
        // Prevent default for dropdown links to avoid navigation
        if (this.closest(".dropdown")) {
            e.preventDefault();
        }

        // Remove 'active' from all nav links
        document.querySelectorAll(".nav-link").forEach(function (nav) {
            nav.classList.remove("active");
        });
        // Add 'active' to the clicked link
        this.classList.add("active");
    });
});

// safe guards when id elements exist
const announcementDropdown = document.getElementById("announcementDropdown");
if (announcementDropdown) {
    announcementDropdown.addEventListener("click", function (e) {
        if (!this.parentElement.classList.contains("show")) {
            window.location = this.getAttribute("href");
        }
    });
}
const contactsDropdown = document.getElementById("contactsDropdown");
if (contactsDropdown) {
    contactsDropdown.addEventListener("click", function (e) {
        if (!this.parentElement.classList.contains("show")) {
            window.location = this.getAttribute("href");
        }
    });
}
const ratesDropdown = document.getElementById("ratesDropdown");
if (ratesDropdown) {
    ratesDropdown.addEventListener("click", function (e) {
        if (!this.parentElement.classList.contains("show")) {
            window.location = this.getAttribute("href");
        }
    });
}

/* ---------------------------
  Your old card carousel (guarded)
  if the page doesn't contain the old carousel, this simply returns
---------------------------- */
(() => {
    const container = document.querySelector(".carousel-container");
    const track = document.querySelector(".carousel-track");
    if (!container || !track) return; // safe exit when carousel not on page

    const cards = Array.from(track.children);
    const prevBtn = document.querySelector(".carousel-btn.prev");
    const nextBtn = document.querySelector(".carousel-btn.next");

    let visible = 3; // number of visible cards
    let index = 0; // current left-most visible card index
    let cardWidth = 0;
    let gap = 0;
    let step = 0;
    let maxIndex = 0;

    function measure() {
        if (!cards.length) return;
        cardWidth = cards[0].getBoundingClientRect().width;
        if (cards.length > 1) {
            const r1 = cards[0].getBoundingClientRect().right;
            const l2 = cards[1].getBoundingClientRect().left;
            gap = Math.round((l2 - r1) * 100) / 100;
        } else {
            const cs = getComputedStyle(track);
            gap = parseFloat(cs.gap) || 0;
        }
        step = cardWidth + gap;
        const cssVisible =
            parseInt(
                getComputedStyle(document.documentElement).getPropertyValue(
                    "--visible"
                )
            ) || visible;
        visible = cssVisible;
        maxIndex = Math.max(0, cards.length - visible);
    }

    function update() {
        index = Math.max(0, Math.min(index, maxIndex));
        const moveX = Math.round(index * step * 100) / 100;
        track.style.transform = `translateX(-${moveX}px)`;
        if (prevBtn) prevBtn.disabled = index <= 0;
        if (nextBtn) nextBtn.disabled = index >= maxIndex;
    }

    if (prevBtn) {
        prevBtn.addEventListener("click", () => {
            if (index > 0) {
                index--;
                update();
            }
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            if (index < maxIndex) {
                index++;
                update();
            }
        });
    }

    window.addEventListener("load", () => {
        measure();
        update();
    });
    window.addEventListener("resize", () => {
        measure();
        update();
    });

    measure();
    update();
})();

/* ---------------------------
  Gallery (main image + thumbnails) - matches your HTML classes exactly
---------------------------- */
document.addEventListener("DOMContentLoaded", () => {
    const mainImg = document.querySelector(".cg-main");
    const thumbs = Array.from(document.querySelectorAll(".cg-thumbs img"));
    const prevBtn = document.querySelector(".cg-side.prev");
    const nextBtn = document.querySelector(".cg-side.next");
    const thumbRow = document.querySelector(".cg-thumbs");
    const thumbPrev = document.querySelector(".thumb-nav.left");
    const thumbNext = document.querySelector(".thumb-nav.right");

    if (!mainImg || thumbs.length === 0) return; // no gallery on page

    // If the CSS currently uses grid, switch the thumbnail container to a horizontal, scrollable row
    // This is done at runtime so you don't need to change many lines of CSS right away.
    if (thumbRow) {
        const cs = getComputedStyle(thumbRow);
        if (cs.display === "grid") {
            thumbRow.style.display = "flex";
            thumbRow.style.overflowX = "auto";
            thumbRow.style.scrollBehavior = "smooth";
            thumbRow.style.gap = cs.gap || "8px";
        }
    }

    let currentIndex = 0;

    function showImage(index) {
        if (index < 0) index = thumbs.length - 1;
        if (index >= thumbs.length) index = 0;
        currentIndex = index;
        mainImg.src = thumbs[currentIndex].src;

        thumbs.forEach((t) => t.classList.remove("active-thumb"));
        thumbs[currentIndex].classList.add("active-thumb");

        // ensure active thumbnail is visible in the thumbnail scroller
        try {
            thumbs[currentIndex].scrollIntoView({
                behavior: "smooth",
                inline: "center",
                block: "nearest",
            });
        } catch (err) {
            // fallback if not supported
            thumbs[currentIndex].scrollIntoView();
        }
    }

    // prev/next on main image
    if (prevBtn)
        prevBtn.addEventListener("click", () => showImage(currentIndex - 1));
    if (nextBtn)
        nextBtn.addEventListener("click", () => showImage(currentIndex + 1));

    // clicking thumbnails
    thumbs.forEach((thumb, i) => {
        thumb.addEventListener("click", () => showImage(i));
        // improve accessibility: keyboard focus
        thumb.tabIndex = 0;
        thumb.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                showImage(i);
            }
        });
    });

    // thumb-nav left/right scrolling
    if (thumbPrev && thumbRow) {
        thumbPrev.addEventListener("click", () => {
            // scroll by two thumbnails width (or container width fallback)
            const first = thumbs[0];
            const gap = parseFloat(getComputedStyle(thumbRow).gap) || 8;
            const w = first.getBoundingClientRect().width + gap;
            thumbRow.scrollBy({ left: -w * 2, behavior: "smooth" });
        });
    }
    if (thumbNext && thumbRow) {
        thumbNext.addEventListener("click", () => {
            const first = thumbs[0];
            const gap = parseFloat(getComputedStyle(thumbRow).gap) || 8;
            const w = first.getBoundingClientRect().width + gap;
            thumbRow.scrollBy({ left: w * 2, behavior: "smooth" });
        });
    }

    // optional keyboard support for main image
    document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") showImage(currentIndex - 1);
        if (e.key === "ArrowRight") showImage(currentIndex + 1);
    });

    // initialize
    showImage(0);
});
