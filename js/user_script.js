let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick=()=>{
    profile.classList.toggle('active');
    searchForm.classList.remove('active');
}

let searchForm = document.querySelector('.header .flex .search-form');

document.querySelector('#search-btn').onclick=()=>{
    searchForm.classList.toggle('active');
    profile.classList.remove('active');
}

let pnavbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick=()=>{
    navbar.classList.toggle('active');
}


// Counter//
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".counter");

  counters.forEach(counter => {
    const target = +counter.getAttribute("data-target");
    const boxCounter = counter.closest(".box-counter");
    const speed = +boxCounter.getAttribute("data-speed");

    let count = 0;
    const increment = Math.ceil(target / speed);

    const updateCounter = () => {
      count += increment;
      if (count < target) {
        counter.textContent = count;
        setTimeout(updateCounter, 1);
      } else {
        counter.textContent = target;
      }
    };

    updateCounter();
  });
});