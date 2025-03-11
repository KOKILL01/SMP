window.addEventListener("scroll", function() {
    let scrollTop = window.scrollY; 
    let maxScroll = document.body.scrollHeight - window.innerHeight;
    
  
    let colorValue = 243 - Math.min(243, Math.floor((scrollTop / maxScroll) * 243));

    
    document.getElementById("colorBox").style.backgroundColor = `rgb(${colorValue}, ${colorValue}, ${colorValue})`;
});