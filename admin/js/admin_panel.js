// NAZWY ZDJĘĆ
const box = document.getElementsByClassName("admin_form__imgbox")[0];
const firstIMG = box.getElementsByClassName("admin_form__imgbox__label")[0];
const add_img_btn = box.getElementsByClassName("admin_form__imgbox__addbtn")[0];

function RemoveParent(){
    this.parentNode.remove();
}

function AddImgInput(){
    const rmBtn = document.createElement("div");
    rmBtn.classList.add("admin_form__imgbox__label__rmbtn");
    rmBtn.textContent = "X";
    rmBtn.addEventListener("click", RemoveParent);

    let element = firstIMG.cloneNode(true);
    element.appendChild(rmBtn);

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








add_img_btn.addEventListener("click", AddImgInput);
add_plat_btn.addEventListener("click", AddPlatformSelect);
add_cat_btn.addEventListener("click", AddCategorySelect);