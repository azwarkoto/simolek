<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>

					<tr>
						<td><label for="varchar">Nomor <?php echo form_error('nomor') ?></label></td>
						<td><input type="text" class="form-control" name="nomor" id="nomor" placeholder="Nomor" value="<?php echo $nomor; ?>" /></td>
					</tr>

					<tr>
						<td><label for="date">Tanggal <?php echo form_error('tanggal') ?></label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" autocomplete="off" >
							</div>
						</td>
					</tr>

					<tr>
						<td><label for="varchar">Penyedia <?php echo form_error('penyedia') ?></label></td>
						<td><input type="text" class="form-control" name="penyedia" id="penyedia" placeholder="Penyedia" value="<?php echo $penyedia; ?>" /></td>
					</tr>

					<tr>
						<td><label for="varchar">Lama <?php echo form_error('lama') ?></label></td>
						<td><input type="text" class="form-control" name="lama" id="lama" placeholder="..... Hari/Hari Kerja" value="<?php echo $lama; ?>" /></td>
					</tr>

					<tr>
						<td><label for="date">Awal <?php echo form_error('awal') ?></label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="awal" id="awal" placeholder="Awal" value="<?php echo $awal; ?>" autocomplete="off" >
							</div>
						</td>
					</tr>

					<tr>
						<td><label for="date">Akhir <?php echo form_error('akhir') ?></label></td>
						<td>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="akhir" id="akhir" placeholder="Akhir" value="<?php echo $akhir; ?>" autocomplete="off" >
							</div>
						</td>
					</tr>

					<tr>
						<td><label for="varchar">Ket <?php echo form_error('ket') ?></label></td>
						<td><input type="text" class="form-control" name="ket" id="ket" placeholder="Ket" value="<?php echo $ket; ?>" /></td>
					</tr>

					<input type="hidden" name="id_k" value="<?php echo $id_k; ?>" />
					<input type="hidden" name="id_p" value="<?php echo $id_p; ?>" />
					<tr>
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$id_p) ?>" class="btn btn-danger">Cancel</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#nomor").focus();
		$("#tanggal").datepicker({
			autoclose: true,
			format:'yyyy/mm/dd',
		});
		$("#awal").datepicker({
			autoclose: true,
			format:'yyyy/mm/dd',
		});
		$("#akhir").datepicker({
			autoclose: true,
			format:'yyyy/mm/dd',
		});
	});

</script>
