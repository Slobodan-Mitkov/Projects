// Function to display the first option tag
function handleStudentTypeChange() {
  var studentTypeSelect = document.getElementById("studentType");
  var selectOption = studentTypeSelect.querySelector("option[value='']");

  if (selectOption) {
    if (studentTypeSelect.value !== "") {
      selectOption.style.display = "none";
    } else {
      selectOption.style.display = "block";
    }
  }
}
