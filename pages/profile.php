<?php
require_once('../layouts/header.php');
require_once('../auth.php');
customerRestrictAccess();
require_once('../db.php');

// Fetch customer data from the database

$sqlQuery =  $conn->prepare("SELECT id, mobile_number FROM customers where id = ?");
$sqlQuery->bind_param("i", $_SESSION['customer_id']);
$sqlQuery->execute();
$data = $sqlQuery->get_result();

if ($data->num_rows > 0) {
    $customer = $data->fetch_assoc();
}

?>


<nav class="navbar navbar-expand-md bg-white shadow-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
    <div class="container">
        <a class="navbar-brand" href="#">
            <strong>Welcome to Profile page</strong>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello</a>
                        <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">
                            <li>
                                <a class="dropdown-item" href="?action=customer-logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card border-0 shadow my-5">

        <div class="card-header bg-light">
            <h3 class="h5 pt-2">Customer Data</h3>
        </div>
        <div class="card-body">
            <h6>Mobile number: <?= $customer['mobile_number'] ?></h6>
        </div>

    </div>
</div>
<?php require_once('../layouts/footer.php'); ?>