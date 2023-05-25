const add = document.getElementById('add');
const done = document.getElementById('done');
const exit = document.getElementById('exit');
const formAdd = document.querySelector('.form-add');
const header = document.querySelector('.header');

// Find the body element
const body = document.getElementsByTagName('body')[0];
// create a new div element
var div = document.createElement("div");


// blur the background
const side = document.querySelector('.side');
const above = document.querySelector('.above');
const show = document.querySelector(".show-material");



// blur function for tha background
function doBlur(){
    above.style.filter = "blur(10px)";
    show.style.filter = "blur(10px)";
    side.style.filter = "blur(10px)";
    header.style.filter = "blur(10px)";

}
function removeBlur(){
    above.style.filter = "blur(0)";
    show.style.filter = "blur(0)";
    side.style.filter = "blur(0)";
    header.style.filter = "blur(0px)";

}

// add form
add.addEventListener('click',function(){
    
    doBlur();
    formAdd.classList.remove('remove');
    formAdd.classList.add('show');
})
exit.addEventListener('click',function(){
    formAdd.classList.remove('show');
    formAdd.classList.add('remove');
    removeBlur();
})
done.addEventListener('click',function(){
    formAdd.classList.remove('show');
    formAdd.classList.add('remove');
    removeBlur();
})



// the Ajax code

// get the common URL
