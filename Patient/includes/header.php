<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            Doctor Appointment
            <strong class="d-block">Management System</strong>
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#booking">Booking</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="check-appointment.php">Check Appointment</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#contact">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="change-password.php">Change Password</a>
                </li>

            </ul>
        </div>

        <!-- Logout (Right side) -->
        <a class="nav-link text-danger" href="logout.php">Logout</a>

    </div>
</nav>