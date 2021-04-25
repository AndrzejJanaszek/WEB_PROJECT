// NAZWY ZDJĘĆ
const box = document.getElementsByClassName("admin_form__imgbox")[0];
const firstIMG = box.getElementsByClassName("admin_form__imgbox__label")[0];
const add_img_btn = box.getElementsByClassName("admin_form__imgbox__addbtn")[0];

function RemoveParent(){
    if(this.parentNode.getAttribute("data-id") == document.getElementsByClassName("primary_input")[0].value){
        // getElementsByClassName("primary_input")[0].value = "0";
        ResetPrimaryIMG();
    }

    this.parentNode.remove();

// recalculate

    el_index = 0;
    for(el of document.getElementsByClassName("admin_form__imgbox__label")){
        console.log("asd");
        el.setAttribute("data-id", el_index);
        el_index++;
    }

    document.getElementsByClassName("primary_input")[0].value = document.getElementsByClassName("primary_btn--active")[0].parentNode.getAttribute("data-id");
}

function AddImgInput(){
    const rmBtn = document.createElement("div");
    rmBtn.classList.add("admin_form__imgbox__label__rmbtn");
    rmBtn.textContent = "X";
    rmBtn.addEventListener("click", RemoveParent);

    const primBtn = document.createElement("div");
    primBtn.classList.add("admin_form__imgbox__label__primbtn");
    primBtn.textContent = "M";
    primBtn.addEventListener("click", SetPrimaryIMG);


    let element = firstIMG.cloneNode(true);
    element.appendChild(rmBtn);
    element.appendChild(primBtn);
    element.setAttribute("data-id", box.getElementsByClassName("admin_form__imgbox__label").length);




    box.appendChild(element);
    // element.querySelector("input").value="";
}

// PLATFORMY



const plat_box = document.getElementsByClassName("admin_form__platform_label")[0];
const firstPLAT = plat_box.getElementsByClassName("admin_form__platform_label__select_box")[0];
const add_plat_btn = plat_box.parentNode.getElementsByClassName("admin_form__platform_label__addbtn")[0];


function AddPlatformSelect(){
    const rmBtn = document.createElement("div");
    rmBtn.classList.add("admin_form__platform_label__rmbtn");
    rmBtn.textContent = "X";
    rmBtn.addEventListener("click", RemoveParent);

    let element = firstPLAT.cloneNode(true);
    element.appendChild(rmBtn);

    plat_box.appendChild(element);
    // element.querySelector("input").value="";
}

// KATEGORIE

const cat_box = document.getElementsByClassName("admin_form__category_label")[0];
const firstCAT = cat_box.getElementsByClassName("admin_form__category_label__select_box")[0];
const add_cat_btn = cat_box.parentNode.getElementsByClassName("admin_form__category_label__addbtn")[0];


function AddCategorySelect(){
    console.log("asdsad");
    const rmBtn = document.createElement("div");
    rmBtn.classList.add("admin_form__category_label__rmbtn");
    rmBtn.textContent = "X";
    rmBtn.addEventListener("click", RemoveParent);

    let element = firstCAT.cloneNode(true);
    element.appendChild(rmBtn);

    cat_box.appendChild(element);
    // element.querySelector("input").value="";
}

function ResetPrimaryIMG(){
    for(el of buttony){
        el.classList.remove("primary_btn--active");
    }
    document.getElementsByClassName("admin_form__imgbox__label__primbtn")[0].classList.add("primary_btn--active");
    document.getElementsByClassName("primary_input")[0].value = "0";
}

function SetPrimaryIMG(reset){
    const primaryInput = document.getElementsByClassName("primary_input")[0];
    primaryInput.value = this.parentNode.getAttribute("data-id");

    buttony = document.getElementsByClassName("admin_form__imgbox__label__primbtn");

    for(el of buttony){
        el.classList.remove("primary_btn--active");
    }

    if(!this.classList.contains("primary_btn--active")){
        this.classList.add("primary_btn--active");
    }
}






document.getElementsByClassName("admin_form__imgbox__label__primbtn")[0].addEventListener("click", SetPrimaryIMG);
add_img_btn.addEventListener("click", AddImgInput);
add_plat_btn.addEventListener("click", AddPlatformSelect);
add_cat_btn.addEventListener("click", AddCategorySelect);