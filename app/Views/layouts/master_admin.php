<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $this->renderSection('title') ?></title>

  <!-- Bootstrap -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/stisla/assets/css/style.css">
  <link rel="stylesheet" href="/assets/stisla/assets/css/components.css">
  
  <!-- datatables css -->
  <link rel="stylesheet" href="/assets/DataTables/DataTables/css/dataTables.bootstrap4.min.css">


  <?= $this->renderSection('css') ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">

      <!-- navbar -->
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="/assets/stisla/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= session()->get('nama') ?> </div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      
      <!-- sidebar -->
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url('admin') ?>">EVOTING</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('admin') ?>">EV</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Menu Admin</li>

              <li>
                <a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
              </li>
                
              <?php if (session()->get('id_level') != 2) : ?>  
              
              <li>
                <a class="nav-link" href="<?= base_url('admin/hasil') ?>"><i class="fas fa-poll"></i> <span>Lihat Hasil</span></a>
              </li>

              <li>
                <a class="nav-link" href="<?= base_url('admin/users') ?>"><i class="fas fa-user"></i> <span>Users</span></a>
              </li>

              <li>
                <a class="nav-link" href="<?= base_url('admin/kandidat') ?>"><i class="fas fa-users"></i> <span>Kandidat</span></a>
              </li>

              <li>
                <a class="nav-link" href="<?= base_url('admin/pemilih') ?>"><i class="fas fa-hand-pointer"></i> <span>Pemilih</span></a>
              </li>

            <?php endif; ?>

              <li>
                <a class="nav-link" href="<?= base_url('admin/token') ?>"><i class="fas fa-barcode"></i> <span>Token</span></a>
              </li>
              
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Settings</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?= base_url('admin/user/change_password') ?>">Password</a></li>
                  <li><a class="nav-link" href="#" onclick="alert('coming soon')">Token <small>(coming soon)</small></a></li>
                </ul>
              </li>
            
            </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title ?></h1>
          </div>
          
          <?= $this->include('partials/msg_validation') ?>

        <?= $this->renderSection('content') ?>
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; EVOTING APP 2020 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> and Made by <a href="https://github.com/robbiabd">Robbi Abdul Rohman</a>
        </div>
      </footer>
    </div>
  </div>



  <!-- Bootstrap -->
    <script src="/assets/bootstrap/jquery/jquery.min.js"></script>
    <script src="/assets/bootstrap/popper.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>

    <script src="/assets/nicescroll/jquery.nicescroll.js"></script>
    <script src="/assets/stisla/assets/js/stisla.js"></script>
    


  <!-- Template JS File -->
  <script src="/assets/stisla/assets/js/scripts.js"></script>
  <script src="/assets/stisla/assets/js/custom.js"></script>
  
  <!-- datatables -->
  <script src="/assets/DataTables/DataTables/js/jquery.dataTables.min.js"></script>
  <script src="/assets/DataTables/datatables.min.js"></script>
  <script src="/assets/DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>
  


  <?= $this->renderSection('script') ?>
</body>
</html>
