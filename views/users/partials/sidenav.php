<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="/dashboard" class="logo d-flex align-items-center">
    <img src="https://basicassets.netlify.app/img/logo.png" alt="">
    <span class="d-none d-lg-block">billzhub</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div>
<!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown pe-3">
      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <div class="text-white p-2 bg-secondary">
          <i class="bi bi-person"></i>
        </div>
        <span class="d-none d-md-block dropdown-toggle ps-2">Action</span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?=$_SESSION['user']['uname']?></h6>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

          <li>
          <a class="dropdown-item d-flex align-items-center" href="/profile">
            <i class="bi bi-gear"></i>
            <span>Account Settings</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="https://chat.whatsapp.com/Ifm4oFji0XF9OvcIiKFrGm">
            <i class="bi bi-question-circle"></i>
            <span>Need Help?</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="/logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li>
    <!-- End Profile Nav -->

  </ul>
</nav>
<!-- End Icons Navigation -->

</header>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">


  <li class="nav-item">
    <a class="nav-link " href="/dashboard">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="/airtime">
      <i class="bi bi-phone"></i>
      <span>Buy Airtime</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="fa-solid fa-coins"></i><span>Buy Data</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="/mtndata">
          <i class="bi bi-circle"></i><span>MTN Data</span>
        </a>
      </li>
      <li>
        <a href="/glodata">
          <i class="bi bi-circle"></i><span>Glo Data</span>
        </a>
      </li>
      <li>
        <a href="/glodata2">
          <i class="bi bi-circle"></i><span>Glo SME Data</span>
        </a>
      </li>
      <li>
        <a href="/airteldata">
          <i class="bi bi-circle"></i><span>Airtel</span>
        </a>
      </li>
      <li>
        <a href="/9mobile">
          <i class="bi bi-circle"></i><span>9Mobile Data</span>
        </a>
      </li>
    </ul>
  </li>
  <!-- End Forms Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-tv"></i><span>CableTv</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="/gotv">
          <i class="bi bi-circle"></i><span>GoTV</span>
        </a>
      </li>
      <li>
        <a href="/dstv">
          <i class="bi bi-circle"></i><span>DsTV</span>
        </a>
      </li>
      <li>
        <a href="/startimes">
          <i class="bi bi-circle"></i><span>Startimes</span>
        </a>
      </li>
    </ul>
  </li>
  <!-- End Tables Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="/electricity">
      <i class="fa-solid fa-bolt"></i>
      <span>Electricity billz</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="/deposit">
      <i class="fa-solid fa-cash-register"></i>
      <span>Deposit</span>
    </a>
  </li>
  <!-- End Charts Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="https://chat.whatsapp.com/Ifm4oFji0XF9OvcIiKFrGm">
      <i class="bi bi-whatsapp"></i>
      <span>Whatsapp Group</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/history">
      <i class="bi bi-piggy-bank"></i>
      <span>Transaction(s) History</span>
    </a>
  </li>

  <li class="nav-heading">Accounts</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/profile">
      <i class="bi bi-person"></i>
      <span>Edit Profile</span>
    </a>
  </li>
  <!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="/logout">
      <i class="bi bi-power"></i>
      <span>Logout</span>
    </a>
  </li>
  <!-- End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="#">
      <i class="bi bi-card-list"></i>
      <span>Version 2.3.1</span>
    </a>
  </li>
  <!-- End Register Page Nav -->

</ul>

</aside><!-- End Sidebar-->