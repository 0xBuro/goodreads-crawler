<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterReads 📘</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', serif;
            font-size: 40px;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .search-bar {
            width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .submit-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .genres {
            margin-bottom: 20px;
        }
        .genre-checkbox {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>BetterReads 📘</h1>
        <form action="search.php" method="get">
        <input type="text" name="q" class="search-bar" placeholder="Search..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">       
        <br>    
        <div class="genres">
        <select name="genres[]" id="genres" multiple>
            <br><label for="genre">Filter by Genre:</label><br>
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


            </div>
            <button type="submit" class="submit-button">Search</button>
        </form>
    </div>
</body>
</html>
