<?php require '../../inc/config.php'; ?>

<!-- Page JS Plugins CSS -->
<!--<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-table/src/bootstrap-table.css">-->

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
            <div class="table-responsive"><table id="table_menu" ></table></div>
        </div>
        <div class="tab-pane" id="tab-form">
            <div id="form" class="form-horizontal push-10-t">
           <!-- <form  action="" method="post" onsubmit="return false;">-->
           		<input class="form-control" type="hidden" id="status" name="status" >
                <input class="form-control" type="hidden" id="id" name="id" >
            	<div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material form-material-info ">
                            <input class="form-control" type="text" id="title" name="title" >
                            <label for="title">Title</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material form-material-info ">
                            <input class="form-control" type="text" id="url" name="url" >
                            <label for="url">Url</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material  form-material-info ">
                            <select class="js-select2 form-control" id="class_icon" name="class_icon" size="1">
                            </select>
                            <label for="class_icon">Select Icon</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material  form-material-info ">
                            <select class="js-select2 form-control" id="parent_id" name="parent_id" size="1">
                            </select>
                            <label for="parent_id">Select Parent Menu</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-material  form-material-info ">
                            <select class="js-select2 form-control" id="active" name="active" size="1">
                            	<option value="0">Yes</option>
                                <option value="1">No</option>
                            </select>
                            <label for="parent_id">Active</label>
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
$('#table_menu').bootstrapTable({
	url				: 'admin/model/mod_menu.php',
	method			: 'get',
    dataType		: 'json',
	queryParams		: {
						grid_table	: 1,
						id_menu		: <?php echo $_GET['id_menu'];?>
					  },
	striped 		: true,
	columns:[[
			{field:'no',title:'#', width:'5%'},
			{field:'parent',title:'Parent Menu'},
			{field:'title',title:'Nama Menu'},
			{field:'url',title:'Url'},
			{field:'class_images',title:'Icon Menu'},
			{field:'active',title:'satus'},
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
	$("#id").val('');
	$("#title").val('');
	$("#url").val('');
	$("#class_icon").val('');
	$("#parent_id").val('');
	$("#active").val('0');
	$("#status").val('');
}

function action(act,tab,id)
{
	var URL = 'admin/model/mod_menu.php';
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
				"id"	: id	
			},
			success:function(data){				
				nextTabs();
				$("#id").val(data.id);
				$("#title").val(data.title);
				$("#url").val(data.url);
				$("#class_icon").val(data.class_images);
				$("#parent_id").val(data.parent_id);
				$("#active").val(data.status);
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
				'id'		: $("#id").val(),
				'title'		: $("#title").val(),
				'url'		: $("#url").val(),
				'class_icon': $("#class_icon").val(),
				'parent_id'	: $("#parent_id").val(),
				'active'	: $("#active").val(),
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
				$('#table_menu').bootstrapTable('refresh');
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
				'id'	: id
			},
			success:function(data){				
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
				}
				backTabs();
				$('#table_menu').bootstrapTable('refresh');
				clearAll();
			}
		});	
	}
}


$(function(){
  var items="";
  $.getJSON("admin/model/mod_menu.php?select=class_icon",function(data){
	  items+="<option value=''></option>";
	$.each(data,function(index,item) 
	{
	  items+="<option value='"+item.class+"'><div class='fa fa-pencil'></div>"+item.nama+"</option>";
	});
	$("#class_icon").html(items); 
  });
});

$(function(){
  var items="";
  $.getJSON("admin/model/mod_menu.php?select=parent_menu",function(data){
	  items+="<option value=''></option>";
	$.each(data,function(index,item) 
	{
	  items+="<option value='"+item.id+"'>"+item.title+"</option>";
	});
	$("#parent_id").html(items); 
  });
});

</script>
