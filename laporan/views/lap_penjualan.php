<?php require '../../inc/config.php';?>

	<div class="block">
        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
            <li class="active">
                <a href="#tab-form" >Laporan Penjualan</a>
            </li>
        </ul>
    </div>
    <div class="block-content tab-content">
        <div class="tab-pane active" id="tab-form">
            <div id="form" class="form-horizontal push-10-t">
                <div class="form-group">
                    <div class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <input required class="js-datepicker form-control input-sm" type="text" id="tanggal_from" name="tanggal_from" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" >                                                    
                            <label for="tanggal_from">Tanggal Transaksi</label>
                        </div>
                    </div>
                   <div class="col-sm-1">S / D</div>
                <!-- </div>
            	<div class="form-group">-->
                    <div class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <input required class="js-datepicker form-control input-sm" type="text" id="tanggal_to" name="tanggal_to" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" >                                                    
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <select required class="js-select2 form-control input-sm" id="status_trx" name="status_trx" style="width: 100%;" data-placeholder="Pilih Status Transaksi..">
                                <option value=""></option>
                                <option value="process">On Process</option>
                                <option value="success">Success</option>
                                <option value="cancel">Cancel</option>
                                <option value="refund">Refund</option>
                            </select>
                            <label for="status_trx">Status Transaksi</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                    	<div id='add_div'>
                    	<?php if($_SESSION['menu'][$_GET['id_menu']]['tambah']=='Y'){ $disable_tambah = '';}else{ $disable_tambah = 'disabled';}?>
                        	<button <?php echo $disable_tambah;?> class="btn btn-sm btn-primary" onClick="action('load');"> View </button>
                            <button class="btn btn-sm btn-danger" onClick="action('back');"> Batal </button>
                        </div>
                        <div id='edit_div' style="display:none;">
                        	<button class="btn btn-sm btn-primary" onClick="action('simpan');"> Edit </button>
                            <button class="btn btn-sm btn-danger" onClick="action('back');"> Batal </button>
                        </div>
                    </div>
                </div>
            <!--</form>-->
            </div> 
            <div id="lap_detail" class="col-sm-12" style="display:none;">
            	<div class="col-sm-12">
                   <div class="table-responsive "><table id="table_lap_penjualan" data-show-export="true data-show-footer="true""></table></div>
                </div>
            </div>          
        </div>
    </div>



<!--<script src="<?php echo $one->assets_folder; ?>/js/app.js"></script>-->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-table/src/bootstrap-table.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-table/src/extensions/export/tableExport.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/pages/base_form.js"></script>


<!-- Page JS Plugins -->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/select2/select2.full.min.js"></script>
<!-- Page JS Code 
<script src="<?php echo $one->assets_folder; ?>/js/pages/base_ui_activity.js"></script>-->
<!--<script>
    $(function(){
        // Init page helpers (BS Notify Plugin)
        App.initHelpers('notify');
    });
</script>-->
<script>
    $(function(){
        // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
        App.initHelpers(['datepicker','select2']); /*, 'colorpicker', 'select2', 'masked-inputs', 'tags-inputs'*/
    });
</script>

<script>

function loadReport()
{
	$(function() 
	{
		var tgl_from = $("#tanggal_from").val();
		var tgl_to = $("#tanggal_to").val();
		var status_trx = $("#status_trx").val();
		
		$('#table_lap_penjualan').bootstrapTable({
			url				: 'laporan/model/mod_lap_penjualan.php',
			method			: 'get',
			dataType		: 'json',
			queryParams		: {
								grid_table	: 1,
								id_menu		: <?php echo $_GET['id_menu'];?>,
								tgl_from	: tgl_from,
								tgl_to	: tgl_to,
								status_trx	: status_trx,
							  },
			striped 		: true,
			columns:[[
					{field:'no',title:'#', width:'5%'},
					{field:'tgl_trx',title:'Tanggal Trx'},
					{field:'inv_trx',title:'Inv Tokopedia'},
					{field:'nama',title:'Nama'},
					{field:'alamat',title:'Alamat'},
					{field:'product',title:'Product'},
					{field:'total_harga',title:'Total Harga', footerFormatter: sumFormatter}
					
				]],
			pageNumber	  : 1,
			pagination	  : true,
			pageSize      : 5,
			pageList      : [5, 10, 25, 50, 100],
			search        : false,
			classes       : 'table table-hover table-bordered table-header-bg',
			sortName      : 'tgl_trx',
			smartDisplay  : true
		});	
	});
	
	function totalTextFormatter(data) {
		return 'Total';
	}

	function sumFormatter(data) {
		field = this.field;
		var total_sum = data.reduce(function(sum, row) {
			return (sum) + (row[field] || 0);
		}, 0);
		return total_sum;
	}	
}

function clearAll()
{
	$("#tanggal_from").val();
	$("#tanggal_to").val();
	$("#status_trx").val();
	$("#status").val();
}

function action(act)
{
	$("#lap_detail").css('display', 'none');
	$("#lap_detail").css('display', 'block');
	loadReport();
}
</script>

