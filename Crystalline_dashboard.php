<?php
session_start();

if (!isset($_SESSION['name'])) {
    header('Location: Crystalline_login.php');
    exit();
}
?>
<?php include('Crystalline_navbar2.php');?>
<body>
    <h1>Welcome to CMA</h1>
    <p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
    
    <?php include('Crystalline_footer.php');?>
</body>
</html>

