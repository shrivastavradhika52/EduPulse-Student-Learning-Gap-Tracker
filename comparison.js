
const comparisonForm = document.getElementById("comparisonForm");

const students = JSON.parse(localStorage.getItem("students")) || [];
const performances = JSON.parse(localStorage.getItem("performances")) || [];

const rollInput = document.getElementById("compareRoll");
const subjectInput = document.getElementById("compareSubject");
const previousInput = document.getElementById("previousMarks");
const latestInput = document.getElementById("latestMarks");

const studentOptions = document.createElement("datalist");
studentOptions.id = "studentOptions";

students.forEach(student => {
    const option = document.createElement("option");
    option.value = student.roll;
    option.label = student.name;
    studentOptions.appendChild(option);
});

document.body.appendChild(studentOptions);
rollInput.setAttribute("list", "studentOptions");

comparisonForm.addEventListener("submit", function(event) {
    event.preventDefault();

    const roll = rollInput.value.trim();
    const subject = subjectInput.value.trim().toLowerCase();

    const previous = Number(previousInput.value);
    const latest = Number(latestInput.value);

    if (!students.some(student => student.roll === roll)) {
        alert("Student not found. Please enter an existing roll number.");
        return;
    }

    if (
        previousInput.value === "" ||
        latestInput.value === "" ||
        previous < 0 || previous > 100 ||
        latest < 0 || latest > 100
    ) {
        alert("Please enter valid marks between 0 and 100.");
        return;
    }

    const student = students.find(item => item.roll === roll);

    const previousRecord = performances.find(item =>
        item.roll === roll &&
        item.subject.toLowerCase() === subject &&
        item.marks === previous
    );

    const latestRecord = performances.find(item =>
        item.roll === roll &&
        item.subject.toLowerCase() === subject &&
        item.marks === latest
    );

    if (!previousRecord || !latestRecord) {
        alert("Please enter marks that match the student's saved performance records for this subject.");
        return;
    }

    const difference = latest - previous;

    let status;
    let message;

    if (difference > 0) {
        status = "Performance Improved!";
        message = "The student improved by " + difference + " marks.";
    } else if (difference < 0) {
        status = "Needs Attention";
        message = "Marks decreased by " + Math.abs(difference) + ".";
    } else {
        status = "No Change";
        message = "Performance remains the same.";
    }

    const result = document.getElementById("comparisonResult");
    result.textContent = "";

    const card = document.createElement("div");
    card.className = "card";

    const details = [
        "Student: " + student.name,
        "Roll Number: " + roll,
        "Subject: " + subjectInput.value,
        "Previous Marks: " + previous + "/100",
        "Latest Marks: " + latest + "/100",
        (difference > 0 ? "+" : "") + difference + " Marks",
        status,
        message
    ];

    details.forEach(detail => {
        const paragraph = document.createElement("p");
        paragraph.textContent = detail;
        card.appendChild(paragraph);
    });

    result.appendChild(card);
});
