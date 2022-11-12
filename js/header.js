const toggle = document.querySelector(".toggle");
const navList = document.querySelector(".right-nav");
const screenMatch = window.matchMedia('(min-width: 901px)');

function showToggleMenu() {
    if (!navList.classList.contains("active")) {
        navList.classList.add("active");
    } else {
      navList.classList.remove("active");
    }
}

function closeToggleMenu() {
  if (navList.classList.contains("active")) {
      navList.classList.remove("active");
  }
}

toggle.addEventListener("click", showToggleMenu, false);
screenMatch.addEventListener("change", closeToggleMenu);