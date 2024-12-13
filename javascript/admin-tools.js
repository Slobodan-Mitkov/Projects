var categoryModal = document.getElementById("categoryModal");
var authorModal = document.getElementById("authorModal");

var openCategoryModalBtn = document.getElementById("openCategoryModal");
var openAuthorModalBtn = document.getElementById("openAuthorModal");

var categoryClose = categoryModal.querySelector(".close");
var authorClose = authorModal.querySelector(".close");

openCategoryModalBtn.onclick = function () {
  categoryModal.style.display = "block";
};

openAuthorModalBtn.onclick = function () {
  authorModal.style.display = "block";
};

categoryClose.onclick = function () {
  categoryModal.style.display = "none";
};

authorClose.onclick = function () {
  authorModal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == categoryModal) {
    categoryModal.style.display = "none";
  }
  if (event.target == authorModal) {
    authorModal.style.display = "none";
  }
};
