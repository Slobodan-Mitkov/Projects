document.addEventListener("DOMContentLoaded", function () {
  const sidebarToggle = document.getElementById("sidebarToggle");
  const sidebar = document.getElementById("sidebar");
  const sidebarIcon = document.getElementById("sidebarIcon");

  sidebarToggle.addEventListener("click", function () {
    sidebar.classList.toggle("active");

    if (sidebar.classList.contains("active")) {
      sidebarToggle.style.left = "250px";
      sidebarIcon.classList.remove("fa-bars");
      sidebarIcon.classList.add("fa-times");
    } else {
      sidebarToggle.style.left = "15px";
      sidebarIcon.classList.remove("fa-times");
      sidebarIcon.classList.add("fa-bars");
    }
  });
});
