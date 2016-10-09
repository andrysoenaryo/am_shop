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
            <div class="table-responsive"><table id="table_account" ></table></div>
        </div>
        <div class="tab-pane" id="tab-form">
            <div id="form" class="form-horizontal push-10-t">
           <!-- <form  action="" method="post" onsubmit="return false;">-->
           		<input class="form-control" type="hidden" id="status" name="status" >
            	<div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material form-material-info ">
                            <input class="form-control" type="text" id="username" name="username" >
                            <label for="username">Username</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material form-material-info ">
                            <input class="form-control" type="text" id="nm_lengkap" name="nm_lengkap" >
                            <label for="nm_lengkap">Nama Lengkap</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material form-material-info ">
                            <input class="form-control" type="password" id="password" name="password" >
                            <label for="password">Password</label>
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

<script>
$('#table_account').bootstrapTable({
	url				: 'admin/model/mod_user_account.php',
	method			: 'get',
    dataType		: 'json',
	queryParams		: {
						grid_table	: 1,
						id_menu		: <?php echo $_GET['id_menu'];?>
					  },
	striped 		: true,
	columns:[[
			{field:'no',title:'#', width:'5%'},
			{field:'username',title:'Username'},
			{field:'nama_lengkap',title:'Nama Lengkap'},
			{field:'password',title:'Password'},
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
	$("#username").val('');
	$("#nm_lengkap").val('');
	$("#password").val('');
	$("#status").val('');
}

function action(act,tab,id)
{
	var URL = 'admin/model/mod_user_account.php';
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
				"username"	: id	
			},
			success:function(data){				
				nextTabs();
				$("#username").val(data.username);
				$("#nm_lengkap").val(data.nama_lengkap);
				$("#password").val(data.password);
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
				'username'	: $("#username").val(),
				'nm_lengkap': $("#nm_lengkap").val(),
				'password'	: $("#password").val(),
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
				$('#table_account').bootstrapTable('refresh');
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
				'username'	: id
			},
			success:function(data){				
				if(data.error)
				{
					alertMSG('danger',data.message);
				}else{
					alertMSG('success',data.message);
				}
				backTabs();
				$('#table_account').bootstrapTable('refresh');
				clearAll();
			}
		});	
	}
}


</script>
