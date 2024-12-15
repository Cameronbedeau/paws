document.getElementById("submitBtn").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent form submission from reloading the page
    
    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    
    // Gather form data
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;

    // Check if the required fields are filled
    if (!name || !email) {
        alert("Please fill in both name and email fields.");
        return;
    }

    // Data to send to the PHP script
    let formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);

    // Send data to PHP script using fetch
    fetch('airtable.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Handle the response from PHP
    .then(data => {
        alert(data); // Display the response from the PHP script
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
