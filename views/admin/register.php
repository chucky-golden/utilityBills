<?php require_once('partials/header.php'); ?>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/admin/login" class="logo d-flex align-items-center w-auto">
                  <img src="/views/basicassets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">billzhub</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create An Account</h5>
                    <p class="text-center small">Enter <b>admin</b> email & password to create account</p>
                  </div>

                  <form action="/admin/register" method="POST" class="row g-3 needs-validation" novalidate>

                    <?php require_once('partials/alert.php'); ?>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div><br>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div><br>
                    
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Passcode</label>
                      <input type="password" name="passcode" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter passcode!</div>
                    </div>

                    <div class="col-12 mt-4">
                      <button class="btn btn-primary w-100" type="submit">register</button>
                    </div>
                    <div class="col-12 mt-3">
                      <p class="small mb-0">already have an account? <a href="/admin/login">Login now</a></p>
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