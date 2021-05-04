const cart_value = document.getElementsByClassName("cart__value")[0];

function UpdateCartValue(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cart_value.textContent = this.responseText;
        }
    };
    xhttp.open("GET", "http://menyl.ct8.pl/WEB_PROJEKT/processing_php/shopping_cart_value.php", true);
    // xhttp.open("GET", "127.0.0.1/WEB_PROJECT/processing_php/shopping_cart_value.php", true);
    xhttp.send();
}

window.onload = UpdateCartValue();