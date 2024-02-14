<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterReads Search</title>
</head>
<body>
    <h1 style="text-align: center;">BetterReads</h1>
    <form method="GET" action="search.php" style="text-align: center;">
    <input type="text" name="q" placeholder="Search..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">        <select name="genres[]" id="genres" multiple>
    <option value="Business">Business</option>
    <option value="History">History</option>
    <option value="Non-fiction">Non-fiction</option>
    <option value="Philosophy">Philosophy</option>
    <option value="Psychology">Psychology</option>
    <option value="Science">Science</option>
    <option value="Art">Art</option>
    <option value="Travel">Travel</option>
    <option value="Theology">Theology</option>
    <option value="Social Science">Social Science</option>
    <option value="Sociology">Sociology</option>
    <option value="Economics">Economics</option>
    <option value="Mathematics">Mathematics</option>
    <option value="Music">Music</option>
    <option value="Law">Law</option>
    <option value="Roman">Roman</option>
    <option value="Health">Health</option>
    <option value="German Literature">German Literature</option>
    <option value="Classics">Classics</option>
    <option value="Biography">Biography</option>
    <option value="Engineering">Engineering</option>
    <option value="Programming">Programming</option>
    <option value="Computer Science">Computer Science</option>
    <option value="Archaeology">Archaeology</option>
    <option value="Art History">Art History</option>
    <option value="Finance">Finance</option>
    <option value="Software">Software</option>
    <option value="Information Science">Information Science</option>
    <option value="Library Science">Library Science</option>
    <option value="Neuroscience">Neuroscience</option>
    <option value="Personal Development">Personal Development</option>
    <option value="Politics">Politics</option>
    <option value="Productivity">Productivity</option>
    <option value="Read For College">Read for College</option>
    <option value="Read For School">Read for School</option>
    <option value="Research">Research</option>
    <option value="Robots">Robots</option>
    <option value="Science Nature">Science Nature</option>
    <option value="Teaching">Teaching</option>
    <option value="Technology">Technology</option>
</select>
        <button type="submit">Search</button>
    </form>
    
    <?php
    // Check if form submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['q'])) {
        // Solr query parameters
        $params = [
            'q' => '(title:"' . $_GET['q'] . '"~2 OR description:"' . $_GET['q'] . '"~2)', // Fuzzy search query with edit distance of 2        
        ];

        if (isset($_GET['genres']) && is_array($_GET['genres'])) {
            // Filter by genres
            $params['fq'] = 'genres:(' . implode(' OR ', array_map('htmlspecialchars', $_GET['genres'])) . ')';        
        }

        // Build Solr query URL
        $solr_query_url = 'http://localhost:8983/solr/BooksSolr/select?' . http_build_query($params);

        // Execute Solr query
        $response = file_get_contents($solr_query_url);

        // Decode Solr response
        $json_response = json_decode($response, true);

        // Display search results
        if ($json_response && isset($json_response['response']['docs'])) {
            echo '<h2>Search Results</h2>';
            echo '<ul>';
            foreach ($json_response['response']['docs'] as $doc) {
                // Generate clickable link for each search result
                echo '<li><a href="book.php?id=' . htmlspecialchars($doc['id']) . '">' . htmlspecialchars($doc['title']) . '</a>';
                if (!empty($doc['authors'][0])) {
                    echo '<br><em>' . htmlspecialchars($doc['authors'][0]) . '</em>'; // Display first author
                }
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No results found.</p>';
        }
    }
    ?>
</body>
</html>