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
</head>

<body>

  <style>
    .min-vh-100 {
      min-height: 101vh!important;
    }
  </style>

  <div id="app">
    <?= $this->renderSection('content') ?>
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

  <?= $this->renderSection('script') ?>
</body>
</html>
