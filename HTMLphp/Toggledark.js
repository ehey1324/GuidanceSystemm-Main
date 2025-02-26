// Regenerate session ID to prevent fixation
session_regenerate_id(true);

let isDarkMode = false; // Default to light mode

// Check local storage for the user's theme preference
document.addEventListener("DOMContentLoaded", function () {
    let savedTheme = localStorage.getItem("theme");

    if (savedTheme === "dark") {
        document.body.classList.add("dark-mode");
        document.body.classList.remove("light-mode");
        document.querySelector("#theme-dropdown a").innerHTML =
            '<i class="fa-solid fa-moon"></i> Dark Mode <i class="fa-solid fa-toggle-off theme-switch"></i>';
    } else {
        document.body.classList.add("light-mode");
        document.body.classList.remove("dark-mode");
        document.querySelector("#theme-dropdown a").innerHTML =
            '<i class="fa-solid fa-sun"></i> Light Mode <i class="fa-solid fa-toggle-on theme-switch"></i>';
    }
});

function toggleThemeDropdown() {
    const dropdown = document.getElementById("theme-dropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

function toggleTheme() {
    const body = document.body;
    const themeToggle = document.querySelector("#theme-dropdown a");

    if (body.classList.contains("dark-mode")) {
        body.classList.remove("dark-mode");
        body.classList.add("light-mode");
        localStorage.setItem("theme", "light");
        themeToggle.innerHTML =
            '<i class="fa-solid fa-sun"></i> Light Mode <i class="fa-solid fa-toggle-on theme-switch"></i>';
    } else {
        body.classList.remove("light-mode");
        body.classList.add("dark-mode");
        localStorage.setItem("theme", "dark");
        themeToggle.innerHTML =
            '<i class="fa-solid fa-moon"></i> Dark Mode <i class="fa-solid fa-toggle-off theme-switch"></i>';
    }
}
    // logout.php
session_start(); // Start the session

// Destroy all session data
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to the login page
header("Location: LoginAdmin&Counselor.php");
exit();
