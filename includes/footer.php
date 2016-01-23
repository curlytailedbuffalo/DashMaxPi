

    <!-- jQuery 2.1.4 -->
    <script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
	<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/js/demo.js"></script>
	<script>
      $(function () {
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
		  "columns": [
			null,
			{ "width": "10%" },
			{ "width": "15%" },
			null,
			null
		  ]
        });
      });
    </script>