<?php require_once('partials/header.php'); ?>

<body>

<?php require_once('partials/sidenav.php'); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>User Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
          <li class="breadcrumb-item">User</li>
          <li class="breadcrumb-item active">User Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-10">

            <div class="card">
                <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                    </li>

                    <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Balance</button>
                    </li>

                    <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Danger Zone</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <?php require_once('partials/alert.php'); ?>
                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">First Name</div>
                        <div class="col-lg-9 col-md-8"><?=$user['fname']?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Last Name</div>
                        <div class="col-lg-9 col-md-8"><?=$user['lname']?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">User Name</div>
                        <div class="col-lg-9 col-md-8"><?=$user['uname']?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Email</div>
                        <div class="col-lg-9 col-md-8"><?=$user['email']?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Phone</div>
                        <div class="col-lg-9 col-md-8"><?=$user['phone']?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Account Balance</div>
                        <div class="col-lg-9 col-md-8"><s>N</s><?=number_format($user['actbal'])?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Referral Link</div>
                        <div class="col-lg-9 col-md-8"><?=$user['rflink']?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Account Status</div>
                        <div class="col-lg-9 col-md-8">
                            <?php if($user['active'] == 1): ?>
                                <span class="badge bg-success p-3">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger p-3">Blocked</span>
                            <?php endif ?>
                        </div>
                    </div>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                    <!-- Profile Edit Form -->
                    <form action="/admin/edituserbalance" method="POST">

                        <div class="row mb-3">                           
                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Edit Balance</label>
                            <div class="col-md-8 col-lg-9">
                                <p><s>N</s><?=number_format($user['actbal'])?></p> 
                                <input name="amount" type="number" class="form-control" id="fullName" value="0">
                                <input type="hidden" name="actbal" value="<?=$user['actbal']?>">
                                <input type="hidden" name="id" value="<?=$user['id']?>">
                            </div>
                        </div>

                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form><!-- End Profile Edit Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-settings">

                    <!-- Settings Form -->
                    <!-- <form> -->

                        <div class="row mb-3">
                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Block / Unblock Login Access</label>
                            <div class="col-md-8 col-lg-9">
                                <?php if($user['active'] == 1): ?>
                                    <a href="/admin/toggle?id=<?=$user['id']?>&action=disable" class="btn btn-warning">Block</a>
                                <?php else: ?>
                                    <a href="/admin/toggle?id=<?=$user['id']?>&action=enable" class="btn btn-success">Unblock</a>
                                <?php endif ?>  
                            </div>
                        </div>

                        <div class="row mt-4 mb-3">
                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Delete Account</label>
                            <div class="col-md-8 col-lg-9">
                                <a href="/admin/deleteuser?id=<?=$user['id']?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    <!-- </form> -->
                    <!-- End settings Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form>

                        <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="password" type="password" class="form-control" id="currentPassword">
                        </div>
                        </div>

                        <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                        </div>
                        </div>

                        <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                        </div>
                        </div>

                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form><!-- End Change Password Form -->

                    </div>

                </div><!-- End Bordered Tabs -->

                </div>
            </div>



            <div class="card">
                <div class="card-body pt-3">
                    <h5 class="card-title">User Transaction History</h5>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Reference</th>
                                <th scope="col">Package</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Time Stamp</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($transactions) :
                                    foreach ($transactions as $transaction):
                            ?>

                            <tr>
                                <td><?=$transaction['ref']; ?></td>
                                <td><?=$transaction['package']; ?></td>
                                <td><?=$transaction['amount']; ?></td>
                                <td><?php 
                                    if($transaction['paid'] == 0):
                                        echo '<span class="badge bg-success">successful</span>';
                                    else:
                                        echo '<span class="badge bg-danger">failed</span>';
                                    endif;
                                ?></td>
                                <td><?=$transaction['createddate']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td><p>No transaction created yet.</p></td>
                                </tr>
                            <?php endif; ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Billshub</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://www.linkedin.com/in/chukwudi-uwakwe-24523a184/">cheese</a>
    </div>
  </footer><!-- End Footer -->

<?php require_once('partials/footer.php'); ?>