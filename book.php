<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
</head>
<body>
    <h1 style="text-align: center;">Book Details</h1>
    
    <?php
    // Check if book ID is provided in URL
    if (isset($_GET['id'])) {
        // Solr query parameters
        $params = [
            'q' => 'id:' . $_GET['id'], // Search query by book ID
        ];

        // Build Solr query URL
        $solr_query_url = 'http://localhost:8983/solr/BooksSolr/select?' . http_build_query($params);

        // Execute Solr query
        $response = file_get_contents($solr_query_url);

        // Decode Solr response
        $json_response = json_decode($response, true);

        // Display book details
        if ($json_response && isset($json_response['response']['docs'][0])) {
            $book = $json_response['response']['docs'][0];
            echo '<h2>' . htmlspecialchars($book['title']) . '</h2>'; // Ensure to access the first element of the title array
            echo '<p><strong>Authors:</strong> ' . implode(', ', $book['authors']) . '</p>';
            echo '<p><strong>Description:</strong> ' . htmlspecialchars($book['description'][0]) . '</p>'; // Ensure to access the first element of the description array
            echo '<p><strong>Genres:</strong> ' . implode(', ', $book['genres']) . '</p>';
            echo '<p><strong>Published:</strong> ' . htmlspecialchars($book['published'][0]) . '</p>'; // Ensure to access the first element of the published array
            echo '<p><strong>Goodreads URL:</strong> <a href="' . htmlspecialchars($book['url'][0]) . '">' . htmlspecialchars($book['url'][0]) . '</a></p>'; // Ensure to access the first element of the url array
        } else {
            echo '<p>Book not found.</p>';
        }
    } else {
        echo '<p>Book ID not provided.</p>';
    }
    ?>
</body>
</html>
