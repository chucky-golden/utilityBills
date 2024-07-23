<?php require_once('partials/header.php'); ?>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/" class="logo d-flex align-items-center w-auto">
                  <img src="https://chuckyassets.netlify.app/img/logo.png" alt="">
                  <span class="d-none d-lg-block">YuzTech</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Reset Account Password</h5>
                    <p class="text-center small">Enter new password to reset account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>

                    <?php require_once('partials/alert.php'); ?>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div><br>
                    
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Confirm PassWord</label>
                      <input type="password" name="conpassword" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter confirm password!</div>
                    </div>

                    <div class="col-12 mt-4">
                      <button class="btn btn-primary w-100" type="submit">reset now</button>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits text-center p-3">
                Designed by <a href="https://www.linkedin.com/in/chukwudi-uwakwe-24523a184/">cheese</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

<?php require_once('partials/footer.php'); ?>