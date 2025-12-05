(function () {
    const track = document.getElementById("sliderTrack");
    if (!track) return;

    const prev = document.getElementById("prevBtn");
    const next = document.getElementById("nextBtn");
    const dotsWrap = document.getElementById("sliderDots");

    const slides = Array.from(track.children);
    const total = slides.length;
    let index = 0;

    // Create dots
    slides.forEach((_, i) => {
        const dot = document.createElement("button");
        dot.className = "dot";
        dot.dataset.id = i;
        dot.addEventListener("click", () => goTo(i));
        dotsWrap.appendChild(dot);
    });

    function update() {
        track.style.transform = `translateX(-${index * 100}%)`;

        const dots = dotsWrap.querySelectorAll(".dot");
        dots.forEach((d, i) => d.classList.toggle("active", i === index));
    }

    function goTo(i) {
        index = (i + total) % total;
        update();
    }

    function move(step) {
        index = (index + step + total) % total;
        update();
    }

    prev.addEventListener("click", () => move(-1));
    next.addEventListener("click", () => move(1));

    update();
})();