// For when the button is clicked it filters the cards
document
  .querySelector("#filter-coding")
  .addEventListener("click", filterCoding);
document
  .querySelector("#filter-design")
  .addEventListener("click", filterDesign);
document
  .querySelector("#filter-marketing")
  .addEventListener("click", filterMarketing);
// Function for filter for Coding
function filterCoding() {
  hideAllCards();
  var codingCards = document.querySelectorAll(".coding");
  codingCards.forEach((codingCard) => {
    codingCard.style.display = "";
  });
}
// Function for filter for Design
function filterDesign() {
  hideAllCards();

  var designCards = document.querySelectorAll(".design");
  designCards.forEach((designCard) => {
    designCard.style.display = "";
  });
}
// Function for filter for Marketing
function filterMarketing() {
  hideAllCards();

  var marketingCards = document.querySelectorAll(".marketing");
  marketingCards.forEach((marketingCard) => {
    marketingCard.style.display = "";
  });
}
// Function to hide all cards
function hideAllCards() {
  var allCards = document.querySelectorAll(".card");

  allCards.forEach((card) => {
    card.style.display = "none";
  });
}
// Function to show all cards
function showAllCards() {
  var allCards = document.querySelectorAll(".card");

  allCards.forEach((card) => {
    card.style.display = "inline-block";
  });
}
// Function to stay on the card as active until the user clicks another button
var header = document.getElementById("filters");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function () {
    var current = document.getElementsByClassName("active");
    if (current.length > 0) {
      current[0].className = current[0].className.replace(" active", "");
    }
    this.className += " active";
  });
}
