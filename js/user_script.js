let body = document.body;
let profile = document.querySelector('.header .flex .profile');
let searchForm = document.querySelector('.header .flex .search-form');
let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#user-btn').onclick = () => {
  profile.classList.toggle('active');
  searchForm.classList.remove('active');
};

document.querySelector('#search-btn').onclick = () => {
  searchForm.classList.toggle('active');
  profile.classList.remove('active');
};

document.querySelector('#menu-btn').onclick = () => {
  navbar.classList.toggle('active');
  body.classList.toggle('active');
};

window.onscroll = () =>{
  profile.classList.remove('active')
  searchForm.classList.remove('active');

  if(window.innerWidth < 1200) {
     sideBar.classList.remove('active');
    body.classList.remove('active');
  }
};

// Counter//
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".counter");

  counters.forEach((counter) => {
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
// -----------------tab---------------------------//

const tabsContainer = document.querySelector('.teacher-tabs');
const aboutSection = document.querySelector('.teacher-section');

tabsContainer.addEventListener('click', function(e) {
  const clicked = e.target.closest('.tab-item');
  if (!clicked) return;

  const currentActiveTab = tabsContainer.querySelector('.tab-item.active');
  currentActiveTab?.classList.remove('active');
  clicked.classList.add('active');


  const targetId = clicked.getAttribute('data-target');
  const activeContent = aboutSection.querySelector('.tab-content.active');
  const targetContent = aboutSection.querySelector(targetId);

  activeContent?.classList.remove('active');
  targetContent?.classList.add('active');
});

