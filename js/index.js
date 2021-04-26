const add_product_to_cart_BTN = document.getElementsByClassName("product_box__content__btn");









function AddProductToShoppingcart(){
    const id = this.getAttribute("data-id");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("ESSA SITO");
            console.log(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET","processing_php/add_product_to_shopping_cart.php?product_id="+id,true);
    xmlhttp.send();
}
























for(btn of add_product_to_cart_BTN){
    btn.addEventListener("click", AddProductToShoppingcart);
}