document.addEventListener("DOMContentLoaded", function() {
    
    document.getElementById('submit').addEventListener('click', function(event) {
        
        event.preventDefault();

        //input email and pass
        const email = document.querySelector('.input-field[type="text"]').value;
        const password = document.querySelector('.input-field[type="password"]').value;

        // valid
        if (email && password) {

            //main pg
            window.location.href = "index.html";
        } else {
            //no email or pass
            alert("Please enter both email and password.");
        }
    });
});
