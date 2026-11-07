
<?php
$studentName = "";
$rollNumber = "";
$subject = "";
$weakTopic = "";
$marks = "";
$status = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $studentName = htmlspecialchars(trim($_POST["studentName"]));
    $rollNumber = htmlspecialchars(trim($_POST["rollNumber"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $weakTopic = htmlspecialchars(trim($_POST["weakTopic"]));
    $marks = $_POST["marks"];

    if ($studentName == "" || $rollNumber == "" ||
        $subject == "" || $weakTopic == "" || $marks === "") {

        $message = "Please fill all the fields.";

    } elseif (!is_numeric($marks) || $marks < 0 || $marks > 100) {

        $message = "Please enter marks between 0 and 100.";

    } else {

        $marks = (int)$marks;

        if ($marks < 40) {
            $status = "Needs Improvement";
        } else {
            $status = "Improved";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPulse - PHP Student Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div>
        <h1>EduPulse</h1>
        <p>Student Learning Gap Tracker</p>
    </div>
    <span class="teacher-label">PHP Practical</span>
</header>

<div class="layout">
    <aside class="sidebar">
        <h3>EduPulse Menu</h3>
        <a href="index.php">Dashboard</a>
        <a href="comparison.php">Improvement Comparison</a>
        <a href="php-report.php">PHP Student Report</a>
    </aside>

    <main>
        <section>
            <h2>Student Learning Report</h2>
            <p>Enter student details to generate a performance report.</p>

            <form method="POST" action="php-report.php">

                <label>Student Name</label>
                <input type="text" name="studentName"
                       value="<?php echo $studentName; ?>" required>

                <label>Roll Number</label>
                <input type="text" name="rollNumber"
                       value="<?php echo $rollNumber; ?>" required>

                <label>Subject</label>
                <input type="text" name="subject"
                       value="<?php echo $subject; ?>" required>

                <label>Weak Topic</label>
                <input type="text" name="weakTopic"
                       value="<?php echo $weakTopic; ?>" required>

                <label>Test Marks (out of 100)</label>
                <input type="number" name="marks"
                       min="0" max="100"
                       value="<?php echo $marks; ?>" required>

                <button type="submit">Generate Report</button>
            </form>

            <?php if ($message != "") { ?>
                <div class="card">
                    <h3><?php echo $message; ?></h3>
                </div>
            <?php } ?>

            <?php if ($status != "") { ?>
                <div class="card">
                    <h2>Student Performance Report</h2>

                    <p><strong>Student:</strong> <?php echo $studentName; ?></p>
                    <p><strong>Roll Number:</strong> <?php echo $rollNumber; ?></p>
                    <p><strong>Subject:</strong> <?php echo $subject; ?></p>
                    <p><strong>Weak Topic:</strong> <?php echo $weakTopic; ?></p>
                    <p><strong>Marks:</strong> <?php echo $marks; ?>/100</p>
                    <h3>Status: <?php echo $status; ?></h3>
                </div>
            <?php } ?>

        </section>
    </main>
</div>

<footer>
    <p>EduPulse | Student Learning Gap Tracker</p>
    <p>Developed By: Radhika | Web Technology Project</p>
</footer>

</body>
</html>
