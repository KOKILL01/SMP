function fadeIn() {
    let box = document.getElementById("box");
    let b1 = document.getElementById("m");
    let b2 = document.getElementById("o");

    box.style.display = "block";
    b1.style.display="none";
    
    setTimeout(() => {
        box.style.opacity = 1; 
        b1.style.opacity = 0; 
        b2.style.display = "inline-block";
        setTimeout(() => {
            b2.style.opacity = 1; 
        }, 50);
    }, 10);
}

function fadeOut() {
    let box = document.getElementById("box");
    let b1 = document.getElementById("m"); 
    let b2 = document.getElementById("o"); 

    box.style.opacity = 0;
    b2.style.opacity = 0; 

    setTimeout(() => {
        box.style.display = "none"; 
        b1.style.opacity = 1; 
        b1.style.display = "inline-block";
        b2.style.display = "none";
    }, 1000); 
}



