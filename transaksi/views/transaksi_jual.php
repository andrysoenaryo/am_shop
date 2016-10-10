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
            <div class="table-responsive"><table id="table_trx_jual" ></table></div>
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
                            <select required class="js-select2 form-control input-sm" id="nama_toko" name="nama_toko" style="width: 100%;" data-placeholder="Pilih Toko..">
                                <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                <option value="1">HTML</option>
                                <option value="2">CSS</option>
                                <option value="3">Javascript</option>
                                <option value="4">PHP</option>
                                <option value="5">MySQL</option>
                                <option value="6">Ruby</option>
                                <option value="7">AngularJS</option>
                            </select>
                            <label for="nama_toko">Nama Toko</label>
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
                    <div class="col-sm-10">
                        <div class="form-material form-material-info ">
                            <input type="text" class="form-control input-sm" id="no_resi" name="no_resi" >
                            <label for="no_resi">No Resi</label>
                        </div>
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material  form-material-info ">
                            <select class="js-select2 form-control" id="isactive" name="isactive" size="1">
                            	<option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                            <label for="isactive">Active</label>
                        </div>
                    </div>
                </div>-->
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
            <div class="col-sm-12">
                <table class="table table-striped table-borderless table-header-bg table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" valign="middle" style="width: 100px; vertical-align:central;">
                                <a href="javascript:;" onClick="return addRow()"  class="addRow btn-sm btn-success"> <i class="glyphicon glyphicon-plus"></i></a>
                                <a href="javascript:;" onClick="return removeRow()" class="removeRow btn-sm btn-danger"> <i class="glyphicon glyphicon-minus"></i></a>
                            </th>
                            <th>Product</th>
                            <th class="hidden-xs" style="width: 15%;">Supplier</th>
                            <th class="hidden-xs" style="width: 100px;">Harga Supplier</th>
                            <th class="text-center" style="width: 100px;">Harga Jual</th>
                            <th class="text-center" style="width: 100px;">Qty</th>
                            <th class="hidden-xs" style="width: 100px;">Nominal Refund</th>
                            <th class="hidden-xs" style="width: 70px;">Status</th>
                            <th class="hidden-xs" style="width: 70px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-left">Buku Tulis</td>
                            <td class="hidden-xs">Jasa Kantor</td>
                            <td class="hidden-xs">1.000.000</td>
                            <td class="text-right">1.200.000</td>
                            <td class="text-right">50</td>
                            <td class="hidden-xs">0</td>
                            <td class="hidden-xs">
                                <span class="label label-info">Success</span>
                            </td>
                            <td class="hidden-xs">
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit Client"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove Client"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-left">Buku Tulis</td>
                            <td class="hidden-xs">Jasa Kantor</td>
                            <td class="hidden-xs">1.000.000</td>
                            <td class="text-right">1.200.000</td>
                            <td class="text-right">50</td>
                            <td class="hidden-xs">0</td>
                            <td class="hidden-xs">
                                <span class="label label-danger">Cancel</span>
                            </td>
                            <td class="hidden-xs">
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit Client"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove Client"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-left">Buku Tulis</td>
                            <td class="hidden-xs">Jasa Kantor</td>
                            <td class="hidden-xs">1.000.000</td>
                            <td class="text-right">1.200.000</td>
                            <td class="text-right">50</td>
                            <td class="hidden-xs">500.000</td>
                            <td class="hidden-xs">
                                <span class="label label-warning">Refund</span>
                            </td>
                            <td class="hidden-xs">
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit Client"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove Client"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                   </tbody>
                </table>
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
$(function() {
	
	$('#table_toko').bootstrapTable({
		url				: 'admin_toko/model/mod_toko.php',
		method			: 'get',
		dataType		: 'json',
		queryParams		: {
							grid_table	: 1,
							id_menu		: <?php echo $_GET['id_menu'];?>
						  },
		striped 		: true,
		columns:[[
				{field:'no',title:'#', width:'5%'},
				{field:'toko_id',title:'Kode Toko'},
				{field:'nama_toko',title:'Nama Toko'},
				{field:'isactive',title:'Status'},
				{field:'action',title:'Action', width:'15%'}
			]],
		pageNumber	  : 1,
		pagination	  : true,
		pageSize      : 5,
		pageList      : [5, 10, 25, 50, 100],
		search        : true,
		classes       : 'table table-hover table-bordered table-header-bg',
		sortName      : 'toko_id',
		smartDisplay  : true
	});		

});

function clearAll()
{
	$("#toko_id").val('');	
	$("#nama_toko").val('');
	$("#isactive").val('');
	$("#status").val('');
}

function action(act,tab,id)
{
	var URL = 'admin_toko/model/mod_toko.php';
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
				"toko_id"	: id	
			},
			success:function(data){				
				nextTabs();
				$("#nama_toko").val(data.nama_toko);
				$("#toko_id").val(data.toko_id);
				$("#isactive").val(data.isactive);
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
				'simpan'	: 1,
				'toko_id'	: $("#toko_id").val(),
				'nama_toko'	: $("#nama_toko").val(),
				'isactive'	: $("#isactive").val(),
				'status'	: $("#status").val()
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
				$('#table_toko').bootstrapTable('refresh');
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
				'toko_id'	: id
			},
			success:function(data){				
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
				}
				backTabs();
				$('#table_toko').bootstrapTable('refresh');
				clearAll();
			}
		});	
	}
}






</script>

