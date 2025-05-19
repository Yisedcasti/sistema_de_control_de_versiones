let currentIndex = 0;
const slides = document.querySelectorAll('.carousel .card-container');

function moveSlide(direction) {
    const totalSlides = slides.length;
    currentIndex = (currentIndex + direction + totalSlides) % totalSlides;
    const offset = -currentIndex * 100; // Adjusted width of carousel item

    document.querySelector('.carousel').style.transform = `translateX(${offset}%)`;
}