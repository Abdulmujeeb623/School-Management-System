<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secondary School Result Form</title>
    <!-- Include any necessary CSS or external dependencies here -->
</head>
<body>

<?php include('Crystalline_navbar2.php');?>
<form id="resultForm" method="post" action="process_form.php" enctype="multipart/form-data">
<div class="form-group">
        <label for="studentName">Student Name:</label>
        <input type="text" class="form-control" id="studentName" name="studentName">
    </div>
    <div class="form-group">
        <label for="className">Class Name:</label>
        <input type="text" class="form-control" id="className" name="className">
    </div>
    <div class="form-group">
        <label for="present">Number of Present:</label>
        <input type="number" class="form-control" id="present" name="present">
    </div>
    <div class="form-group">
        <label for="absent">Number of Absent:</label>
        <input type="number" class="form-control" id="absent" name="absent">
    </div>
    <div class="form-group">
        <label for="sex">Sex:</label>
        <select class="form-control" id="sex" name="sex">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    <div class="form-group">
        <label for="position">Position in Class:</label>
        <input type="number" class="form-control" id="position" name="position">
    </div>


        <div class="form-group">
            <label for="subject">Subject:</label>
            <select class="form-control" id="subject" name="subject">
                <option value="math">Math</option>
                <option value="science">Science</option>
                <option value="history">History</option>
                <option value="english">English</option>
                <option value="civic">Civic Education</option>
                <option value="religious">Religious Studies</option>
                <option value="technology">Technology</option>
                <option value="general">General Studies</option>
                <!-- Add more subjects as needed -->
            </select>
        </div>
        <div class="form-group">
            <label for="assignments">Assignments Score:</label>
            <input type="number" class="form-control" id="assignments" name="assignments">
        </div>
        <div class="form-group">
            <label for="test1">Test 1 Score:</label>
            <input type="number" class="form-control" id="test1" name="test1">
        </div>
        <div class="form-group">
            <label for="test2">Test 2 Score:</label>
            <input type="number" class="form-control" id="test2" name="test2">
        </div>
        <div class="form-group">
            <label for="exams">Exams Score:</label>
            <input type="number" class="form-control" id="exams" name="exams">
        </div>
        <button type="button" class="btn btn-primary" id="calculate">Calculate Total and Average</button>
        <div class="mt-3">
            <label>Total Score:</label>
            <span id="totalScore">0</span>
        </div>
        <div>
            <label>Average Score:</label>
            <span id="averageScore">0</span>
        </div>
        <div>
    
        <input type="submit" name="submit" value="Submit" class="btn-sign-in" title="Log in" />
</div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const calculateButton = document.getElementById("calculate");
    calculateButton.addEventListener("click", calculateScores);

    function calculateScores() {
        const assignments = parseFloat(document.getElementById("assignments").value) || 0;
        const test1 = parseFloat(document.getElementById("test1").value) || 0;
        const test2 = parseFloat(document.getElementById("test2").value) || 0;
        const exams = parseFloat(document.getElementById("exams").value) || 0;

        const totalScore = assignments + test1 + test2 + exams;
        const averageScore = totalScore / 4;

        document.getElementById("totalScore").textContent = totalScore;
        document.getElementById("averageScore").textContent = averageScore.toFixed(2);
    }
});
</script>

<?php include('Crystalline_footer.php');?>


</body>
</html>
