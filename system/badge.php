<?php
// Set the header to return JSON
header('Content-Type: application/json');

// GitHub repository details
$owner = 'nickschnee'; // Replace with your GitHub username or organization name
$repo = '2025_im4_authentication_minimal_boilerplate'; // Replace with your repository name

// GitHub API endpoint
$apiUrl = "https://api.github.com/repos/$owner/$repo";

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'YourAppName'); // GitHub API requires a user-agent

$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    $data = json_decode($response, true);

    if (isset($data['pushed_at'])) {
        // Extract the `pushed_at` field and format the date
        $lastChanged = date('Y-m-d', strtotime($data['pushed_at']));

        // Create the Shields.io JSON response
        $badge = [
            'schemaVersion' => 1,
            'label' => 'last changed',
            'message' => $lastChanged,
            'color' => 'blue'
        ];

        // Output the JSON
        echo json_encode($badge);
    } else {
        // Handle errors if `pushed_at` is not found
        echo json_encode([
            'schemaVersion' => 1,
            'label' => 'last changed',
            'message' => 'error',
            'color' => 'red'
        ]);
    }
} else {
    // Handle errors if the API call fails
    echo json_encode([
        'schemaVersion' => 1,
        'label' => 'last changed',
        'message' => 'API error',
        'color' => 'red'
    ]);
}
?>
