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

<!-- Required datatable js -->
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/jszip.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/pdfmake.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/vfs_fonts.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/buttons.print.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?= BASE_URL; ?>assets/theme/stexo/pages/datatables.init.js"></script>

<!-- App js -->
<script src="<?= BASE_URL; ?>assets/theme/stexo/js/app.js"></script>

<!-- Autoload JS -->
<?php $this->view("autoload/js"); ?>

</body>

</html>