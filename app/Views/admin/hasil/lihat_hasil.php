<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="fas fa-users"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Kandidat</h4>
        </div>
        <div class="card-body">
          <?= $total_kandidat['total_kandidat'] ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-danger">
        <i class="fas fa-barcode"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Token</h4>
        </div>
        <div class="card-body">
          <?= $total_token['total_token'] ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-warning">
        <i class="fas fa-hand-pointer"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pemilih</h4>
        </div>
        <div class="card-body">
          <?= $total_pemilih['total_pemilih'] ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-success">
        <i class="fas fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Petugas</h4>
        </div>
        <div class="card-body">
          <?= $total_petugas['total_petugas'] ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-8 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Statistik Voting</h4>
      </div>
      <div class="card-body">
        <canvas id="myChart" height="182"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Aktivitas hari ini</h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled list-unstyled-border">
          <?php foreach ($get_aktivitas as $aktivitas) : ?>
            <li class="media">
              <div class="media-body">
                <div class="float-right text-primary"><?= $aktivitas['token_key'] ?></div>
                <div class="media-title"><?= $aktivitas['created_at'] ?></div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="/assets/chart.js/chart/Chart.min.js"></script>

<script>
  $(function() {
    getChart();
  });

  function getChart() {
    $.ajax({
      url: "<?= base_url('ajax/get_chart_total_voting') ?>",
      method: "POST",
      data: {
        _csrf: getCsrf()
      },
      success: function(data) {
        data = JSON.parse(data);
        setCsrf(data.csrf);
        chart(data.labels, data.datas);
      }
    });
  }

  function chart(labels, datas) {
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: '# Voting',
          data: datas,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  }
</script>
<?= $this->endSection() ?>