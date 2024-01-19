const productDetails = {
    "Type A": "<b>Produkttype</b> Vifte<br><br><b>Type A har</b> Large Vifte, Hatisghet Høy, Pris 100kr",
    "Type B": "<b>Produkttype</b> Vifte<br><br><b>Type B har</b> Medium Vifte, Hatisghet Medium, Pris 75kr",
    "Type C": "<b>Produkttype</b> Vifte<br><br><b>Type C har</b> Small Vifte, Hatisghet Low, Pris 50kr"
};

function updateProductDetails() {
    const selectedTypes = Array.from(document.querySelectorAll("input[name='product_type']:checked")).map(input => input.value);

    let details = "";
    selectedTypes.forEach(type => {
        details += productDetails[type] + "<br><br>";
    });

    document.getElementById('productDetails').innerHTML = details;
}

document.querySelectorAll("input[name='product_type']").forEach(input => {
    input.addEventListener('change', updateProductDetails);
});

document.getElementById('addToCartBtn').addEventListener('click', function () {
    const selectedDetails = document.getElementById('productDetails').innerHTML;

    // Simulating adding the selected product details to the cart
    console.log('Added to cart:', selectedDetails);
    alert('Added to cart!'); // Simulated action, replace this with your actual cart functionality
});
