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
            <div class="table-responsive"><table id="table_toko" ></table></div>
        </div>
        <div class="tab-pane" id="tab-form">
            <div id="form" class="form-horizontal push-10-t">
            	<!--<form class="form-horizontal push-10-t" action="" method="post" onsubmit="return false;">-->
                <input class="form-control" type="hidden" id="toko_id" name="toko_id" >
                <input class="form-control" type="hidden" id="status" name="status" >
            	<div class="form-group">
                    <div class="col-sm-4">
                        <div class="form-material form-material-info ">
                            <input class="form-control" type="text" id="nama_toko" name="nama_toko" >
                            <label for="nama_toko">Nama Toko</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material  form-material-info ">
                            <select class="js-select2 form-control" id="isactive" name="isactive" size="1">
                            	<option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                            <label for="isactive">Active</label>
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

<!-- Page JS Code 
<script src="<?php echo $one->assets_folder; ?>/js/pages/base_ui_activity.js"></script>-->
<!--<script>
    $(function(){
        // Init page helpers (BS Notify Plugin)
        App.initHelpers('notify');
    });
</script>-->

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

