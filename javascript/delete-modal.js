document.addEventListener("DOMContentLoaded", () => {
  const deleteButtons = document.querySelectorAll(".delete-btn");
  deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
      event.preventDefault();
      const bookId = this.getAttribute("data-book-id");
      document.getElementById("deleteBookId").value = bookId;
      const deleteModal = new bootstrap.Modal(
        document.getElementById("deleteModal")
      );
      deleteModal.show();
    });
  });
});
