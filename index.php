
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPulse - Student Learning Gap Tracker</title>
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
            <a href="#dashboard">Dashboard</a>
            <a href="#students">Student Details</a>
            <a href="#performance">Performance</a>
            <a href="#progress">Progress Tracking</a>
            <a href="comparison.php">Improvement Comparison</a>
            <a href="php-report.php">PHP Student Report</a>
        </aside>

        <main>

            <section id="dashboard">
                <h2>Welcome to EduPulse!</h2>
                <p>Monitor student performance and identify learning gaps.</p>

                <div class="summary">
                    <div class="card">
                        <h3>Total Students</h3>
                        <p id="totalStudents">0</p>
                    </div>

                    <div class="card">
                        <h3>Needs Improvement</h3>
                        <p id="needsImprovement">0</p>
                    </div>

                    <div class="card">
                        <h3>Improved Students</h3>
                        <p id="improvedStudents">0</p>
                    </div>
                </div>
            </section>

            <section id="students">
                <h2>Student Details</h2>

                <form id="studentForm">
                    <label for="studentName">Student Name</label>
                    <input type="text" id="studentName" placeholder="Enter student name" required>

                    <label for="rollNumber">Roll Number</label>
                    <input type="text" id="rollNumber" placeholder="Enter roll number" required>

                    <label for="studentClass">Class</label>
                    <input type="text" id="studentClass" placeholder="Enter class" required>

                    <button type="submit">Add Student</button>
                </form>

                <h3>Student Records</h3>
                <input type="text" id="searchStudent" placeholder="Search by name or roll number">
                <div id="studentList"></div>
            </section>

            <section id="performance">
                <h2>Subject Performance</h2>

                <form id="performanceForm">
                    <label for="performanceRoll">Student Roll Number</label>
                    <input type="text" id="performanceRoll" placeholder="Enter roll number" required>

                    <label for="subject">Subject</label>
                    <input type="text" id="subject" placeholder="Enter subject" required>

                    <label for="weakTopic">Weak Topic</label>
                    <input type="text" id="weakTopic" placeholder="Enter weak topic" required>

                    <label for="testMarks">Test Marks (out of 100)</label>
                    <input type="number" id="testMarks" placeholder="Enter marks" min="0" max="100" required>

                    <button type="submit">Submit Performance</button>
                </form>
            </section>

            <section id="progress">
                <h2>Student Progress</h2>
                <p>View student learning improvement and performance status.</p>
                <div id="progressList"></div>
            </section>

        </main>
    </div>

    <footer>
        <p>EduPulse | Student Learning Gap Tracker</p>
        <p>Developed By: Radhika | Web Technology Project </p>
    </footer>

    <script src="script.js"></script>

</body>
</html>
