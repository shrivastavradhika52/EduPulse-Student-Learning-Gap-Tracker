
let students = JSON.parse(localStorage.getItem("students")) || [];
let performances = JSON.parse(localStorage.getItem("performances")) || [];

const studentForm = document.getElementById("studentForm");
const performanceForm = document.getElementById("performanceForm");
const searchStudent = document.getElementById("searchStudent");

studentForm.addEventListener("submit", function(event) {
    event.preventDefault();

    const name = document.getElementById("studentName").value.trim();
    const roll = document.getElementById("rollNumber").value.trim();
    const studentClass = document.getElementById("studentClass").value.trim();

    if (students.some(student => student.roll === roll)) {
        alert("This roll number already exists.");
        return;
    }

    students.push({
        name: name,
        roll: roll,
        studentClass: studentClass
    });

    localStorage.setItem("students", JSON.stringify(students));

    studentForm.reset();
    displayStudents();
    updateDashboard();

    alert("Student added successfully!");
});

performanceForm.addEventListener("submit", function(event) {
    event.preventDefault();

    const roll = document.getElementById("performanceRoll").value.trim();
    const subject = document.getElementById("subject").value.trim();
    const topic = document.getElementById("weakTopic").value.trim();
    const marksValue = document.getElementById("testMarks").value;
    const marks = Number(marksValue);

    if (!students.some(student => student.roll === roll)) {
        alert("Please add this student first.");
        return;
    }

    if (marksValue === "" || marks < 0 || marks > 100) {
        alert("Please enter marks between 0 and 100.");
        return;
    }

    const status = marks < 40 ? "Needs Improvement" : "Improved";

    performances.push({
        roll: roll,
        subject: subject,
        topic: topic,
        marks: marks,
        status: status
    });

    localStorage.setItem("performances", JSON.stringify(performances));

    performanceForm.reset();
    displayProgress();
    updateDashboard();

    alert("Performance submitted successfully!");
});

function displayStudents() {
    const studentList = document.getElementById("studentList");
    const search = searchStudent.value.toLowerCase();

    studentList.innerHTML = "";

    const filteredStudents = students.filter(student =>
        student.name.toLowerCase().includes(search) ||
        student.roll.toLowerCase().includes(search)
    );

    if (filteredStudents.length === 0) {
        studentList.textContent = "No students found.";
        return;
    }

    filteredStudents.forEach(student => {
        const record = document.createElement("p");

        record.textContent =
            student.name + " | Roll No: " + student.roll +
            " | Class: " + student.studentClass;

        studentList.appendChild(record);
    });
}

function displayProgress() {
    const progressList = document.getElementById("progressList");

    progressList.innerHTML = "";

    if (performances.length === 0) {
        progressList.textContent = "No performance records found.";
        return;
    }

    performances.forEach((item, index) => {
        const record = document.createElement("div");
        record.className = "progress-record";

        const student = students.find(
            student => student.roll === item.roll
        );

        const details = document.createElement("p");

        details.textContent =
            (student ? student.name : "Unknown Student") +
            " | " + item.subject +
            " | Topic: " + item.topic +
            " | Marks: " + item.marks + "/100" +
            " | Status: " + item.status;

        const editButton = document.createElement("button");
        editButton.textContent = "Edit";
        editButton.style.marginRight = "10px";

        editButton.addEventListener("click", function() {
            editPerformance(index);
        });

        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.style.background = "#A64B4B";

        deleteButton.addEventListener("click", function() {
            deletePerformance(index);
        });

        record.appendChild(details);
        record.appendChild(editButton);
        record.appendChild(deleteButton);

        progressList.appendChild(record);
    });
}

function editPerformance(index) {
    const item = performances[index];

    const newSubject = prompt("Enter updated subject:", item.subject);
    if (newSubject === null || newSubject.trim() === "") return;

    const newTopic = prompt("Enter updated weak topic:", item.topic);
    if (newTopic === null || newTopic.trim() === "") return;

    const newMarksValue = prompt("Enter updated marks (0-100):", item.marks);
    if (newMarksValue === null || newMarksValue.trim() === "") return;

    const newMarks = Number(newMarksValue);

    if (!Number.isFinite(newMarks) || newMarks < 0 || newMarks > 100) {
        alert("Please enter valid marks between 0 and 100.");
        return;
    }

    performances[index].subject = newSubject.trim();
    performances[index].topic = newTopic.trim();
    performances[index].marks = newMarks;
    performances[index].status =
        newMarks < 40 ? "Needs Improvement" : "Improved";

    localStorage.setItem("performances", JSON.stringify(performances));

    displayProgress();
    updateDashboard();

    alert("Performance updated successfully!");
}

function deletePerformance(index) {
    const confirmed = confirm(
        "Are you sure you want to delete this performance record?"
    );

    if (!confirmed) return;

    performances.splice(index, 1);

    localStorage.setItem("performances", JSON.stringify(performances));

    displayProgress();
    updateDashboard();

    alert("Performance record deleted successfully!");
}

function updateDashboard() {
    const weakStudents = new Set(
        performances
            .filter(item => item.status === "Needs Improvement")
            .map(item => item.roll)
    );

    const improvedStudentsSet = new Set(
        performances
            .filter(item => item.status === "Improved")
            .map(item => item.roll)
    );

    document.getElementById("totalStudents").textContent = students.length;
    document.getElementById("needsImprovement").textContent = weakStudents.size;
    document.getElementById("improvedStudents").textContent =
        improvedStudentsSet.size;
}

searchStudent.addEventListener("input", displayStudents);

displayStudents();
displayProgress();
updateDashboard();
