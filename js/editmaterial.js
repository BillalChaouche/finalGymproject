// the ui animartion part
const remove = document.getElementById('remove');
const cancel = document.getElementById('cancel');
const inputs = document.querySelector('.inputs');
const stats = document.querySelector('.stats');
const submitBtns = document.querySelector('.submit');
const confirmDelete = document.querySelector('.delete-material');


 // Find the body element
const body = document.getElementsByTagName('body')[0];
// blur function for tha background
function doBlur(){
  inputs.style.filter = "blur(10px)";
  stats.style.filter = "blur(10px)";
  submitBtns.style.filter = "blur(10px)";
  
}
function removeBlur(){
  inputs.style.filter = "blur(0)";
  stats.style.filter = "blur(0)";
  submitBtns.style.filter = "blur(0)";
  
  
}

// show the delete confirmation div
remove.addEventListener('click',function(event){  
  event.preventDefault();
  doBlur();
  confirmDelete.classList.remove('remove-delete');
  confirmDelete.classList.add('show-delete');
  var start = Date.now();
  var duration = 100; // 0.5 seconds
  function animate() {
    var elapsed = Date.now() - start;
    var progress = Math.min(elapsed / duration, 1);
    confirmDelete.style.opacity = progress;
    if (progress < 1) {
      requestAnimationFrame(animate);
    }
  }
  animate();
});
cancel.addEventListener('click',function(event){
  event.preventDefault(); 
  
  confirmDelete.classList.remove('show-delete');
  confirmDelete.classList.add('remove-delete');
  removeBlur();
;
});


