const toggle = document.getElementById("toggle");
const toggleIcons = document.getElementById("toggle-icons");
const bodyDiv = document.getElementById("theme-container");
const nav = document.getElementById("theme-nav");
const labels = document.querySelectorAll("label");
const innerDiv = document.querySelector("div.slot-content");
const aTag = document.querySelector("form a");
const navAtags = document.querySelectorAll("nav#theme-nav a");
const ths = document.querySelectorAll("th");
const tds = document.querySelectorAll("td");
const ps = document.querySelectorAll("p");
const htmlElement = document.documentElement;
const h1s = document.querySelectorAll("h1");
const h2s = document.querySelectorAll("h2");
const h3s = document.querySelectorAll("h3");
const inputs = document.querySelectorAll("input");
const calendarTable = document.querySelector(".fc-scrollgrid-sync-table");
const messagesInnerContent = document.querySelector(".messages-inner-content");
const formLabels = document.querySelectorAll(".form-label");
const loginContainer = document.querySelector(".login-container.min-h-screen");
const loginInnerContainer = document.querySelector(
    "div.guest-slot-content.w-full"
);
const profileButton = document.querySelector(".profile-button");
const dashboardButton = document.querySelector(".dashboard-nav-button");
const profileForms = document.querySelectorAll(".profile-form");
const messagesSidebar = document.querySelector(".messages-sidebar");
const dashboardSidebar = document.getElementById("sidebar");
const innerContainers = document.querySelectorAll(
    ".content-container .container"
);

function applyTheme(theme) {
    if (theme === "dark") {
        htmlElement.classList.remove("light");
        htmlElement.classList.add("dark");

        toggle.classList.remove("light");
        toggle.classList.add("dark");

        if (bodyDiv) {
            bodyDiv.classList.remove("bg-white", "text-black");
            bodyDiv.classList.add("bg-secondary-dark", "text-white");
        }

        if (profileButton) {
            profileButton.classList.remove("bg-shadow", "text-black");
            profileButton.classList.add("bg-secondary-muted", "text-white");
        }

        if (dashboardSidebar) {
            dashboardSidebar.classList.remove("bg-primary-background");
            dashboardSidebar.classList.add("bg-secondary-muted");
        }

        if (messagesSidebar) {
            messagesSidebar.classList.remove(
                "bg-primary-background",
                "text-white"
            );
            messagesSidebar.classList.add("bg-secondary-muted", "text-white");
        }

        if (dashboardButton) {
            dashboardButton.classList.remove(
                "bg-shadow",
                "text-black",
                "hover:bg-secondary-muted",
                "hover:text-white"
            );
            dashboardButton.classList.add(
                "bg-secondary-muted",
                "text-white",
                "hover:bg-shadow",
                "hover:text-black"
            );
        }

        if (loginContainer) {
            loginContainer.classList.remove("bg-gray-100", "bg-black");
            loginContainer.classList.add("bg-secondary-dark");
        }

        if (loginInnerContainer) {
            loginInnerContainer.classList.remove("bg-blue");
            loginInnerContainer.classList.add(
                "bg-secondary-muted",
                "bg-primary-shadow"
            );
        }

        toggle.style.borderColor = "white";
        toggleIcons.querySelector(".fa-sun").style.opacity = "0";
        toggleIcons.querySelector(".fa-moon").style.opacity = "1";
        toggleIcons.querySelector(".fa-moon").style.transform = "translateX(0)";
        toggleIcons.querySelector(".fa-sun").style.transform =
            "translateX(-100%)";

        if (innerDiv) {
            innerDiv.classList.remove("bg-secondary-dark");
            innerDiv.classList.add("bg-shadow");
        }

        if (aTag) {
            aTag.classList.remove("text-black");
            aTag.classList.add("text-white");
        }

        if (messagesInnerContent) {
            messagesInnerContent.classList.remove("text-black");
            messagesInnerContent.classList.add("text-white");
        }

        if (calendarTable) {
            calendarTable.classList.remove("bg-shadow", "text-black");
            calendarTable.classList.add("bg-secondary-dark", "text-white");
        }

        labels.forEach((label) => {
            label.classList.remove("text-black");
            label.classList.add("text-white");
        });

        if (profileForms) {
            profileForms.forEach((form) => {
                form.classList.remove("text-black");
                form.classList.add("text-white");
                const labels = form.querySelectorAll("label");
                labels.forEach((label) => {
                    label.classList.remove("text-black");
                    label.classList.add("text-white");
                });
            });
        }

        formLabels.forEach((formLabel) => {
            formLabel.classList.remove("text-black");
            formLabel.classList.add("text-white");
        });

        navAtags.forEach((navAtag) => {
            navAtag.classList.remove("text-black");
            navAtag.classList.add("text-white");
        });

        ths.forEach((th) => {
            th.classList.remove("bg-primary", "text-white");
            th.classList.add("bg-secondary-dark", "text-white");
        });

        innerContainers.forEach((innerContainer) => {
            innerContainer.classList.remove("bg-shadow");
            innerContainer.classList.add("bg-secondary-muted");
        });

        tds.forEach((td) => {
            td.classList.remove("bg-shadow", "text-black");
            td.classList.add("bg-secondary-dark", "text-white");
        });

        h1s.forEach((h1) => {
            h1.classList.remove("text-black");
            h1.classList.add("text-white");
        });

        h2s.forEach((h2) => {
            h2.classList.remove("text-black");
            h2.classList.add("text-white");
        });

        h3s.forEach((h3) => {
            h3.classList.remove("text-black");
            h3.classList.add("text-white");
        });

        ps.forEach((p) => {
            p.classList.remove("text-black");
            p.classList.add("text-white");
        });
    } else {
        htmlElement.classList.remove("dark");
        htmlElement.classList.add("light");

        toggle.classList.remove("dark");
        toggle.classList.add("light");

        if (bodyDiv) {
            bodyDiv.classList.remove("bg-secondary-dark", "text-white");
            bodyDiv.classList.add("bg-white", "text-black");
        }

        if (profileButton) {
            profileButton.classList.remove("bg-secondary-muted", "text-white");
            profileButton.classList.add("bg-shadow", "text-black");
        }

        if (dashboardSidebar) {
            dashboardSidebar.classList.remove("bg-secondary-muted");
            dashboardSidebar.classList.add("bg-primary-background");
        }

        if (messagesSidebar) {
            messagesSidebar.classList.remove(
                "bg-secondary-muted",
                "text-white"
            );
            messagesSidebar.classList.add(
                "bg-primary-background",
                "text-white"
            );
        }

        if (dashboardButton) {
            dashboardButton.classList.remove(
                "bg-secondary-muted",
                "text-white",
                "hover:bg-shadow",
                "hover:text-black"
            );
            dashboardButton.classList.add(
                "bg-shadow",
                "text-black",
                "hover:bg-secondary-muted",
                "hover:text-white"
            );
        }

        if (loginContainer) {
            loginContainer.classList.remove("bg-secondary-dark", "bg-black");
            loginContainer.classList.add("bg-gray-100");
        }

        if (loginInnerContainer) {
            loginInnerContainer.classList.remove(
                "bg-secondary-muted",
                "bg-primary-shadow"
            );
            loginInnerContainer.classList.add("bg-blue");
        }

        toggle.style.borderColor = "black";
        toggleIcons.querySelector(".fa-sun").style.opacity = "1";
        toggleIcons.querySelector(".fa-moon").style.opacity = "0";
        toggleIcons.querySelector(".fa-moon").style.transform =
            "translateX(100%)";
        toggleIcons.querySelector(".fa-sun").style.transform = "translateX(0)";

        if (innerDiv) {
            innerDiv.classList.remove("bg-shadow");
            innerDiv.classList.add("bg-secondary-dark");
        }

        if (aTag) {
            aTag.classList.remove("text-white");
            aTag.classList.add("text-black");
        }

        if (messagesInnerContent) {
            messagesInnerContent.classList.remove("text-white");
            messagesInnerContent.classList.add("text-black");
        }

        if (calendarTable) {
            calendarTable.classList.remove("bg-secondary-dark", "text-white");
            calendarTable.classList.add("bg-shadow", "text-black");
        }

        innerContainers.forEach((innerContainer) => {
            innerContainer.classList.remove("bg-secondary-muted");
            innerContainer.classList.add("bg-shadow");
        });

        labels.forEach((label) => {
            label.classList.remove("text-white");
            label.classList.add("text-black");
        });

        if (profileForms) {
            profileForms.forEach((form) => {
                form.classList.remove("text-white");
                form.classList.add("text-black");
                const labels = form.querySelectorAll("label");
                labels.forEach((label) => {
                    label.classList.remove("text-white");
                    label.classList.add("text-black");
                });
            });
        }

        formLabels.forEach((formLabel) => {
            formLabel.classList.remove("text-white");
            formLabel.classList.add("text-black");
        });

        navAtags.forEach((navAtag) => {
            navAtag.classList.remove("text-white");
            navAtag.classList.add("text-black");
        });

        ths.forEach((th) => {
            th.classList.remove("bg-secondary-dark", "text-white");
            th.classList.add("bg-primary", "text-white");
        });

        tds.forEach((td) => {
            td.classList.remove("bg-secondary-dark", "text-white");
            td.classList.add("bg-shadow", "text-black");
        });

        h1s.forEach((h1) => {
            h1.classList.remove("text-white");
            h1.classList.add("text-black");
        });

        h2s.forEach((h2) => {
            h2.classList.remove("text-white");
            h2.classList.add("text-black");
        });

        h3s.forEach((h3) => {
            h3.classList.remove("text-white");
            h3.classList.add("text-black");
        });

        ps.forEach((p) => {
            p.classList.remove("text-white");
            p.classList.add("text-black");
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme") || "light";

    applyTheme(savedTheme);
});

toggle.addEventListener("click", () => {
    const currentTheme = htmlElement.classList.contains("dark")
        ? "dark"
        : "light";
    const newTheme = currentTheme === "dark" ? "light" : "dark";

    applyTheme(newTheme);

    localStorage.setItem("theme", newTheme);
});
