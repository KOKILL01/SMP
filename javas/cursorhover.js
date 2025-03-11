document.addEventListener('DOMContentLoaded', function () {
    const area = document.getElementById('mb');

    area.addEventListener('mousemove', function () {
        area.style.cursor = "url('../imagen/nuevoCursor.png') 16 16, auto";
    });


    



});

document.addEventListener('DOMContentLoaded', function() {
    const but = document.getElementById('butonOver');
    
    if (but) {
        but.addEventListener('mouseover', function() {
            but.style.backgroundColor = '#f57a7a';
        });
        but.addEventListener('mouseout', function() {
            but.style.backgroundColor = ''; 
        });
    }
});










