// Toggle class active untuk hamburger menu
// Kegunaan: Menambahkan atau menghapus class "active" pada elemen navbar saat tombol hamburger menu diklik.
// Letaknya: Di bagian awal untuk mengatur interaksi dengan navbar.
const navbarNav = document.querySelector(".navbar-nav");
document.querySelector("#hamburger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

// Toggle class active untuk search form
// Kegunaan: Menambahkan atau menghapus class "active" pada elemen search form saat tombol pencarian diklik.
// Letaknya: Setelah pengaturan hamburger menu, untuk mengatur interaksi dengan form pencarian.
const searchForm = document.querySelector(".search-form");
const searchBox = document.querySelector("#search-box");
document.querySelector("#search-button").onclick = (e) => {
  searchForm.classList.toggle("active");
  searchBox.focus(); // Memberikan fokus pada input pencarian.
  e.preventDefault(); // Mencegah aksi default tombol.
};

// Toggle class active untuk shopping cart
// Kegunaan: Menambahkan atau menghapus class "active" pada elemen shopping cart saat tombol keranjang belanja diklik.
// Letaknya: Setelah pengaturan search form, untuk mengatur interaksi dengan keranjang belanja.
const shoppingCart = document.querySelector(".shopping-cart");
document.querySelector("#shopping-cart-button").onclick = (e) => {
  shoppingCart.classList.toggle("active");
  e.preventDefault(); // Mencegah aksi default tombol.
};

// Klik di luar elemen
// Kegunaan: Menutup elemen yang memiliki class "active" (navbar, search form, atau shopping cart) jika pengguna mengklik di luar elemen tersebut.
// Letaknya: Setelah pengaturan interaksi elemen utama.
const hm = document.querySelector("#hamburger-menu");
const sb = document.querySelector("#search-button");
const sc = document.querySelector("#shopping-cart-button");
document.addEventListener("click", function (e) {
  if (!hm.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active"); // Menutup navbar jika klik di luar.
  }

  if (!sb.contains(e.target) && !searchForm.contains(e.target)) {
    searchForm.classList.remove("active"); // Menutup search form jika klik di luar.
  }

  if (!sc.contains(e.target) && !shoppingCart.contains(e.target)) {
    shoppingCart.classList.remove("active"); // Menutup shopping cart jika klik di luar.
  }
});

// Modal Box
// Kegunaan: Menampilkan modal box saat tombol detail item diklik.
// Letaknya: Di bagian khusus untuk fitur modal box.
const itemDetailModal = document.querySelector("#item-detail-modal");
const itemDetailButtons = document.querySelectorAll(".item-detail-button");
itemDetailButtons.forEach((btn) => {
  btn.onclick = (e) => {
    itemDetailModal.style.display = "flex"; // Menampilkan modal box.
    e.preventDefault(); // Mencegah aksi default tombol.
  };
});

// klik tombol close modal
// Kegunaan: Menutup modal box saat tombol close diklik.
// Letaknya: Setelah pengaturan untuk membuka modal box.
document.querySelector(".modal .close-icon").onclick = (e) => {
  itemDetailModal.style.display = "none"; // Menutup modal box.
  e.preventDefault(); // Mencegah aksi default tombol.
};

// klik di luar modal
// Kegunaan: Menutup modal box jika pengguna mengklik di luar area modal.
// Letaknya: Di bagian akhir pengaturan modal box.
window.onclick = (e) => {
  if (e.target === itemDetailModal) {
    itemDetailModal.style.display = "none"; // Menutup modal box.
  }
};

// AI
// Hero Slider
const sliderImages = document.querySelectorAll(".hero-slider img");
let currentIndex = 0;

function updateSlider(index) {
  sliderImages.forEach((img, i) => {
    img.classList.remove("active", "previous");
    if (i === index) {
      img.classList.add("active");
    } else if (i === (index - 1 + sliderImages.length) % sliderImages.length) {
      img.classList.add("previous");
    }
  });
}

// Auto-slide every 5 seconds
setInterval(() => {
  currentIndex = (currentIndex + 1) % sliderImages.length;
  updateSlider(currentIndex);
}, 5000);

// Informasi Section
document.querySelectorAll(".info-link").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault(); // Mencegah navigasi default
    const modal = document.createElement("div");
    modal.classList.add("modal");
    const img = document.createElement("img");
    img.src = this.href; // Mengambil tautan gambar dari href
    modal.appendChild(img);
    document.body.appendChild(modal);

    // Tampilkan modal
    modal.classList.add("active");

    // Tutup modal saat diklik
    modal.addEventListener("click", () => {
      modal.classList.remove("active");
      modal.remove();
    });
  });
});

// Galeri Section
const modal = document.querySelector(".modal");
const modalImg = document.querySelector("#modal-img");
const downloadLink = document.querySelector("#download-link");

document.querySelectorAll(".galeri-img").forEach((img) => {
  img.addEventListener("click", () => {
    modalImg.src = img.src; // Set image source in modal
    downloadLink.href = img.src; // Set download link
    modal.classList.add("active"); // Show modal
  });
});

modal.addEventListener("click", () => {
  modal.classList.remove("active"); // Hide modal when clicked
});
