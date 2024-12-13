document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-input");
    const statusAllButton = document.getElementById("status-all");
    const statusReadButton = document.getElementById("status-read");
    const statusUnreadButton = document.getElementById("status-unread");
    const dateFilterButton = document.getElementById("date-filter");
    const dateInput = document.getElementById("date-input");
    const messagesBody = document.getElementById("messages-body");

    const filterMessages = () => {
        const searchTerm = searchInput.value.toLowerCase();
        const activeStatus = document.querySelector(
            ".filter-option .active"
        )?.id;
        const selectedDate = dateInput?.value;

        const rows = messagesBody.querySelectorAll("tr");

        rows.forEach((row) => {
            const name = row
                .querySelector("td:nth-child(2)")
                .innerText.toLowerCase();
            const message = row
                .querySelector("td:nth-child(3)")
                .innerText.toLowerCase();
            const isRead = row.classList.contains("read");
            const createdDate =
                row.querySelector("td:nth-child(5)").dataset.created;

            let matchesSearch =
                name.includes(searchTerm) || message.includes(searchTerm);
            let matchesStatus =
                activeStatus === "status-all" ||
                (activeStatus === "status-read" && isRead) ||
                (activeStatus === "status-unread" && !isRead);

            let matchesDate = !selectedDate || createdDate === selectedDate;

            if (matchesSearch && matchesStatus && matchesDate) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    };

    searchInput.addEventListener("input", filterMessages);

    statusAllButton.addEventListener("click", () => {
        document
            .querySelectorAll(".filter-option button")
            .forEach((option) => option.classList.remove("active"));
        statusAllButton.classList.add("active");
        filterMessages();
    });

    statusReadButton.addEventListener("click", () => {
        document
            .querySelectorAll(".filter-option button")
            .forEach((option) => option.classList.remove("active"));
        statusReadButton.classList.add("active");
        filterMessages();
    });

    statusUnreadButton.addEventListener("click", () => {
        document
            .querySelectorAll(".filter-option button")
            .forEach((option) => option.classList.remove("active"));
        statusUnreadButton.classList.add("active");
        filterMessages();
    });

    dateFilterButton.addEventListener("click", () => {
        dateInput.classList.toggle("hidden");

        if (dateInput.classList.contains("hidden")) {
            dateFilterButton.style.background = "";
            dateFilterButton.style.transition = "";
            dateFilterButton.style.color = "";
        } else {
            dateFilterButton.style.background =
                "linear-gradient(90deg, #ff6f0f, #ff950f)";
            dateFilterButton.style.transition = "all 0.3s ease-in-out";
            dateFilterButton.style.color = "white";
        }
    });

    dateInput.addEventListener("change", () => {
        filterMessages();
    });
    document.querySelectorAll(".message-row").forEach((row) => {
        row.addEventListener("click", (event) => {
            const url = row.getAttribute("data-href");
            window.location.href = url;
        });
    });
});
