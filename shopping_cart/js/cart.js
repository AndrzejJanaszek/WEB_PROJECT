const sumBox = document.getElementsByClassName("shopping_cart__bottom__sum")[0];

const boxs = document.getElementsByClassName("product_box");

let suma = 0;
for(box of boxs){
    price = box.getElementsByClassName("product_box__sum")[0].textContent;

    suma +=parseFloat(price.slice(0, price.length-2)) ;
}
sumBox.textContent = suma + 'zł';


function ContinueShoping(e){
    window.location.href = "../index.php";
}

function ClearShoppingcart(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("ESSA SITO");
            console.log(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET","../processing_php/clear_shopping_cart.php",true);
    xmlhttp.send();
}

document.getElementsByClassName("continue_shoping_btn")[0].addEventListener("click", ContinueShoping);
document.getElementsByClassName("clear_cart_btn")[0].addEventListener("click", ClearShoppingcart);