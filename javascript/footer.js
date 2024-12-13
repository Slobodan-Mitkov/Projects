document.addEventListener("DOMContentLoaded", () => {
  fetch("http://api.quotable.io/random")
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("quote-text").textContent = `"${data.content}"`;
      document.getElementById("quote-author").textContent = `${data.author}`;
    })
    .catch((error) => {
      console.error("Error fetching the quote:", error);
      document.getElementById("quote-text").textContent =
        "An error occurred while fetching the quote.";
    });
});
