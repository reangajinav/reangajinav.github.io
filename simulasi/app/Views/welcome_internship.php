<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

	<style type="text/css" media="screen">
		/*.modal-body {
			position: relative;
			overflow-y: auto;
			max-height: 400px;
			padding: 15px;
		}*/
		body .modal-dialog { /* Width */
			max-width: 80%;
		}
	</style>
</head>
<body>

	<div class="container">
		<p class="text-center">SIMULASI PROFIT</p>
	</div>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-lg-8 col-sm-8">
				<form action="/dashboard/simulasi" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="bulan">JUMLAH BULAN</label>
						<input type="number" class="form-control" id="bulan" name="bulan" placeholder="Masukan Jumlah Bulan">
					</div>
					<div class="form-group">
						<label for="deposit_awal">DEPOSIT AWAL</label>
						<input type="number" class="form-control" id="deposit_awal" name="deposit_awal" placeholder="Masukan Deposit Awal">
					</div>
					<div class="form-group">
						<label for="simulasi_profit">SIMULASI PROFIT PER BULAN</label>
						<input type="number" class="form-control" id="simulasi_profit" name="simulasi_profit" placeholder="Simulasi Profit Per Bulan dalam %">
					</div>
					<div class="form-group">
						<label for="simulasi_profit">SIMULASI SHARING PROFIT</label>
						<input type="number" class="form-control" id="simulasi_sharing_profit" name="simulasi_sharing_profit" placeholder="Simulasi Sharing Profit Per Bulan dalam %">
					</div>
					<div class="form-group">
						<label for="simulasi_profit">SALDO TAMBAHAN PER BULAN</label>
						<input type="number" class="form-control" id="adding_saldo" name="adding_saldo" placeholder="Tambahan saldo perbulan">
					</div>
					<div class="form-group">
						<label for="simulasi_profit">KURS DOLLAR</label>
						<input type="number" class="form-control" id="kurs_dollar" name="kurs_dollar" placeholder="Kurs Dollar">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4>SIMULASI PROFIT</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<?php if(!empty($data)) { ?>

						<table id="table_id" class="display">
							<thead>
								<tr>
									<th>Bulan</th>
									<th>Deposit Awal</th>
									<th>Simulasi Profit <?= $input['simulasi_profit']; ?>%</th>
									<th>Simulasi Sharing Profit <?= $input['simulasi_sharing_profit']; ?>%</th>
									<th>Adding Saldo</th>
									<th>Kurs Dollar</th>
									<th>Saldo (dollar)</th>
									<th>Saldo (Rupiah)</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($data as $key => $value) { ?>
									<tr>
										<td><?= $key+1;?></td>
										<td><?= $value['deposit_awal'];?></td>
										<td><?= $value['simulasi_profit'];?></td>
										<td><?= $value['simulasi_sharing_profit'];?></td>
										<td><?= $value['adding_saldo'];?></td>
										<td><?= $value['kurs_dollar'];?></td>
										<td><?= $value['saldo'];?></td>
										<td>Rp. <?= number_format($value['saldo_in_rupiah'],2,',','.');?></td>
									</tr>
								<?php } 
								?>
							</tbody>
						</table>
					<?php } ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script type="text/javascript">
		$(document).ready( function () {
			$('#table_id').DataTable();
		} );

		var arraySimulasi = <?php echo json_encode($data); ?>;
		if (arraySimulasi.length !== 0) {
			$('#myModal').modal('show');
		}
	</script>
</body>
</html>