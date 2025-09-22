// LOADER
window.addEventListener("load", () => {
  const loader = document.getElementById("loader");
  loader.style.opacity = "0";
  setTimeout(() => loader.style.display = "none", 600);
});

// DARK MODE
const toggle = document.getElementById("darkModeToggle");
const body = document.body;

// Aplica preferência salva
if (localStorage.getItem("dark-mode") === "enabled") {
  body.classList.add("dark");
}

toggle.addEventListener("click", () => {
  body.classList.toggle("dark");
  if (body.classList.contains("dark")) {
    localStorage.setItem("dark-mode", "enabled");
  } else {
    localStorage.setItem("dark-mode", "disabled");
  }
});

// SCROLL REVEAL
window.addEventListener("scroll", () => {
  document.querySelectorAll(".reveal").forEach(el => {
    const windowHeight = window.innerHeight;
    const revealTop = el.getBoundingClientRect().top;
    if (revealTop < windowHeight - 80) {
      el.classList.add("active");
    }
  });
});
