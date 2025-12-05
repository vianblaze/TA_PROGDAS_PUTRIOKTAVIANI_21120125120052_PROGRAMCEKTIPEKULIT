const buttons = document.querySelectorAll(".cat-btn");
const products = document.querySelectorAll(".product-card");
const searchInput = document.getElementById("searchInput");

buttons.forEach(btn => {
    btn.addEventListener("click", () => {

        // aktifkan tombol yg diklik
        buttons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const type = btn.getAttribute("data-type");

        products.forEach(p => {
            const pType = p.getAttribute("data-type");

            if (type === "all" || type === pType) {
                p.style.display = "flex";
            } else {
                p.style.display = "none";
            }
        });
    });
});

searchInput.addEventListener("keyup", () => {
    const value = searchInput.value.toLowerCase();

    products.forEach(p => {
        const name = p.querySelector(".p-name").innerText.toLowerCase();
        p.style.display = name.includes(value) ? "flex" : "none";
    });
});