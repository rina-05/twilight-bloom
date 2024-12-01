//Menu Open Close
let menu = document.querySelector(".menu-icon")

menu.onclick = () => {
    menu.classList.toggle("move")
};
//swiper
var swiper = new Swiper(".services-content", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 50000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });