// the ui animartion part
const offerBody = document.querySelector('.offer');
const remove = document.querySelector('#delete-off');
const confirmDelete = document.querySelector('.delete-offer');

 // Find the body element
const body = document.getElementsByTagName('body')[0];
// blur function for tha background
function doBlur(){
  
  offerBody.style.filter = "blur(10px)";
  
}
function removeBlur(){
  
  offerBody.style.filter = "blur(0)";
  
  
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