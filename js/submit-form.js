document.addEventListener("DOMContentLoaded", function () {
  // For input event listener for real-time validation
  var inputFields = document.querySelectorAll("input, select");
  inputFields.forEach(function (input) {
    input.addEventListener("input", function () {
      validateInput(input);
    });
  });

  // For submit event listener
  var submitButton = document.getElementById("submitButton");
  submitButton.addEventListener("click", submitForm);
});
// Function for custom error message below the input
function getCustomErrorMessage(fieldName) {
  var customErrorMessage = "Внесете го ";
  switch (fieldName) {
    case "name":
      customErrorMessage += "вашето име.";
      break;
    case "companyName":
      customErrorMessage += "името на компанијата.";
      break;
    case "email":
      customErrorMessage += "вашиот имејл.";
      break;
    case "phone":
      customErrorMessage += "вашиот телефонски број:+389XXXXXXXX";
      break;
    default:
      break;
  }
  return customErrorMessage;
}
// Function for functional form that can be submitted
function submitForm(event) {
  event.preventDefault();

  var form = document.getElementById("applicationForm");

  var existingErrorMessages = form.querySelectorAll(".error-message");
  existingErrorMessages.forEach(function (errorMessage) {
    errorMessage.textContent = "";
  });

  var inputFields = form.querySelectorAll("input, select");
  inputFields.forEach(function (input) {
    input.classList.remove("error", "success");
  });

  inputFields.forEach(function (input) {
    validateInput(input);
  });

  if (form.checkValidity()) {
    form.submit();
  } else {
    form.reportValidity();
  }
}
// Function to display the custom error message
function displayErrorMessage(fieldName, errorMessage) {
  var errorElement = document.getElementById(fieldName + "-error");
  if (errorElement) {
    errorElement.textContent = errorMessage;
  }
}
// Function to validate the input given by the user
function validateInput(input) {
  var form = document.getElementById("applicationForm");

  if (input.tagName === "SELECT") {
    var selectedOption = input.options[input.selectedIndex];
    if (selectedOption.disabled) {
      var fieldName = input.name;
      var customErrorMessage = getCustomErrorMessage(fieldName);
      displayErrorMessage(fieldName, customErrorMessage);
      input.classList.remove("success");
      input.classList.add("error");
    } else {
      input.classList.remove("error");
      input.classList.add("success");
    }
  } else {
    if (input.hasAttribute("required") && input.value.trim() === "") {
      var fieldName = input.name;
      var customErrorMessage = getCustomErrorMessage(fieldName);
      displayErrorMessage(fieldName, customErrorMessage);
      input.classList.remove("success");
      input.classList.add("error");
    } else if (!input.checkValidity()) {
      var fieldName = input.name;
      var customErrorMessage = getCustomErrorMessage(fieldName);
      displayErrorMessage(fieldName, customErrorMessage);
      input.classList.remove("success");
      input.classList.add("error");
    } else {
      input.classList.remove("error");
      input.classList.add("success");
    }
  }

  if (input.type === "submit") {
    input.classList.remove("error", "success");
  }
}
