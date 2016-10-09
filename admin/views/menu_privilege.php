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
            <div class="table-responsive"><table id="table_menu_privilege" ></table></div>
        </div>
        <div class="tab-pane" id="tab-form">
            <div id="form" class="form-horizontal push-10-t">
           <!-- <form  action="" method="post" onsubmit="return false;">-->
           		<input class="form-control" type="hidden" id="status" name="status" >
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material  form-material-info ">
                            <select class="form-control" id="id_role" name="id_role" size="1">
                            </select>
                            <label for="id_role">Select Role</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material  form-material-info ">
                            <select class="form-control" id="id_menu" name="id_menu" size="1">
                            </select>
                            <label for="id_menu">Select Menu</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                        <div class="form-material  form-material-info ">
                            <select class="form-control" id="tambah" name="tambah" size="1">
                            	<option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                            <label for="tambah">Tambah</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-material  form-material-info ">
                            <select class="form-control" id="ubah" name="ubah" size="1">
                            	<option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                            <label for="ubah">Ubah</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-material  form-material-info ">
                            <select class="form-control" id="hapus" name="hapus" size="1">
                            	<option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                            <label for="hapus">Hapus</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-material  form-material-info ">
                            <select class="form-control" id="tampil" name="tampil" size="1">
                            	<option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                            <label for="tampil">View</label>
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
<!-- Page JS Code -->
<script src="<?php echo $one->assets_folder; ?>/js/pages/base_ui_icons.js"></script>

<script>
$('#table_menu_privilege').bootstrapTable({
	url				: 'admin/model/mod_menu_privilege.php',
	method			: 'get',
    dataType		: 'json',
	queryParams		: {
						grid_table	: 1,
						id_menu		: <?php echo $_GET['id_menu'];?>
					  },
	striped 		: true,
	columns:[[
			{field:'no',title:'#', width:'5%'},
			{field:'role',title:'Role'},
			{field:'menu',title:'Menu'},
			{field:'tampil',title:'View'},
			{field:'tambah',title:'Tambah'},
			{field:'ubah',title:'Ubah'},
			{field:'hapus',title:'Hapus'},
			{field:'action',title:'Action', width:'15%'}
		]],
	pageNumber	  : 1,
	pagination	  : true,
    pageSize      : 5,
    pageList      : [5, 10, 25, 50, 100],
    search        : true,
    classes       : 'table table-hover table-bordered table-header-bg  table-sm',
    sortName      : 'username',
    smartDisplay  : true
});


function clearAll()
{
	$("#id_role").val('');
	$("#id_menu").val('');
	$("#tambah").val('');
	$("#ubah").val('');
	$("#hapus").val('');
	$("#tampil").val('');
	$("#status").val('');
}

function action(act,tab,id_role,id_menu)
{
	var URL = 'admin/model/mod_menu_privilege.php';
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
				"edit"	: 1,
				"id_role"	: id_role,
				"id_menu"	: id_menu
					
			},
			success:function(data){				
				nextTabs();
				$("#id_role").val(data.id_role);
				$("#id_menu").val(data.id_menu);
				$("#tambah").val(data.tambah);
				$("#ubah").val(data.ubah);
				$("#hapus").val(data.hapus);
				$("#tampil").val(data.tampil);
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
				'id_role'	: $("#id_role").val(),
				'id_menu'	: $("#id_menu").val(),
				'tambah'	: $("#tambah").val(),
				'ubah'		: $("#ubah").val(),
				'hapus'		: $("#hapus").val(),
				'tampil'	: $("#tampil").val(),
				'status'	: $("#status").val()
			},
			success:function(data){				
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
				}
				backTabs();
				$('#table_menu_privilege').bootstrapTable('refresh');
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
				'id_role'	: id_role,
				'id_menu'	: id_menu
			},
			success:function(data){				
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
				}
				backTabs();
				$('#table_menu_privilege').bootstrapTable('refresh');
				clearAll();
			}
		});	
	}
}


$(function(){
  var items="";
  $.getJSON("admin/model/mod_menu_privilege.php?select=role",function(data){
	  items+="<option value=''></option>";
	$.each(data,function(index,item) 
	{
	  items+="<option value='"+item.id_role+"'>"+item.role+"</option>";
	});
	$("#id_role").html(items); 
  });
});

$(function(){
  var items="";
  $.getJSON("admin/model/mod_menu_privilege.php?select=menu",function(data){
	  items+="<option value=''></option>";
	$.each(data,function(index,item) 
	{
	  items+="<option value='"+item.id+"'>"+item.title+"</option>";
	});
	$("#id_menu").html(items); 
  });
});

</script>
