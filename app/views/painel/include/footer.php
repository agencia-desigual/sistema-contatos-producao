</div>
<!-- end container-fluid -->
</div>
<!-- end wrapper -->

    <!-- Footer -->
    <footer class="footer">
        © <?= date("Y") ?> <?= SITE_NOME ?> <span class="d-none d-sm-inline-block"> - Desenvolvido por Agência Desigual <i class="mdi mdi-heart text-danger"></i></span>
    </footer>

<!-- End Footer -->

<!-- jQuery  -->
<script src="<?= BASE_URL; ?>assets/theme/stexo/js/jquery.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/js/jquery.slimscroll.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/js/waves.min.js"></script>

<!--Morris Chart-->
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/morris/morris.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/raphael/raphael.min.js"></script>


<!-- App js -->
<script src="<?= BASE_URL; ?>assets/theme/stexo/js/app.js"></script>

<!-- Autoload JS -->
<?php $this->view("autoload/js"); ?>

</body>

</html>