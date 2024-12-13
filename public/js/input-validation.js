document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("NameForm");
    const input = document.querySelector("input[name='name']");

    const errorMessages = {
        required: "Please enter a name.",
        min: "Name must be at least 3 characters.",
        max: "Name must be no more than 255 characters.",
    };

    function validateInput(input) {
        const value = input.value.trim();
        const errors = [];

        if (!value) {
            errors.push(errorMessages.required);
        } else {
            if (value.length < 3) {
                errors.push(errorMessages.min);
            }
            if (value.length > 255) {
                errors.push(errorMessages.max);
            }
        }

        displayErrors(input, errors);
    }

    function displayErrors(input, errors) {
        let errorElement = input.nextElementSibling;

        if (errors.length > 0) {
            input.classList.remove("is-valid");
            input.classList.add("is-invalid");

            if (
                errorElement &&
                errorElement.classList.contains("text-danger")
            ) {
                errorElement.innerHTML = errors.join("<br>");
            } else {
                const errorHtml = `<div class="text-danger mt-1">${errors.join(
                    "<br>"
                )}</div>`;
                input.insertAdjacentHTML("afterend", errorHtml);
            }
        } else {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");

            if (
                errorElement &&
                errorElement.classList.contains("text-danger")
            ) {
                errorElement.remove();
            }
        }
    }

    input.dataset.touched = "false";

    input.addEventListener("focus", function () {
        input.dataset.touched = "true";
    });

    input.addEventListener("input", function () {
        if (input.dataset.touched === "true") {
            validateInput(input);
        }
    });

    input.addEventListener("blur", function () {
        if (input.dataset.touched === "true") {
            validateInput(input);
        }
    });

    if (form) {
        form.addEventListener("submit", function (event) {
            validateInput(input);

            if (input.classList.contains("is-invalid")) {
                event.preventDefault();
                alert("Please correct the errors before submitting the form.");
            }
        });
    }
});
