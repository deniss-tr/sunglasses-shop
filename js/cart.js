///////////// COOKIE /////////////
let decodedCookie = decodeURIComponent(document.cookie);
let arr = decodedCookie.substring(5)
let cart = JSON.parse(arr);

///////////// COUNTER /////////////
let counts = document.querySelectorAll('.item_count');
counts.forEach(element => {   
    let plus = element.previousElementSibling;
    let minus = element.nextElementSibling;
    plus.addEventListener('click', (e) => {
        e.preventDefault();
        let row = element.parentNode.parentNode;
        let productIndex = row.getAttribute('product_nr') - 1;
        element.value = Number(element.value) + 1;
        changeTotalPrice();
    })
    minus.addEventListener('click', (e) => {
        e.preventDefault();
        if ( element.value <= 1 ) {
            element.value = 1;
            changeTotalPrice();
            return;
        }
        element.value -= 1;
        changeTotalPrice();
    })
});

///////////// DELETE /////////////
let deleteBtns = document.querySelectorAll('.del');

deleteBtns.forEach(element => {
    element.addEventListener('click', () => {
        let row = element.parentNode.parentNode;
        let productIndex = row.getAttribute('product_nr') - 1;
        cart.splice(productIndex, 1);
        $cartString = JSON.stringify(cart);
        let newCart = "cart=" + $cartString;
        let cartCount = document.querySelector('.cart-count');
        cartCount.textContent -= 1;
        document.cookie = newCart;
        row.remove();
        changeTotalPrice();
    })
});

///////////// TOTAL PRICE /////////////

function changeTotalPrice() {
    let productRows = document.querySelectorAll('.product-row');
    let totalPrice = document.querySelector('.total');
    let productPices = [];
    productRows.forEach(element => {
        let productPrice = element.querySelector('.item-price').textContent;
        let productCount = element.querySelector('.item_count').value;
        let fullProductPrice = productPrice * productCount;
        productPices.push(fullProductPrice);
    });
    
    let fullAllProductsPrice = productPices.reduce((a, b) => a + b, 0);
    totalPrice.textContent = fullAllProductsPrice;
    
}

changeTotalPrice();