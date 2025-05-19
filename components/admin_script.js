document.addEventListener("DOMContentLoaded", () => {
  let body = document.body;

  let profile = document.querySelector("header .flex .profile");
  let searchForm = document.querySelector("header .flex .search-form");
  let sideBar = document.querySelector(".side-bar");

  document.querySelector("#user-btn")?.addEventListener("click", () => {
    profile.classList.toggle("active");
    searchForm.classList.remove("active");
  });

  document.querySelector("#search-btn")?.addEventListener("click", () => {
    searchForm.classList.toggle("active");
    profile.classList.remove("active");
  });

  document.querySelector("#menu-btn")?.addEventListener("click", () => {
    sideBar.classList.toggle("active");
    body.classList.toggle("active");
  });

  window.addEventListener("scroll", () => {
    profile.classList.remove("active");
    searchForm.classList.remove("active");

    if (window.innerWidth < 1200) {
      sideBar.classList.remove("active");
      body.classList.remove("active");
    }
  });
});
