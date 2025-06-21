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
//  -----------------testimoni-------------------------
// Pastikan deklarasi ini global, bukan dalam IIFE atau DOMContentLoaded
let index = 0;

function getSlides() {
  return Array.from(document.querySelectorAll('.testimonial-item'));
}

function showSlide(newIndex) {
  const slides = getSlides();
  if (newIndex >= slides.length) newIndex = 0;
  if (newIndex < 0) newIndex = slides.length - 1;

  slides.forEach(slide => slide.classList.remove('active'));
  slides[newIndex].classList.add('active');
  index = newIndex;
}

// Deklarasi fungsi secara global agar bisa dipanggil dari HTML
window.nextSlide = function () {
  showSlide(index + 1);
};

window.prevSlide = function () {
  showSlide(index - 1);
};

// Atur index awal sesuai slide aktif
document.addEventListener("DOMContentLoaded", () => {
  const slides = getSlides();
  slides.forEach((slide, i) => {
    if (slide.classList.contains("active")) {
      index = i;
    }
  });
});
