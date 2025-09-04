// Only handle nav link active states - NO dropdown functionality
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

document
    .getElementById("announcementDropdown")
    .addEventListener("click", function (e) {
        // If user clicks and there's no dropdown open → go to link
        if (!this.parentElement.classList.contains("show")) {
            window.location = this.getAttribute("href");
        }
    });
document
    .getElementById("contactsDropdown")
    .addEventListener("click", function (e) {
        // If user clicks and there's no dropdown open → go to link
        if (!this.parentElement.classList.contains("show")) {
            window.location = this.getAttribute("href");
        }
    });
document
    .getElementById("ratesDropdown")
    .addEventListener("click", function (e) {
        // If user clicks and there's no dropdown open → go to link
        if (!this.parentElement.classList.contains("show")) {
            window.location = this.getAttribute("href");
        }
    });
const events = {
    1: {
        couples: { title: "OPEN", details: "Just an ordinary day" },
        langer: { title: "CLOSED", details: "" },
    },
    2: {
        couples: {
            title: "MEN'S FEDERATION 8:00AM/ONE TEE",
            details:
                "A premier golf event bringing together skilled players from across the region to compete in a day of challenging play and sportsmanship.",
        },
        langer: { title: "CLOSED", details: "" },
    },
    3: {
        couples: { title: "OPEN", details: "Couples open play for members." },
        langer: { title: "", details: "" },
    },
    7: {
        couples: { title: "", details: "" },
        langer: { title: "OPEN", details: "Langer course open for booking." },
    },
    12: {
        couples: {
            title: "Tournament",
            details: "Annual Couples Tournament with prizes.",
        },
        langer: {
            title: "Charity Event",
            details: "Fundraiser on the Langer course.",
        },
    },
    // other days default blank
};

const calendar = document.getElementById("eventCalendar");

const year = 2025;
const month = 8; // September (0-based in JS)
const firstDay = new Date(year, month, 1).getDay();
const daysInMonth = new Date(year, month + 1, 0).getDate();

// Fill empty cells before day 1
for (let i = 0; i < firstDay; i++) {
    const empty = document.createElement("div");
    empty.className = "date-cell empty-cell";
    calendar.appendChild(empty);
}

// Generate days
for (let day = 1; day <= daysInMonth; day++) {
    const event = events[day] || {
        couples: { title: "", details: "" },
        langer: { title: "", details: "" },
    };

    const cell = document.createElement("div");
    cell.className = "date-cell";

    cell.innerHTML = `
        <div class="day-number">${day}</div>
        <div class="event-group text-center">
            <div class="event-label">COUPLES</div>
            <div class="event-title">${event.couples.title || ""}</div>
        </div>
        <div class="event-group text-center">
            <div class="event-label">LANGER</div>
            <div class="event-title">${event.langer.title || ""}</div>
        </div>
    `;

    cell.addEventListener("click", () => {
        document.getElementById(
            "eventDate"
        ).textContent = `Events on September ${day}, ${year}`;
        document.getElementById("eventDetails").innerHTML = `
            <p><strong>COUPLES:</strong> ${
                event.couples.details || "No event"
            }</p>
            <p><strong>LANGER:</strong> ${
                event.langer.details || "No event"
            }</p>
        `;
        new bootstrap.Modal(document.getElementById("eventModal")).show();
    });

    calendar.appendChild(cell);
}
