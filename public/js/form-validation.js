document.addEventListener("DOMContentLoaded", function () {
    const formConfigurations = {
        PartnerForm: {
            rules: {
                company_name: { required: true, min: 3, max: 255 },
                industry_id: { required: true, exists: true },
                logo: { required: true, url: true },
                collaboration_description: { required: true, min: 3, max: 255 },
            },
        },
        MemberForm: {
            rules: {
                picture: { required: true, url: true },
                name: { required: true, min: 3, max: 255 },
                surname: { required: true, min: 3, max: 255 },
                position_id: { required: true, exists: true },
                short_profile: { required: true, min: 3, max: 255 },
            },
        },
        JobForm: {
            rules: {
                title: { required: true, min: 3, max: 255 },
                description: { required: true, min: 3, max: 255 },
                job_type: { required: true, in: ["full-time", "part-time"] },
                work_mode: { required: true, in: ["hybrid", "on-site"] },
                location: { required: true, min: 3, max: 255 },
            },
        },
        IndustryForm: {
            rules: {
                name: { required: true, min: 3, max: 255 },
                description: { required: true, min: 3, max: 255 },
                icon: { required: true, url: true },
            },
        },
        ServiceForm: {
            rules: {
                name: { required: true, min: 2, max: 100 },
                description: { required: true, min: 2, max: 500 },
                service_category_id: { required: true, exists: true },
                industry_id: { required: true, exists: true },
            },
        },
        TestimonialForm: {
            rules: {
                testimonial_text: { required: true, min: 2, max: 255 },
                client_name: { required: true, min: 2, max: 50 },
                client_position: { required: true, min: 2, max: 50 },
                client_company: { required: true, min: 2, max: 50 },
                client_profile_picture: { required: true, url: true },
            },
        },
    };

    Object.keys(formConfigurations).forEach((formName) => {
        const formConfig = formConfigurations[formName];
        const form = document.querySelector(`#${formName}`);

        if (form) {
            form.addEventListener("input", function (event) {
                const input = event.target;
                if (
                    input.tagName === "INPUT" ||
                    input.tagName === "TEXTAREA" ||
                    input.tagName === "SELECT"
                ) {
                    validateInput(input, formConfig.rules);
                }
            });

            form.addEventListener("submit", function (event) {
                let isValid = true;
                const formElements = form.querySelectorAll(
                    "input, textarea, select"
                );

                formElements.forEach((input) => {
                    if (input.classList.contains("is-invalid")) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    event.preventDefault();
                    alert("Please correct the errors before submitting.");
                }
            });
        }
    });

    function validateInput(input, rules) {
        const name = input.name;
        const value = input.value.trim();
        const fieldRules = rules[name];
        const errors = [];

        if (fieldRules) {
            if (fieldRules.required && value === "") {
                errors.push("This field is required.");
            } else if (fieldRules.min && value.length < fieldRules.min) {
                errors.push(`Minimum ${fieldRules.min} characters required.`);
            } else if (fieldRules.max && value.length > fieldRules.max) {
                errors.push(`Maximum ${fieldRules.max} characters allowed.`);
            } else if (fieldRules.in && !fieldRules.in.includes(value)) {
                errors.push(
                    `Value must be one of: ${fieldRules.in.join(", ")}.`
                );
            } else if (
                fieldRules.url &&
                value !== "" &&
                !/^(http|https):\/\/[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})?$/.test(
                    value
                )
            ) {
                errors.push("Invalid URL format.");
            }
        }

        const errorElement = input.nextElementSibling;
        if (errors.length > 0) {
            input.classList.remove("is-valid");
            input.classList.add("is-invalid");

            if (
                errorElement &&
                errorElement.classList.contains("text-danger")
            ) {
                errorElement.innerHTML = errors[0];
            } else {
                const errorHtml = `<div class="text-danger mt-1">${errors[0]}</div>`;
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
});
