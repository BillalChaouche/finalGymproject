formEdit = document.querySelector('.form'); 
deleteBtn = document.querySelector('#remove'); 
confirmDelete = document.querySelector('.delete-owner')



deleteBtn.addEventListener('click',function(event){  
    event.preventDefault();
    formEdit.style.filter = "blur(10px)";
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
    formEdit.style.filter = "blur(0)";
  ;
  });
  