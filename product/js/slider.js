const slider = document.getElementsByClassName("slider")[0];
const primaryIMG = document.querySelector(".primary_img > img");

function changeIMG(){
    console.log(primaryIMG.src);
    tmp = primaryIMG.src;
    primaryIMG.src = this.src;
    this.src = tmp;

}

for(img of slider.getElementsByClassName("slider__img")){
    img.addEventListener("click", changeIMG);
}




const add_product_to_cart_BTN = document.getElementsByClassName("add_to_shopping_cart_btn")[0];


function AddProductToShoppingcart(){
    const id = this.getAttribute("data-id");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("ESSA SITO");
            console.log(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET","../processing_php/add_product_to_shopping_cart.php?product_id="+id,true);
    xmlhttp.send();
}

add_product_to_cart_BTN.addEventListener("click", AddProductToShoppingcart);