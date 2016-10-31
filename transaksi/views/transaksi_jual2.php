<?php require '../../inc/config.php';?>

	<div class="block">
        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
            <li class="active">
                <a href="#tab-list" >List</a>
            </li>
            <li>
                <a href="#tab-form">Form</a>
            </li>
        </ul>
    </div>
    <div class="block-content tab-content">
        <div class="tab-pane active" id="tab-list">
            <div class="table-responsive"><table id="table_transaksi2" ></table></div>
        </div>
        <div class="tab-pane" id="tab-form">
            <div id="form" class="form-horizontal push-10-t">
            	<!--<form class="form-horizontal push-10-t" action="" method="post" onsubmit="return false;">-->
                <input class="form-control" type="hidden" id="transaksi_id" name="transaksi_id" >
                <input class="form-control" type="hidden" id="status" name="status" >
                <div class="form-group">
                    <div class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <input required class="js-datepicker form-control input-sm" type="text" id="tgl_trx" name="tgl_trx" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" >                                                    
                            <label for="tgl_trx">Tanggal</label>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                <!--</div>
            	<div class="form-group">-->
                    <div class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <select required class="selectpicker form-control input-sm" id="toko_id" name="toko_id" style="width: 100%;" >
                            </select>
                            <label for="toko_id">Nama Toko</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <div required class="form-material form-material-info ">
                            <input class="form-control input-sm" type="text" id="inv_trx" name="inv_trx" >
                            <label for="inv_trx">Invoice Tokopedia</label>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                <!--</div>
                <div class="form-group">-->
                    <div class="col-sm-4">
                        <div required class="form-material form-material-info ">
                            <input class="form-control input-sm" type="text" id="nama" name="nama" >
                            <label for="nama">Nama Pembeli</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <textarea class="form-control input-sm" id="alamat" name="alamat" rows="3" placeholder="Isi Alamat..."></textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                <!--</div>
                <div class="form-group">-->
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <input type="text" class="form-control input-sm" id="no_hp" name="no_hp" >
                            <label for="no_hp">No Handphone</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material form-material-info ">
                            <input type="text" class="form-control input-sm" id="no_resi" name="no_resi" >
                            <label for="no_resi">No Resi</label>
                        </div>
                    </div>
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <select required class="selectpicker form-control input-sm" id="status_trx" name="status_trx" style="width: 100%;">
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
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                             <input type="text" class="form-control input-sm" id="product" name="product" >
                            <label for="product">Product</label>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                <!--</div>
                <div class="form-group">-->
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <input type="text" class="form-control input-sm" id="supplier" name="supplier" >
                            <label for="supplier">Supplier</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                             <input type="text" class="form-control input-sm" id="harga_supplier" name="harga_supplier" >
                            <label for="harga_supplier">Harga Supplier</label>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                <!--</div>
                <div class="form-group">-->
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <input type="text" class="form-control input-sm" id="harga_jual" name="harga_jual" >
                            <label for="harga_jual">Harga Jual</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                             <input type="text" class="form-control input-sm" id="qty" name="qty" >
                            <label for="qty">Qty</label>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                <!--</div>
                <div class="form-group">-->
                    <div required class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <input type="text" class="form-control input-sm" id="harga_refund" name="harga_refund" >
                            <label for="harga_refund">Nominal Refund</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                    	<div id='add_div'>
                    	<?php if($_SESSION['menu'][$_GET['id_menu']]['tambah']=='Y'){ $disable_tambah = '';}else{ $disable_tambah = 'disabled';}?>
                        	<button <?php echo $disable_tambah;?> class="btn btn-sm btn-primary" onClick="action('simpan');"> Simpan </button>
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
        </div>
    </div>



<!--<script src="<?php echo $one->assets_folder; ?>/js/app.js"></script>-->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-table/src/bootstrap-table.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/pages/base_form.js"></script>


<!-- Page JS Plugins -->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/bootstrap-select/js/bootstrap-select.min.js"></script>
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
        App.initHelpers(['datepicker']); /*, 'colorpicker', 'select2', 'masked-inputs', 'tags-inputs'*/
    });
</script>

<script>

$(function() 
{
	
	$('#table_transaksi2').bootstrapTable({
		url				: 'transaksi/model/mod_transaksi_jual2.php',
		method			: 'get',
		dataType		: 'json',
		queryParams		: {
							grid_table	: 1,
							id_menu		: <?php echo $_GET['id_menu'];?>
						  },
		striped 		: true,
		columns:[[
				{field:'no',title:'#', width:'5%'},
				{field:'tgl_trx',title:'Tanggal Trx'},
				{field:'inv_trx',title:'Inv Tokopedia'},
				{field:'nama',title:'Nama'},
				{field:'no_hp',title:'No Hp'},
				{field:'no_resi',title:'No Resi'},
				{field:'status_trx',title:'Status'},
				{field:'action',title:'Action', width:'15%'}
			]],
		pageNumber	  : 1,
		pagination	  : true,
		pageSize      : 5,
		pageList      : [5, 10, 25, 50, 100],
		search        : true,
		classes       : 'table table-hover table-bordered table-header-bg',
		sortName      : 'tgl_trx',
		smartDisplay  : true
	});	

});


$("#status_trx").select2();
$("#toko_id").select2();

$(document).ready(function () {
    
	$.ajax({
			type: "GET",
			dataType: "json",
			url: 'transaksi/model/mod_transaksi_jual2.php?toko=1'
		}).done(function( data, responce ) {
				var component = "";
				$.each(data, function(key,val){
					component += '<option value="'+val.id+'">' + val.name + '</option>';	
				});
				$("#toko_id").append(component);
		}).fail(function(error) {
			console.log(error);
		});
});

function clearAll()
{
	$("#transaksi_id").val();
	$("#toko_id").val();
	$("#tgl_trx").val();
	$("#inv_trx").val();
	$("#nama").val();
	$("#alamat").val();
	$("#no_hp").val();
	$("#no_resi").val();
	$("#status").val();
	$("#product").val();
	$("#supplier").val();
	$("#harga_supplier").val();
	$("#harga_jual").val();
	$("#qty").val();
	$("#harga_refund").val();
}

function action(act,tab,id)
{
	var URL = 'transaksi/model/mod_transaksi_jual2.php';
	var act = act;
	if(act=='back')
	{
		backTabs();
		clearAll();	
		$("#add_div").css('display', 'block');
		$("#edit_div").css('display', 'none');
	}
	else if(act=='edit')
	{
		$.ajax({
			url:URL,
			type: 'get',
			dataType: 'json',
			data:{
				"edit"		: 1,
				"transaksi_id"	: id	
			},
			success:function(data){				
				nextTabs();
				$("#transaksi_id").val(data.transaksi_id);
				$("#toko_id").select2("val", data.toko_id);
				$("#tgl_trx").val(data.tgl_trx);
				$("#inv_trx").val(data.inv_trx);
				$("#nama").val(data.nama);
				$("#alamat").val(data.alamat);
				$("#no_hp").val(data.no_hp);
				$("#no_resi").val(data.no_resi);
				$("#status_trx").val(data.status_trx);
				
				$("#product").val(data.product);
				$("#supplier").val(data.supplier);
				$("#harga_supplier").val(data.harga_supplier);
				$("#harga_jual").val(data.harga_jual);
				$("#qty").val(data.qty);
				$("#harga_refund").val(data.harga_refund);
				
				$("#status").val(act);
				$("#add_div").css('display', 'none');
				$("#edit_div").css('display', 'block');
			}
		});	
	}
	else if(act=='simpan')
	{
		$.ajax({
			url:URL,
			type: 'get',
			dataType: 'json',
			data:{
				'simpan'		: 1,
				'transaksi_id'	: $("#transaksi_id").val(),
				'toko_id'		: $("#toko_id").val(),
				'tgl_trx'		: $("#tgl_trx").val(),
				'inv_trx'		: $("#inv_trx").val(),
				'nama'			: $("#nama").val(),
				'alamat'		: $("#alamat").val(),
				'no_hp'			: $("#no_hp").val(),
				'no_resi'		: $("#no_resi").val(),
				'status_trx'	: $("#status_trx").val(),
				'status'		: $("#status").val(),
				'product'		: $("#product").val(),
				'supplier'		: $("#supplier").val(),
				'harga_supplier': $("#harga_supplier").val(),
				'harga_jual'	: $("#harga_jual").val(),
				'qty'			: $("#qty").val(),
				'harga_refund'	: $("#harga_refund").val()
				
			},
			success:function(data){				
				//alert(data.message);
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
				}
				backTabs();
				$('#table_transaksi2').bootstrapTable('refresh');
				clearAll();
			}
		});	
	}
	else if(act=='delete')
	{		
		$.ajax({
			url:URL,
			type: 'get',
			dataType: 'json',
			data:{
				'delete'	: 1,
				'transaksi_id'	: id
			},
			success:function(data){				
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
				}
				backTabs();
				$('#table_transaksi2').bootstrapTable('refresh');
				clearAll();
			}
		});	
	}
}


</script>

