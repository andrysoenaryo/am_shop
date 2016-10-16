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
            <div class="table-responsive"><table id="table_transaksi" ></table></div>
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
                            <select required class="js-select2 form-control input-sm" id="toko_id" name="toko_id" style="width: 100%;" data-placeholder="Pilih Toko..">
                                <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                <option value="1">HTML</option>
                                <option value="2">CSS</option>
                                <option value="3">Javascript</option>
                                <option value="4">PHP</option>
                                <option value="5">MySQL</option>
                                <option value="6">Ruby</option>
                                <option value="7">AngularJS</option>
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
                            <select required class="js-select2 form-control input-sm" id="status_trx" name="status_trx" style="width: 100%;">
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
            <div id="trx_detail" class="col-sm-12" style="display:none;">
            	<div class="col-sm-12">
                    <table class="table table-striped table-borderless table-header-bg table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" valign="middle" style="width: 80px; vertical-align:central;">
                                    <a href="#" onClick="return addRow()"  class="addRow btn-sm btn-success"> <i class="glyphicon glyphicon-plus"></i></a>
                                    <a href="#" onClick="return removeRow()"  style="display:none" class="removeRow btn-sm btn-danger"> <i class="glyphicon glyphicon-minus"></i></a>
                                </th>
                                <th>Product</th>
                                <th class="hidden-xs" style="width: 15%;">Supplier</th>
                                <th class="hidden-xs" style="width: 100px;">Harga Supplier</th>
                                <th class="text-center" style="width: 100px;">Harga Jual</th>
                                <th class="text-center" style="width: 100px;">Qty</th>
                                <th class="hidden-xs" style="width: 100px;">Nominal Refund</th>
                                <th class="hidden-xs" style="width: 70px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bodyadd">
                       </tbody>
                    </table>
                </div>
                <div class="col-sm-12" align="right">
                    <div id='add_div'>
                    <?php if($_SESSION['menu'][$_GET['id_menu']]['tambah']=='Y'){ $disable_tambah = '';}else{ $disable_tambah = 'disabled';}?>
                        <button <?php echo $disable_tambah;?> class="btn btn-sm btn-primary" onClick="action_list('simpan');"> Simpan </button>
                        <button class="btn btn-sm btn-danger" onClick="action_list('back');"> Batal </button>
                    </div>
                    <div id='edit_div' style="display:none;">
                        <button class="btn btn-sm btn-primary" onClick="action_list('simpan');"> Edit </button>
                        <button class="btn btn-sm btn-danger" onClick="action_list('back');"> Batal </button>
                    </div>
                </div>
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

function addRow()
{
	var count_length = count_list()+1;
	var rownum = count_list()-1;
	if(count_length > 1){
		$('.removeRow').show();
	}
		
	var data = '<tr class="list">\
		<td class="text-center">'+count_length+'</td>\
		<td class="text-left"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="product['+rownum+']" name="product[]" ></div></td>\
		<td class="text-left"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="supplier['+rownum+']" name="supplier[]" ></div></td>\
		<td class="text-right"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="hrg_supplier['+rownum+']" name="hrg_supplier[]" ></div></td>\
		<td class="text-right"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="hrg_jual['+rownum+']" name="hrg_jual[]" ></div></td>\
		<td class="text-right"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="qty['+rownum+']" name="qty[]" ></div></td>\
		<td class="text-right"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="refund['+rownum+']" name="refund[]" ></div></td>\
		<td class="hidden-xs">\
			<div class="btn-group" align="center">\
				<button class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" title="Remove Client" ><i class="fa fa-trash-o"></i></button>\
			</div>\
		</td>\
	</tr>';
		
	$(".bodyadd").append(data);
	App.initHelpers(['datepicker','select2']);
		
}

function removeRow()
{
	$('.list').slice(-1).remove();
	if(count_list() < 2){
		$('.removeRow').hide();
		return false;
	}
}

function count_list()
{
	
	if($('.list_exist').length>0) { var length_list = $('.list_exist').length;}else{ var length_list = $('.list').length;}
	if( length_list == 1 ){ 
		$('.removeRow').hide();	
	}
	return length_list;
}

function list_data_detail(transaksi_id)
{
	var URL = 'transaksi/model/mod_transaksi_jual.php';
	var act = act;
	
	$.ajax({
		type: 'POST',
		url: URL,
		data: {
				 'transaksi_id'		: transaksi_id,
				 'grid_table_list'	: 1
		},
		dataType: 'json',
		cache: false,
		success: function(data) 
		{
			/*var bnyk_data = data.product.lenght;
			if(parseInt(data.product.lenght)>0)
			{*/
				$("#trx_detail").css('display', 'block');
				$(".bodyadd").append(data.form);
				App.initHelpers(['datepicker','select2']);
			//}
		}
	});
	
}

function action_list(act,tab,id)
{
	var URL = 'transaksi/model/mod_transaksi_jual.php';
	var act = act;
	if(act=='simpan')
	{
	
		var products = $('input[name="product[]"]').map(function(){ 
							return this.value; 
						}).get();
		
		var suppliers = $('input[name="supplier[]"]').map(function(){ 
							return this.value; 
						}).get();
						
		var hrg_suppliers = $('input[name="hrg_supplier[]"]').map(function(){ 
							return this.value; 
						}).get();
						
		var hrg_juals = $('input[name="hrg_jual[]"]').map(function(){ 
							return this.value; 
						}).get();
						
		var qtys = $('input[name="qty[]"]').map(function(){ 
							return this.value; 
						}).get();
						
		var refunds = $('input[name="refund[]"]').map(function(){ 
							return this.value; 
						}).get();
		
		var transaksi_detail_id = $('input[name="transaksi_detail_id[]"]').map(function(){ 
							return this.value; 
						}).get();
						
		var URL = 'transaksi/model/mod_transaksi_jual.php';
		var act = act;
		
		$.ajax({
			type: 'POST',
			url: URL,
			data: {
					 'product[]'				: products,
					 'supplier[]'				: suppliers,
					 'hrg_supplier[]'			: hrg_suppliers,
					 'hrg_jual[]'				: hrg_juals,
					 'qty[]'					: qtys,
					 'refund[]'					: refunds,
					 'transaksi_detail_id[]'	: transaksi_detail_id,
					 'transaksi_id'				: $("#transaksi_id").val(),
					 'status_list'				: 'simpan',
					 'simpan_list'				: 1
			},
			dataType: 'json',
			cache: false,
			success: function(data) 
			{
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
				}
				
				$('.list_exist').remove();
				$('.list').remove();
				list_data_detail($("#transaksi_id").val());
			}
		});
	}
	else if(act=='delete')
	{
		$.ajax({
			url:URL,
			type: 'POST',
			dataType: 'json',
			data:{
				'status_list'			: 'delete',
				'simpan_list'			: 1,
				'transaksi_detail_id'	: id
			},
			success:function(data){				
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
				}
				$('.list_exist').remove();
				$('.list').remove();
				list_data_detail($("#transaksi_id").val());
			}
		});	
		
	}
}


$(function() 
{
	
	$('#table_transaksi').bootstrapTable({
		url				: 'transaksi/model/mod_transaksi_jual.php',
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

function clearAll()
{
	$("#toko_id").val();
	$("#tgl_trx").val();
	$("#inv_trx").val();
	$("#nama").val();
	$("#alamat").val();
	$("#no_hp").val();
	$("#no_resi").val();
	$("#status").val();
	$('.list').remove();
	$('.list_exist').remove();
}

function action(act,tab,id)
{
	var URL = 'transaksi/model/mod_transaksi_jual.php';
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
				list_data_detail(data.transaksi_id);
				$("#transaksi_id").val(data.transaksi_id);
				//$("#toko_id").val(data.toko_id);
				$("#tgl_trx").val(data.tgl_trx);
				$("#inv_trx").val(data.inv_trx);
				$("#nama").val(data.inv_trx);
				$("#alamat").val(data.alamat);
				$("#no_hp").val(data.no_hp);
				$("#no_resi").val(data.no_resi);
				$("#status_trx").val(data.status_trx);
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
				'status'		: $("#status").val()
			},
			success:function(data){				
				//alert(data.message);
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
					
					$("#transaksi_id").val(data.transaksi_id);
					$("#trx_detail").css('display', 'block');
					$("#toko_id").prop('disabled', true);
					$("#tgl_trx").prop('disabled', true);
					$("#inv_trx").prop('readonly', true);
					$("#nama").prop('readonly', true);
					$("#alamat").prop('readonly', true);;
					$("#no_hp").prop('readonly', true);
					$("#no_resi").prop('readonly', true);
					
				}
				//backTabs();
				//$('#table_transaksi').bootstrapTable('refresh');
				//clearAll();
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
				$('#table_transaksi').bootstrapTable('refresh');
				clearAll();
			}
		});	
	}
}






</script>

