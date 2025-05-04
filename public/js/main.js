const menuToggle = document.getElementById("menu-toggle");
const menuClose = document.getElementById("menu-close");
const navLinks = document.getElementById("nav-links");

// Fungsi untuk memeriksa apakah lebar layar di bawah 768px
function checkMobileView() {
    return window.innerWidth <= 768;
}

// Menambahkan event listener pada tombol buka menu
menuToggle.addEventListener("click", () => {
    if (checkMobileView()) {
        navLinks.classList.add("active");
        menuToggle.style.display = "none";
        menuClose.style.display = "block";
    }
});

// Menambahkan event listener pada tombol tutup menu
menuClose.addEventListener("click", () => {
    if (checkMobileView()) {
        navLinks.classList.remove("active");
        menuToggle.style.display = "block";
        menuClose.style.display = "none";
    }
});

// Memastikan saat resize, tombol yang muncul sesuai dengan ukuran layar
window.addEventListener('resize', () => {
    if (!checkMobileView()) {
        menuToggle.style.display = "none";
        menuClose.style.display = "none";
        navLinks.classList.remove("active");
    } else {
        menuToggle.style.display = "block";
        menuClose.style.display = "none";
    }
});
