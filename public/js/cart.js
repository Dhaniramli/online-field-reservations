let cartIcon = document.querySelector("#cart-icon");
let cartIcon2 = document.querySelector("#cart-icon-2");
let cart = document.querySelector(".cart");
let closeCart = document.querySelector("#close-cart");

cartIcon.addEventListener("click", () => {
    cart.classList.add("active");
});
cartIcon2.addEventListener("click", () => {
    cart.classList.add("active");
});

closeCart.addEventListener("click", () => {
    cart.classList.remove("active");
});
