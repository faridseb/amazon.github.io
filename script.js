const Openbutton = document.querySelector('.fa-bag-shopping');
const cart = document.querySelector('.cart');
const closeButton = document.querySelector('.fa-xmark');
const navlinks = document.querySelector('.navlinks');
const button1 = document.querySelector('#icones'); 
const button2 = document.querySelector('#icones2');
const button3 = document.querySelector('#Open');
const divSearch = document.querySelector('.search');
const search = document.querySelector('.fa-magnifying-glass');
const closeSearch = document.querySelector('#croix');
const search2 = document.querySelector('#icon2')


search.onclick = () =>{
    divSearch.classList.add('searches');
}
search2.onclick = () =>{
    divSearch.classList.add('searches');
}
closeSearch.onclick = () =>{
    divSearch.classList.remove('searches');
}


button3.onclick = () => {
    cart.classList.add('active');
}

button2.onclick = () =>{
    navlinks.classList.add('open');
}

button1.onclick = () =>{
    navlinks.classList.remove('open');
}

Openbutton.onclick = () => {
    cart.classList.add('active');
}

closeButton.onclick = () => {
    cart.classList.remove('active');
}





if(document.readyState == "loading"){
    document.addEventListener("DOMContentLoaded", ready);
} 

else{
    ready();
}


function ready(){
    var removebutton = document.getElementsByClassName('fa-trash');
    for(var i =0 ; i<removebutton.length ; i++){
        var button = removebutton[i];
        button.addEventListener('click',removeitem);
    }

    var addcart = document.getElementsByClassName('addcart');
    for(var i=0 ; i<addcart.length ; i++){
        var button = addcart[i];
        button.addEventListener('click',addcartclick)
    }

    var quantityInputs = document.getElementsByClassName('quantity');
    for(var i=0 ; i<quantityInputs.length ; i++){
        var inputs = quantityInputs[i];
        inputs.addEventListener('change',quantitychange);
    }

    
    document.getElementsByClassName('buy-btn')[0]
    .addEventListener('click',buyButtonClicked);

    updatotal();
    loadCartitems();
}


function removeitem(event){
    var buttonclicked = event.target ;
    buttonclicked.parentElement.remove();
    updatotal();
    saveCartitems()
    updateCarticon();
}

function quantitychange(event){
    var input = event.target ;
    if(isNaN(input.value) || input.value <= 0){
        input.value = 1
    }
    updatotal() ;
    saveCartitems();
    updateCarticon();
}

function buyButtonClicked(){
    alert('Votre commande est placer');
    var cartContent = document.getElementsByClassName('cartcontent')[0]
    while(cartContent.hasChildNodes()){
        cartContent.removeChild(cartContent.firstChild);
    }
    updatotal();
    updateCarticon();
}

function addcartclick(event){
    var buttonclicked = event.target ;
    var shoproduct = buttonclicked.parentElement ;
    var title = shoproduct.getElementsByClassName('product-title')[0].innerText;
    var price = shoproduct.getElementsByClassName('product-price')[0].innerText;
    var productimg = shoproduct.getElementsByClassName('product-img')[0].src;

    
    addCartToHTML(title,price,productimg);
    updatotal() ;
    saveCartitems();
    updateCarticon()
}


function addCartToHTML(title,price,productimg){
    var cartboxShop = document.createElement('div');
    cartboxShop.classList.add('cart-box');
    var cartItems = document.getElementsByClassName('cartcontent')[0];
    var cartItemsNames = cartItems.getElementsByClassName('title') ;

    for(var i=0 ; i< cartItemsNames.length ; i++){
        if(cartItemsNames[i].innerText == title){
            alert('ARTICLE DEJA SELECTIONNER');
            return ;
        }
        
    }
    
    var cartshopcontent = ` <img src="${productimg}" alt="" class="imagez">
    <div class="details-box">
        <div class="title">${title}</div>
        <div class="price">${price}</div>
        <input type="number" value="1" class="quantity">
    </div>
    <i class="fa-solid fa-trash"></i>` ;

    cartboxShop.innerHTML = cartshopcontent ;
    cartItems.appendChild(cartboxShop);

    cartboxShop.getElementsByClassName('fa-trash')[0].addEventListener('click',removeitem);
    cartboxShop.getElementsByClassName('quantity')[0].addEventListener('change',quantitychange);
    updateCarticon();
    saveCartitems()

}

function updatotal(){
    var cartcontent = document.getElementsByClassName('cartcontent')[0];
    var cartboxes = cartcontent.getElementsByClassName('cart-box');
    var total = 0 ;

    for(var i=0 ; i<cartboxes.length ; i++){
        var cartbox = cartboxes[i];
        var priceElement = cartbox.getElementsByClassName('price')[0];
        var quantityElement = cartbox.getElementsByClassName('quantity')[0];
        var price = priceElement.innerText ;
        var quantity = quantityElement.value ;

        total += quantity*price ;
    }
    document.getElementsByClassName('total-price')[0].innerText = total + 'Fcfa' ;
    localStorage.setItem('cartTotal',total)
}

function saveCartitems(){
    var cartcontent = document.getElementsByClassName('cartcontent')[0];
    var cartboxes = cartcontent.getElementsByClassName('cart-box');
    var cartItems = [];

    for(var i=0 ; i< cartboxes.length ; i++){
        var cartbox = cartboxes[i];
        var titleElement = cartbox.getElementsByClassName('title')[0];
        var priceElement = cart.getElementsByClassName('price')[0];
        var quantityElement = cartbox.getElementsByClassName('quantity')[0];
        var productimg = cartbox.getElementsByClassName('imagez')[0].src;
    
    
    var items = {
        title : titleElement.innerText,
        price : priceElement.innerText,
        quantity : quantityElement.value,
        productimg : productimg,
    };

    cartItems.push(items);
    }
    localStorage.setItem('cartItems',JSON.stringify(cartItems));
}

function loadCartitems(){
    var cartItems = localStorage.getItem('cartItems');
    if(cartItems){
        cartItems = JSON.parse(cartItems);
    

    for(var i =0 ; i<cartItems.length ; i++){
        var item = cartItems[i];
        addCartToHTML(item.title, item.price ,item.productimg);

        var cartboxes = document.getElementsByClassName('cart-box');
        var cartbox = cartboxes[cartboxes.length -1];
        var quantityElement = cartbox.getElementsByClassName('quantity')[0];
        quantityElement.value = item.quantity ;
        }
    }
    var cartTotal = localStorage.getItem('cartTotal');
    if(cartTotal){
        document.getElementsByClassName('total-price')[0].innerText = cartTotal ;
    }

    updatotal();
}

function updateCarticon(){
    var cartboxes = document.getElementsByClassName('cart-box');
    var quantity = 0 ;
    for(var i=0 ; i<cartboxes.length ;i++){
        var cartbox = cartboxes[i];
        var quantityElement = cartbox.getElementsByClassName('quantity')[0];
        quantity += parseInt(quantityElement.value);
    }
    var carticon = document.querySelector(".fa-bag-shopping");
    var carticon1 = document.querySelector('#Open');
    carticon.setAttribute('data-quantity',quantity);
    carticon1.setAttribute('data-quantity',quantity)
}
    