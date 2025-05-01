document.getElementById('loanForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Display a message indicating form submission (this could be replaced with actual submission code)
    document.getElementById('formMessage').innerText = 'Your application has been submitted successfully!';

    // You can also use fetch or XMLHttpRequest to send form data to your server
    
    const formData = new FormData(this);

    fetch('loan_application.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        // Handle success
        document.getElementById('formMessage').innerText = 'Your application has been submitted successfully!';
        setTimeout(function() {
            window.location.href = 'Bankpage.html';
        }, 2000);
    })
    .catch(error => {
        // Handle error
        document.getElementById('formMessage').innerText = 'There was an error submitting your application. Please try again.';
    });
    
});
