// Function to display error message
function displayErrorMessage(inputId, errorMessage) {
  var errorElement = document.getElementById(inputId + "-error");
  if (errorElement) {
    if (errorMessage) {
      errorElement.textContent = errorMessage;
      errorElement.style.color = "red";
    } else {
      errorElement.textContent = "";
    }
  }
}
// Function to update error message
function updateErrorMessage(inputId, errorMessage) {
  displayErrorMessage(inputId, errorMessage);
}
