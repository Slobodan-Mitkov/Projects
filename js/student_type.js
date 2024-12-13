// Function to get all the types of students from the database and implement them in the select tag as options
document.addEventListener("DOMContentLoaded", function () {
  var studentTypeSelect = document.getElementById("studentType");

  studentTypeSelect.innerHTML = "";
  studentTypes.forEach(function (type) {
    var option = document.createElement("option");
    option.value = type;
    option.text = "Студенти од " + type;
    studentTypeSelect.add(option);
  });

  var defaultOption = document.createElement("option");
  defaultOption.value = "";
  defaultOption.text = "Изберете тип на студент";
  defaultOption.disabled = true;
  defaultOption.selected = true;
  studentTypeSelect.add(defaultOption);
});
