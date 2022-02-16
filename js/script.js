// Create variables
const scrollToTopBtn = document.getElementById("scrollToTop");
const mobileMenu = document.getElementById("mobile-menu");
const mobileMenuController = document.getElementById("mobile-menu-controller");


// Scroll to top function
const scrollToTop = () => {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}


// open / close mobile menu
const triggerMobileMenu = (mobileMenu) => {
  // check if the menu is open
  if (mobileMenu.classList.contains('open-mobile-menu')) {
    // close menu
    mobileMenu.classList.remove('open-mobile-menu');
    mobileMenu.classList.add('close-mobile-menu');
  } else {
    // open menu
    mobileMenu.classList.remove('close-mobile-menu');
    mobileMenu.classList.add('open-mobile-menu');
  }
}


// trigger event listeners
scrollToTopBtn.addEventListener("click", scrollToTop);
mobileMenuController.addEventListener("click", () => triggerMobileMenu(mobileMenu));
