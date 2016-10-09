// JavaScript Document

// Initialize Tabs
$('[data-toggle="tabs"] a, .js-tabs a').click(function(e){
	e.preventDefault();
	$(this).tab('show');
});


function backTabs()
{
	$('.nav-tabs > .active').prev('li').find('a').trigger('click');
}

function nextTabs()
{
	$('.nav-tabs > .active').next('li').find('a').trigger('click');
}


function alertMSG(typeAlert,messageAlert)
{
	$.notify({
		type: typeAlert,
		message: messageAlert,
		placement: {
			from: "top",
			align: "center"
		},
	});
}