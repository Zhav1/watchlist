 function reveal() {
    let reveals = document.querySelectorAll(".reveal");
  
    for (let i = 0; i < reveals.length; i++) {
      let tinggi = window.innerHeight;
      let top = reveals[i].getBoundingClientRect().top;
      let visible = 150;
  
      if (top < tinggi - visible) {
        reveals[i].classList.add("active");
      } else {
        reveals[i].classList.remove("active");
      }
    }
  }
  
  window.addEventListener("scroll", reveal);