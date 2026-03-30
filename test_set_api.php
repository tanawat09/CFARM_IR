<?php

$apiKey = getenv('SET_API_KEY');

if ($apiKey === false || $apiKey === '') {
    fwrite(STDERR, "SET_API_KEY is required.\n");
    exit(1);
}

// Test various endpoints
$urls = [
    'https://api.set.or.th/api/v1/reference/getCorporateAction?symbol=CFARM',
    'https://api.set.or.th/api/v1/news?symbol=CFARM'
];

foreach ($urls as $url) {
    echo "Testing $url\n";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
        'Content-Type: application/json',
        'x-api-key: ' . $apiKey,
        'Ocp-Apim-Subscription-Key: ' . $apiKey,
        'Authorization: Bearer ' . $apiKey
    ]);

    $output = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "HTTP Code: $http_code\n";
    echo "Response: " . substr($output, 0, 200) . "\n\n";
}


