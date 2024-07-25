<?php require_once('partials/header.php'); ?>
<body>

    <?php require_once('partials/sidenav.php'); ?> 

    <main id="main" class="main">

        <div class="pagetitle">
        <h1>Buy Airtime</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Buy Airtime</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->
        <div class="col-12 mt-5">

        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Airtime Topup</h5>

            <!-- Vertical Form -->
            <form class="row g-3">
                <div class="col-12 place">
                <label for="inputNanme4" class="form-label">Phone Number</label>
                <input type="text" class="form-control" maxlength="11" placeholder="11 digits only" id="inputNanme4">
                </div>
                <div class="col-12">
                <label for="inputEmail4" class="form-label">Airtime Network</label>
                <!-- <input type="email" class="form-control" id="inputEmail4"> -->
                <select class="form-select" aria-label="Default select example">
                    <option selected>Choose Network</option>
                    <option value="1">Glo</option>
                    <option value="2">MTN</option>
                    <option value="3">Airtel</option>
                    <option value="4">9Mobile</option>
                </select>
                </div>
                <div class="col-12">
                <label for="inputPassword4" class="form-label">Airtime Type</label>
                <!-- <input type="password" class="form-control" id="inputPassword4"> -->
                <select class="form-select" aria-label="Default select example">
                    <option selected>VTU</option>
                    <option value="1">Share & Sell</option>
                </select>
                </div>
                <div class="col-12">
                <label for="inputAddress" class="form-label">Amount</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Amount">
                <p>Minimum Topup: 50</p>
                </div>
                <div class="form-check form-switch col-12 d-flex ">
                <label class="form-check-label ms-2 text-success" for="flexSwitchCheckDefault">Are your Input Details Correct?</label>
                <input class="form-check-input ms-2" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label ms-2 text-danger" for="flexSwitchCheckDefault">Kindly Switch to Continue the Process...</label>
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-primary col-12">Buy Now</button>
                </div>
            </form><!-- Vertical Form -->

            </div>
        </div>
        </div>

        </main><!-- End #main -->


<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright. All Rights Reserved
    </div>
    <div class="credits text-center p-3">
        Designed by <a href="https://www.linkedin.com/in/chukwudi-uwakwe-24523a184/">cheese</a>
    </div>

<?php require_once('partials/footer.php'); ?>