<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIT Esports Club - Join Us</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Quick form styling for a clean UI */
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button[type="submit"] { background-color: #00d2ff; color: #1e1e2f; padding: 10px 20px; border: none; font-weight: bold; cursor: pointer; transition: 0.3s; }
        button[type="submit"]:hover { background-color: #1e1e2f; color: #00d2ff; }
        .success { color: green; font-weight: bold; margin-bottom: 15px; padding: 10px; background: #e8f5e9; border: 1px solid #c8e6c9; }
        .error { color: red; font-weight: bold; margin-bottom: 15px; }
    </style>
</head>
<body>

    <header>
        <h1>HIT Esports & Competitive Gaming Club</h1>
        <p id="greeting-message">Join the Roster.</p>
    </header>
    
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="events.html">Events</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="contact.php">Join Us</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>Player Registration Form</h2>
            <p>Fill out your details to officially join the HIT Esports Club. All fields are required.</p>

            <?php
            
            $servername = "localhost";
            $username = "root"; 
            $password = "Nyika@2005";     
            $dbname = "esports_club";

            
            $conn = new mysqli($servername, $username, $password, $dbname);

            
            if ($conn->connect_error) {
                die("<p class='error'>Connection failed: " . $conn->connect_error . "</p>");
            }

            // Server-Side Logic: Process Form Submission
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                // Sanitize user inputs to prevent SQL Injection
                $name = $conn->real_escape_string($_POST['student_name']);
                $student_id = $conn->real_escape_string($_POST['student_id']);
                $email = $conn->real_escape_string($_POST['email']);
                $game = $conn->real_escape_string($_POST['primary_game']);

                $sql = "INSERT INTO members (student_name, student_id, email, primary_game) 
                        VALUES ('$name', '$student_id', '$email', '$game')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='success'>Registration successful! Welcome to the squad, $name.</div>";
                } else {
                    echo "<div class='error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                }
            }
            ?>

            
            <form name="joinForm" action="contact.php" method="POST" onsubmit="return validateJoinForm()">
                <div class="form-group">
                    <label for="student_name">Full Name:</label>
                    <input type="text" id="student_name" name="student_name" required>
                </div>
                
                <div class="form-group">
                    <label for="student_id">HIT Student ID:</label>
                    <input type="text" id="student_id" name="student_id" placeholder="e.g., H210123M" required>
                </div>

                <div class="form-group">
                    <label for="email">Campus Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="primary_game">Primary Game Division:</label>
                    <select id="primary_game" name="primary_game" required>
                        <option value="">-- Select a Game --</option>
                        <option value="Call of Duty Mobile">Call of Duty Mobile</option>
                        <option value="Cuphead">Cuphead</option>
                        <option value="General/Other">General / Multi-genre</option>
                    </select>
                </div>

                <button type="submit" name="submit">Submit Application</button>
            </form>
        </section>

        <section>
            <h3>Newest Recruits</h3>
            <p>Welcome our latest members who just joined the ranks!</p>
            <ul>
                <?php
                // Server-Side Logic: Retrieve and Display Data
                $fetch_sql = "SELECT student_name, primary_game, join_date FROM members ORDER BY id DESC LIMIT 5";
                $result = $conn->query($fetch_sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        // Format the date using PHP
                        $date = date("M j, Y", strtotime($row["join_date"]));
                        echo "<li><strong>" . htmlspecialchars($row["student_name"]) . "</strong> joined the <em>" . htmlspecialchars($row["primary_game"]) . "</em> division on $date.</li>";
                    }
                } else {
                    echo "<li>No recruits yet. Be the first to join!</li>";
                }

                $conn->close();
                ?>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 HIT Esports & Competitive Gaming Club. All rights reserved.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>