<?php require 'inc/config.php'; ?>
<?php require 'inc/views/template_head_start.php'; ?>
<?php $one->Privilege_menu();?>
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick-theme.min.css">

<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>


<div class="content"> 
    <div class="block block-themed">
        <div class="block-header bg-primary">
            <ul class="block-options">
                <li>
                    <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                </li>
            </ul>
            <h3 class="block-title" id="title_page">Home</h3>
        </div>
        
        <div class="block-content" id="frame"></div>
        <div><br></div>
     </div>
</div>
<!-- END Page Content -->

<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>


<script>
    $(function(){
        // Init page helpers (Slick Slider plugin)
        App.initHelpers('slick');
    });
	
	function click_menu(url,title)
	{
		var url = url;
		var title = title;				
		var judul = title.replace("_"," ");

		
		$(document).ready(function($) {
			$('#title_page').html(judul);
			$('#frame').load(url);					
		});
	}
	

</script>

<?php require 'inc/views/template_footer_end.php'; ?>