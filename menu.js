ocument.getElementById('priceRange').addEventListener('input', function() {
    document.getElementById('priceValue').textContent = this.value;
});

document.getElementById('filterBtn').addEventListener('click', function() {
    let priceLimit = document.getElementById('priceRange').value;
    let products = document.querySelectorAll('.product-item');

    products.forEach(function(product) {
        let productPrice = parseInt(product.getAttribute('data-price'));
        if (productPrice > priceLimit) {
            product.style.display = 'none';
        } else {
            product.style.display = 'block';
        }
    });
});

// Dropdown functionality
var dropdown = document.getElementsByClassName("dropdown-btn");
for (let i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}