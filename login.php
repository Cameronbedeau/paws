<?php
// Airtable API base URL and your API key
$baseId = 'appQcwS2LWEk4XDSq'; // Your Base ID (note: don't include the /tbl part in the Base ID)
$tableName = 'tblGbBTIa6Z09y3RK'; // Your Table Name (from the Airtable API docs)
$apiKey = 'patyoi2yiKRQbMN5A.03afa4485802979516120aa91dd798d80ae8970de2980c1e5f5738052fc8b933'; // Your Airtable API key

// Setup the API URL
$apiUrl = "https://api.airtable.com/v0/$baseId/$tableName";

// Handle incoming POST request to create a record in Airtable
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data (e.g., Name, Email, etc.)
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    
    // Construct the data to send to Airtable
    $data = [
        "fields" => [
            "Name" => $name,
            "Email" => $email
        ]
    ];

    // Set up the cURL request
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    // Execute the cURL request and handle the response
    $response = curl_exec($ch);
    curl_close($ch);
    
    // You can handle the response here (e.g., show a confirmation message)
    echo "Record successfully created!";
} else {
    // Handle GET requests to fetch records from Airtable (e.g., to display records)
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Display the data
    echo $response;
}
?>
