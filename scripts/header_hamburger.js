const hamburger = document.querySelector(".hamburger");
const right_hlava = document.querySelector(".right-hlava");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    right_hlava.classList.toggle("active");

})