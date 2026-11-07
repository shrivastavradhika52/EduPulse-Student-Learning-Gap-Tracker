
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPulse - Improvement Comparison</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div>
            <h1>EduPulse</h1>
            <p>Student Learning Gap Tracker</p>
        </div>
        <span class="teacher-label">Teacher Dashboard</span>
    </header>

    <div class="layout">
        <aside class="sidebar">
            <h3>EduPulse Menu</h3>
            <a href="index.php#dashboard">Dashboard</a>
            <a href="index.php#students">Student Details</a>
            <a href="index.php#performance">Performance</a>
            <a href="index.php#progress">Progress Tracking</a>
            <a href="comparison.php">Improvement Comparison</a>
        </aside>

        <main>
            <section>
                <h2>Improvement Comparison</h2>
                <p>Compare previous and latest test marks to track student improvement.</p>

                <form id="comparisonForm">
                    <label for="compareRoll">Student Roll Number</label>
                    <input type="text" id="compareRoll"
                           placeholder="Enter student roll number" required>

                    <label for="compareSubject">Subject</label>
                    <input type="text" id="compareSubject"
                           placeholder="Enter subject" required>

                    <label for="previousMarks">Previous Test Marks</label>
                    <input type="number" id="previousMarks"
                           min="0" max="100" placeholder="Enter previous marks" required>

                    <label for="latestMarks">Latest Test Marks</label>
                    <input type="number" id="latestMarks"
                           min="0" max="100" placeholder="Enter latest marks" required>

                    <button type="submit">Compare Performance</button>
                </form>

                <div id="comparisonResult"></div>
            </section>
        </main>
    </div>

    <footer>
        <p>EduPulse | Student Learning Gap Tracker</p>
        <p>Developed by: Your Name | Enrollment No: Your Enrollment Number</p>
    </footer>

    <script src="comparison.js"></script>
</body>
</html>
