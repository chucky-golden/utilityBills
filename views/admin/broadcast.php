<?php require_once('partials/header.php'); ?>

<body>

<?php require_once('partials/sidenav.php'); ?>


    <main id="main" class="main">

        <div class="pagetitle">
        <h1>Broadcast Message</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Send Message</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <section class="section py-4">
            <div class="container">

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <p class="text-center small">Send A Broadcast Message To All Your Users Via There Email Address</p>
                        </div>

                        <form action="/admin/broadcast" method="POST" class="row g-3 needs-validation" novalidate>

                            <?php require_once('partials/alert.php'); ?>

                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Message</label>
                                <div class="input-group has-validation">
                                    <textarea name="message" class="form-control" id=""></textarea>
                                    <div class="invalid-feedback">Please enter a message.</div>
                                </div>
                            </div>


                            <div class="col-12 mt-4">
                                <button class="btn btn-primary w-100" type="submit">Send Now</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>billzhub</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://www.linkedin.com/in/chukwudi-uwakwe-24523a184/">cheese</a>
    </div>
  </footer><!-- End Footer -->

<?php require_once('partials/footer.php'); ?>