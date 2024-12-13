document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const openButton = document.getElementById("sidebar-toggle-nav");
    const closeButton = document.getElementById("sidebar-toggle-app");
    const mainContent = document.getElementById("main-content");
    const dropdownButtons = document.querySelectorAll(".dropdown-toggle");
    const homeLink = document.querySelector(".sidebar-list[href='#home']");
    const jobsLink = document.querySelector(".dropdown-menu a[href='#jobs']");
    const membersLink = document.querySelector(
        ".dropdown-menu a[href='#members']"
    );
    const partnersLink = document.querySelector(
        ".dropdown-menu a[href='#partners']"
    );
    const testimonialsLink = document.querySelector(
        ".dropdown-menu a[href='#testimonials']"
    );
    const industriesLink = document.querySelector(
        ".dropdown-menu a[href='#industries']"
    );
    const servicesLink = document.querySelector(
        ".dropdown-menu a[href='#services']"
    );
    const serviceCategoriesLink = document.querySelector(
        ".sidebar-list[href='#serviceCategories']"
    );
    const crudSections = [
        "#jobs",
        "#members",
        "#partners",
        "#testimonials",
        "#industries",
        "#services",
        "#serviceCategories",
    ];
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

    dropdownToggles.forEach((toggle) => {
        toggle.addEventListener("click", () => {
            const dropdownIcon = toggle.querySelector(".rotate-icon");

            if (dropdownIcon) {
                const previouslyOpenedIcon = document.querySelector(
                    ".rotate-icon.rotated"
                );
                if (
                    previouslyOpenedIcon &&
                    previouslyOpenedIcon !== dropdownIcon
                ) {
                    previouslyOpenedIcon.classList.remove("rotated");
                }

                dropdownIcon.classList.toggle("rotated");
            }
        });

        document.addEventListener("click", (e) => {
            const dropdownIcon = toggle.querySelector(".rotate-icon");
            if (
                dropdownIcon &&
                !toggle.contains(e.target) &&
                dropdownIcon.classList.contains("rotated")
            ) {
                dropdownIcon.classList.remove("rotated");
            }
        });
    });

    if (window.location.hash && !crudSections.includes(window.location.hash)) {
        window.location.href = window.location.href.replace(/#.*/, "");
    }

    const closeAllDropdowns = (currentMenu = null) => {
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
            const button = menu.previousElementSibling;
            if (menu !== currentMenu && menu.classList.contains("opened")) {
                menu.classList.remove("opened");
                menu.style.height = "0";
                setTimeout(() => {
                    menu.style.display = "none";
                }, 300);
                if (button) {
                    button.style.background = "";
                }
            }
        });
    };

    dropdownButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            event.stopPropagation();
            const menu = button.nextElementSibling;

            if (!menu.classList.contains("opened")) {
                closeAllDropdowns(menu);

                menu.classList.add("opened");
                menu.style.display = "block";
                menu.style.height = "0";
                button.style.background =
                    "linear-gradient(90deg, #ff6f0f, #ff950f)";
                button.style.transition = "all 0.3s ease-in-out";
                button.style.color = "white";
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        menu.style.height = `${menu.scrollHeight + 3}px`;
                    });
                });
            } else {
                menu.classList.remove("opened");
                menu.style.height = "0";
                setTimeout(() => {
                    menu.style.display = "none";
                }, 300);
                button.style.background = "";
                button.style.transition = "all 0.3s ease-in-out";
                button.style.color = "";
            }
        });

        button.addEventListener("mouseout", () => {
            if (!button.nextElementSibling.classList.contains("opened")) {
                button.style.color = "";
            }
        });
    });

    document.addEventListener("click", () => closeAllDropdowns());

    if (sidebar && openButton && closeButton && mainContent) {
        const toggleSidebar = () => {
            const isHidden = sidebar.classList.contains("-translate-x-full");
            if (isHidden) {
                sidebar.classList.remove("-translate-x-full");
                mainContent.classList.add("ml-64");

                openButton.classList.add("hidden");
                closeButton.classList.remove("hidden");
            } else {
                sidebar.classList.add("-translate-x-full");
                mainContent.classList.remove("ml-64");

                openButton.classList.remove("hidden");
                closeButton.classList.add("hidden");
            }
        };

        openButton.addEventListener("click", toggleSidebar);
        closeButton.addEventListener("click", toggleSidebar);

        window.addEventListener("hashchange", () => {
            const currentHash = window.location.hash || "#home";

            const sections = document.querySelectorAll(".dashboard-section");
            sections.forEach((section) => {
                section.style.display = "none";
            });

            const currentSection = document.querySelector(currentHash);
            if (currentSection) {
                currentSection.style.display = "block";
            }

            const allDropdownToggles =
                document.querySelectorAll(".dropdown-toggle");
            allDropdownToggles.forEach((toggle) => {
                toggle.style.transition = "";
                toggle.style.background = "";
                toggle.style.color = "";
            });

            const activeLink = document.querySelector(
                `a[href="${currentHash}"]`
            );
            if (activeLink) {
                const dropdownMenu = activeLink.closest(".dropdown-menu");
                if (dropdownMenu) {
                    const dropdownToggle = dropdownMenu.previousElementSibling;
                    if (dropdownToggle) {
                        dropdownToggle.style.transition = "0.3s ease-in-out";
                        dropdownToggle.style.background =
                            "linear-gradient(90deg, rgb(255, 111, 15), rgb(255, 149, 15))";
                        dropdownToggle.style.color = "white";
                    }
                }
            }

            if (
                currentHash === "#home" ||
                window.location.pathname === "/dashboard "
            ) {
                if (homeLink) {
                    homeLink.style.transition = "0.3s ease-in-out";
                    homeLink.style.background =
                        "linear-gradient(90deg, rgb(255, 111, 15), rgb(255, 149, 15))";
                    homeLink.style.color = "white";
                }
            } else {
                if (homeLink) {
                    homeLink.style.transition = "";
                    homeLink.style.background = "";
                    homeLink.style.color = "";
                }
            }

            if (currentHash === "#serviceCategories") {
                if (serviceCategoriesLink) {
                    serviceCategoriesLink.style.transition = "0.3s ease-in-out";
                    serviceCategoriesLink.style.background =
                        "linear-gradient(90deg, rgb(255, 111, 15), rgb(255, 149, 15))";
                    serviceCategoriesLink.style.color = "white";
                }
            } else {
                if (serviceCategoriesLink) {
                    serviceCategoriesLink.style.transition = "";
                    serviceCategoriesLink.style.background = "";
                    serviceCategoriesLink.style.color = "";
                }
            }
        });

        window.dispatchEvent(new HashChangeEvent("hashchange"));
    }
});
