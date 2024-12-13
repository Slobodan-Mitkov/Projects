import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

setTimeout(function () {
    document.querySelectorAll(".alert-success").forEach(function (alert) {
        alert.remove();
    });
}, 8000);
