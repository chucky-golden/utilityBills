<?php require_once('partials/header.php'); ?>
<body>

    <?php require_once('partials/sidenav.php'); ?> 

    <main id="main" class="main">

        <div class="pagetitle">
        <h1>Data (Glo Gifting & CG) </h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item">Buy Data</li>
            <li class="breadcrumb-item active">Data (Glo Gifting & CG) </li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <section class="section">
        <div class="row">
            <div class="col-12 mt-5">

            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Data (Glo Gifting & CG)</h5>

                <form class="row g-3 mb-5">
                    <div class="col-12 place">
                    <label for="inputNanme4" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" maxlength="11" placeholder="11 digits only" id="inputNanme4">
                    </div>
                    <div class="col-12">
                    <label for="inputEmail4" class="form-label">Select Plan</label>
                    <!-- <input type="email" class="form-control" id="inputEmail4"> -->
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Choose Plan</option>
                        <!-- <option value="1">Glo</option>
                        <option value="2">MTN</option>
                        <option value="3">Airtel</option>
                        <option value="4">9Mobile</option> -->
                    </select>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary col-12">Buy Now</button>
                    </div>
                </form>
                </div>
            </div>

            </div>
        </div>
        </section>

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