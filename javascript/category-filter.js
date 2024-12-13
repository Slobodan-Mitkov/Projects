document.addEventListener("DOMContentLoaded", () => {
  const dropdown = document.querySelector(".dropdown-check-list");
  const dropdownHeader = dropdown.querySelector(".dropdown-header");
  const items = dropdown.querySelector(".items");
  const icon = dropdownHeader.querySelector("i");
  const bookCards = document.querySelectorAll(".card");
  const searchInput = document.querySelector(".search-input");
  const dropdownResetButton = document.querySelector(".dropdown-reset");
  const textResetButton = document.querySelector(".text-reset");

  dropdownHeader.addEventListener("click", () => {
    dropdown.classList.toggle("visible");
    icon.style.transform = dropdown.classList.contains("visible")
      ? "rotate(180deg)"
      : "rotate(0deg)";
  });

  textResetButton.addEventListener("click", () => {
    searchInput.value = "";
    filterBooks();
  });

  items.addEventListener("change", filterBooks);

  searchInput.addEventListener("input", filterBooks);

  dropdownResetButton.addEventListener("click", () => {
    items.querySelectorAll("input").forEach((input) => (input.checked = false));
    filterBooks();
  });

  document.addEventListener("click", (event) => {
    if (
      !dropdown.contains(event.target) &&
      dropdown.classList.contains("visible")
    ) {
      dropdown.classList.remove("visible");
      icon.style.transform = "rotate(0deg)";
    }
  });

  function filterBooks() {
    const selectedCategories = Array.from(
      items.querySelectorAll("input:checked")
    ).map((checkbox) => checkbox.value);
    const searchQuery = searchInput.value.toLowerCase();

    bookCards.forEach((card) => {
      const bookTitle = card
        .querySelector(".card-title")
        .textContent.toLowerCase();
      const bookCategories = card
        .querySelector(".book-category")
        .textContent.split(",")
        .map((c) => c.trim());

      const categoryMatch =
        selectedCategories.length === 0 ||
        selectedCategories.some((category) =>
          bookCategories.includes(category)
        );

      const searchMatch = bookTitle.includes(searchQuery);

      if (categoryMatch && searchMatch) {
        card.parentElement.style.display = "";
      } else {
        card.parentElement.style.display = "none";
      }
    });
  }
});
