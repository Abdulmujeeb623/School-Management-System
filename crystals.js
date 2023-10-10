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
