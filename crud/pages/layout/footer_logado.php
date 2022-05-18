      </main><!-- /.app-main -->
    </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    <script src="<?= ASSETS_URL ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="<?= ASSETS_URL ?>/assets/vendor/pace/pace.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/stacked-menu/stacked-menu.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/chart.js/Chart.min.js"></script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="<?= ASSETS_URL ?>/assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?= ASSETS_URL ?>/assets/javascript/pages/dashboard-demo.js"></script> <!-- END PAGE LEVEL JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/r-2.3.0/datatables.min.js"></script>

    <?php
      foreach ($this->arrJS as $key => $value) {
        echo "<script src=".ASSETS_URL."/assets/javascript/view/{$value}></script>";
      }
    ?>
  </body>
</html>