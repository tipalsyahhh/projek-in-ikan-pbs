//js vidio
let currentSlide = 0;

function geserVideo(n) {
    showSlide(currentSlide += n);
}

function showSlide(n) {
    let videoItems = document.getElementsByClassName("video-item");

    if (n >= videoItems.length) {
        currentSlide = 0;
    }

    if (n < 0) {
        currentSlide = videoItems.length - 1;
    }

    for (let i = 0; i < videoItems.length; i++) {
        videoItems[i].classList.remove("active");
        videoItems[i].style.display = "none";
    }

    let directionClass = (n > currentSlide) ? "slide-left" : "slide-right";

    videoItems[currentSlide].style.display = "flex";
    videoItems[currentSlide].classList.add("active", directionClass);

    setTimeout(() => {
        videoItems[currentSlide].classList.remove(directionClass);
    }, 10);
}
//js card
let currentIndex = 0;
const cards = document.querySelectorAll('.card-even-comentar');
const totalCards = cards.length;
const cardsToShowDesktop = 3;
const cardsToShowMobile = 1; // Jumlah kartu yang akan ditampilkan pada layar ponsel
const cardContainer = document.querySelector('.card-container');

// Tampilkan card pertama secara default
showCards();

cardContainer.style.transition = 'transform 1.5s ease-in-out';

function showCards() {
    for (let i = 0; i < totalCards; i++) {
        const card = cards[i];
        const isVisible = i >= currentIndex && i < currentIndex + getCardsToShow();
        card.style.display = isVisible ? 'block' : 'none';
        card.classList.toggle('active', i === currentIndex);
        card.classList.toggle('slide-animation', isVisible);
    }
}

function nextCards() {
    currentIndex = (currentIndex + getCardsToShow()) % totalCards;
    showCards();
}

function prevCards() {
    currentIndex = (currentIndex - getCardsToShow() + totalCards) % totalCards;
    showCards();
}

// Fungsi untuk mendapatkan jumlah kartu yang ditampilkan berdasarkan lebar layar
function getCardsToShow() {
    return window.innerWidth < 768 ? cardsToShowMobile : cardsToShowDesktop;
}

// Tambahkan event listener untuk menanggapi perubahan ukuran layar
window.addEventListener('resize', showCards);
