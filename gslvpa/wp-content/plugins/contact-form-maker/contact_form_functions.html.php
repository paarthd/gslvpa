<?php



	if(!current_user_can('manage_options')) {
	die('Access Denied');
}
function html_display_form_lists($rows, $pageNav, $sort,$old_version){


		
	global $wpdb;
	?>
    <script language="javascript">
	function confirmation(href,title) {
		var answer = confirm("Are you sure you want to delete '"+title+"'?")
		if (answer){
			document.getElementById('admin_form').action=href;
			document.getElementById('admin_form').submit();
		}
	}
	function ordering(name,as_or_desc)
	{
		document.getElementById('asc_or_desc').value=as_or_desc;		
		document.getElementById('order_by').value=name;
		document.getElementById('admin_form').submit();
	}
	function doNothing() {  
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    if( keyCode == 13 ) {


        if(!e) var e = window.event;

        e.cancelBubble = true;
        e.returnValue = false;

        if (e.stopPropagation) {
                e.stopPropagation();
                e.preventDefault();
        }
}
}
	</script>
    <form method="post" onkeypress="doNothing()" action="admin.php?page=contact_form" id="admin_form" name="admin_form">
	<table cellspacing="10" width="95%">
    <tr>
   <td style="width:50px">
   <img src="<?php echo plugins_url("images/formmakerLogo-48.png",__FILE__); ?>" />
   </td>
   <td style="width:140px;">
    <h2 style="vertical-align:top;">Contact Form</h2>    </td>
    <td  style="width:90px; text-align:right;"><input class="button-secondary action" type="button" value="Add a Form" name="custom_parametrs" onclick="window.location.href='admin.php?page=contact_form&task=add_form'" /></td>
    <?php if($old_version) {?> <td  style="width:90px; text-align:right;"><input class="button-primary action" type="button" value=" Update Forms" name="update_forms" onclick="window.location.href='admin.php?page=contact_form&task=update'" /></td><?php }?>
<td style="text-align:right;font-size:16px;padding:20px; padding-right:50px">
    <td colspan="11"><div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
		<a href="http://web-dorado.com/files/fromContactForm.php" target="_blank" style="color:red; text-decoration:none;">
		<img src="<?php echo plugins_url( 'images/header.png' , __FILE__ ); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
		Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
		</a>
	</td>
    </tr>
    </table>
    <?php
	$serch_value="";
	if(isset($_POST['serch_or_not'])) {if(esc_html($_POST['serch_or_not'])=="search"){ $serch_value=esc_html($_POST['search_events_by_title']); }else{$serch_value="";}} 
	$serch_fields='<div class="alignleft actions" style="width:180px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
        <input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
	<div class="alignleft actions">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
		 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
		 <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=contact_form\'" class="button-secondary action">
    </div>';
	 print_html_nav($pageNav['total'],$pageNav['limit'],$serch_fields);	
	
	?>
  <table class="wp-list-table widefat fixed pages" style="width:95%">
 <thead>
 <TR>
 <th scope="col" id="id" class="<?php if($sort["sortid_by"]=="id") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" style="width:110px" ><a href="javascript:ordering('id',<?php if($sort["sortid_by"]=="id") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>ID</span><span class="sorting-indicator"></span></a></th>
 <th scope="col" id="title" class="<?php if($sort["sortid_by"]=="title") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" style="" ><a href="javascript:ordering('title',<?php if($sort["sortid_by"]=="title") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Title</span><span class="sorting-indicator"></span></a></th>
 <th scope="col" id="mail" class="<?php if($sort["sortid_by"]=="mail") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" ><a href="javascript:ordering('mail',<?php if($sort["sortid_by"]=="mail") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Email to send submissions to</span><span class="sorting-indicator"></span></a></th>
 <th style="width:80px">Edit</th>
 <th style="width:80px">Delete</th>
 </TR>
 </thead>
 <tbody>
 <?php for($i=0; $i<count($rows);$i++){ ?>
 <tr>
 <?php
 		$old_version = false;
		if(strpos($rows[$i]->form, "wdform_table1")===false)
		{
			$old_version = true;
		}
 ?>
 
 
 			
         <td><?php if(!$old_version) { ?><a  href="admin.php?page=contact_form&task=edit_form&id=<?php echo $rows[$i]->id?>"><?php echo $rows[$i]->id; ?></a><?php }else{?>   <p style="color:red; cursor:pointer; margin:0px" onclick="alert('Update forms to new version!')"><?php echo $rows[$i]->id; ?></p><?php }?></td>
         <td><?php if(!$old_version) { ?><a  href="admin.php?page=contact_form&task=edit_form&id=<?php echo $rows[$i]->id?>"><?php echo $rows[$i]->title; ?></a><?php }else{?>   <p style="color:red; cursor:pointer; margin:0px" onclick="alert('Update forms to new version!')"><?php echo $rows[$i]->title; ?></p><?php }?></td>
         <td><?php echo $rows[$i]->mail; ?></td>
         <td><?php if(!$old_version) { ?><a  href="admin.php?page=contact_form&task=edit_form&id=<?php echo $rows[$i]->id?>">Edit</a><?php }else{?>   <p style="color:red; cursor:pointer; margin:0px" onclick="alert('Update forms to new version!')">Edit</p><?php }?></td>
         <td><a  href="javascript:confirmation('admin.php?page=contact_form&task=remove_form&id=<?php echo $rows[$i]->id?>','<?php echo $rows[$i]->title; ?>')">Delete</a></td>
  </tr> 
 <?php } ?>
 </tbody>
 </table>
 <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_html($_POST['asc_or_desc']);?>"  />
 <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_html($_POST['order_by']);?>"  />

 <?php
?>
    
    
   
 </form>
    <?php

	



}










function html_add_form($themes){
		?>

<script type="text/javascript">


function refresh_()
{
		
	document.getElementById('form').value=document.getElementById('take').innerHTML;
	document.getElementById('counter').value=gen;
	
	
	
	
	
	n=gen;
	for(i=0; i<n; i++)
	{
		if(document.getElementById(i))
		{	
			for(z=0; z<document.getElementById(i).childNodes.length; z++)
				if(document.getElementById(i).childNodes[z].nodeType==3)
					document.getElementById(i).removeChild(document.getElementById(i).childNodes[z]);

			if(document.getElementById(i).getAttribute('type')=="type_captcha" || document.getElementById(i).getAttribute('type')=="type_recaptcha")
			{
				if(document.getElementById(i).childNodes[10])
				{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				}
				else
				{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				}
				continue;
			}
			
			if(document.getElementById(i).getAttribute('type')=="type_section_break")
			{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				continue;
			}
						

			if(document.getElementById(i).childNodes[10])
			{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
			}
			else
			{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
			}
		}
	}
	
	for(i=0; i<=n; i++)
	{	
		if(document.getElementById(i))
		{
			type=document.getElementById(i).getAttribute("type");
				switch(type)
				{
					case "type_text":
					case "type_number":
					case "type_password":
					case "type_submitter_mail":
					case "type_own_select":
					case "type_country":
					case "type_hidden":
					case "type_map":
					{
						remove_add_(i+"_elementform_id_temp");
						break;
					}
					
					case "type_submit_reset":
					{
						remove_add_(i+"_element_submitform_id_temp");
						if(document.getElementById(i+"_element_resetform_id_temp"))
							remove_add_(i+"_element_resetform_id_temp");
						break;
					}
					
					case "type_captcha":
					{
						remove_add_("_wd_captchaform_id_temp");
						remove_add_("_element_refreshform_id_temp");
						remove_add_("_wd_captcha_inputform_id_temp");
						break;
					}
					
					case "type_recaptcha":
					{
						document.getElementById("public_key").value = document.getElementById("wd_recaptchaform_id_temp").getAttribute("public_key");
						document.getElementById("private_key").value= document.getElementById("wd_recaptchaform_id_temp").getAttribute("private_key");
						document.getElementById("recaptcha_theme").value= document.getElementById("wd_recaptchaform_id_temp").getAttribute("theme");
						document.getElementById('wd_recaptchaform_id_temp').innerHTML='';
						remove_add_("wd_recaptchaform_id_temp");
						break;
					}
						
					case "type_file_upload":
						{
							remove_add_(i+"_elementform_id_temp");
								break;
						}
						
					case "type_textarea":
						{
						remove_add_(i+"_elementform_id_temp");

								break;
						}
						
					case "type_name":
						{
						
						if(document.getElementById(i+"_element_titleform_id_temp"))
							{
							remove_add_(i+"_element_titleform_id_temp");
							remove_add_(i+"_element_firstform_id_temp");
							remove_add_(i+"_element_lastform_id_temp");
							remove_add_(i+"_element_middleform_id_temp");
							}
							else
							{
							remove_add_(i+"_element_firstform_id_temp");
							remove_add_(i+"_element_lastform_id_temp");

							}
							break;

						}
						
					case "type_phone":
						{
						
							remove_add_(i+"_element_firstform_id_temp");
							remove_add_(i+"_element_lastform_id_temp");

							break;

						}
						case "type_address":
							{	
								remove_add_(i+"_street1form_id_temp");
								remove_add_(i+"_street2form_id_temp");
								remove_add_(i+"_cityform_id_temp");
								remove_add_(i+"_stateform_id_temp");
								remove_add_(i+"_postalform_id_temp");
								remove_add_(i+"_countryform_id_temp");
							
								break;
	
							}
							
						
					case "type_checkbox":
					case "type_radio":
						{
							is=true;
							for(j=0; j<100; j++)
								if(document.getElementById(i+"_elementform_id_temp"+j))
								{
									remove_add_(i+"_elementform_id_temp"+j);
								}
						/*	if(document.getElementById(i+"_randomize").value=="yes")
								choises_randomize(i);*/
							
							break;
						}
						
					case "type_button":
						{
							for(j=0; j<100; j++)
								if(document.getElementById(i+"_elementform_id_temp"+j))
								{
									remove_add_(i+"_elementform_id_temp"+j);
								}
							break;
						}
						
					case "type_time":
						{	
						if(document.getElementById(i+"_ssform_id_temp"))
							{
							remove_add_(i+"_ssform_id_temp");
							remove_add_(i+"_mmform_id_temp");
							remove_add_(i+"_hhform_id_temp");
							}
							else
							{
							remove_add_(i+"_mmform_id_temp");
							remove_add_(i+"_hhform_id_temp");
							}
							break;

						}
						
					case "type_date":
						{	
						remove_add_(i+"_elementform_id_temp");
						remove_add_(i+"_buttonform_id_temp");
							break;
						}
					case "type_date_fields":
						{	
						remove_add_(i+"_dayform_id_temp");
						remove_add_(i+"_monthform_id_temp");
						remove_add_(i+"_yearform_id_temp");
								break;
						}
				}	
		}
	}
	
	for(i=1; i<=form_view_max; i++)
		if(document.getElementById('form_id_tempform_view'+i))
		{
			if(document.getElementById('page_next_'+i))
				document.getElementById('page_next_'+i).removeAttribute('src');
			if(document.getElementById('page_previous_'+i))
				document.getElementById('page_previous_'+i).removeAttribute('src');
			document.getElementById('form_id_tempform_view'+i).parentNode.removeChild(document.getElementById('form_id_tempform_view_img'+i));
			document.getElementById('form_id_tempform_view'+i).removeAttribute('style');
		}
	
	document.getElementById('form_front').value=document.getElementById('take').innerHTML;

}

function submitform( pressbutton ){

document.getElementById('adminForm').action=document.getElementById('adminForm').action+"&task="+pressbutton;
document.getElementById('adminForm').submit();

}





function submitbutton(pressbutton){

	var form = document.adminForm;
	if (pressbutton == 'cancel') 
	{
		submitform( pressbutton );
		return;
	}

	if (form.title.value == "")
	{
		alert( "The form must have a title." );	
		return ;
	}		

	if(form.mail.value!='')
	{
		subMailArr=form.mail.value.split(',');
		emailListValid=true;
		for(subMailIt=0; subMailIt<subMailArr.length; subMailIt++)
		{
		trimmedMail = subMailArr[subMailIt].replace(/^\s+|\s+$/g, '') ;
		if (trimmedMail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1)
		{
					alert( "This is not a list of valid email addresses." );	
					emailListValid=false;
					break;
		}
		}
		if(!emailListValid)	
		return;
	}	

	tox='';
	
	for(t=1;t<=form_view_max;t++)
	{
		if(document.getElementById('form_id_tempform_view'+t))
		{
			form_view_element=document.getElementById('form_id_tempform_view'+t);
			n=form_view_element.childNodes.length-2;

			for(z=0;z<=n;z++)
			{
				if(form_view_element.childNodes[z].nodeType!=3)
				if(!form_view_element.childNodes[z].id)
				{
					GLOBAL_tr=form_view_element.childNodes[z];
					//////////////////////////////////////////////////////////////////////////////////////////
					for (x=0; x < GLOBAL_tr.firstChild.childNodes.length; x++)
					{
						table=GLOBAL_tr.firstChild.childNodes[x];
						tbody=table.firstChild;
						for (y=0; y < tbody.childNodes.length; y++)
						{
							tr=tbody.childNodes[y];
							l_label = document.getElementById( tr.id+'_element_labelform_id_temp').innerHTML;
							l_label = l_label.replace(/(\r\n|\n|\r)/gm," ");

							if(tr.getAttribute('type')=="type_address")
							{
								addr_id=parseInt(tr.id);
								tox=tox+addr_id+'#**id**#'+'Street Line'+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 
								tox=tox+addr_id+'#**id**#'+'Street Line2'+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 
								tox=tox+addr_id+'#**id**#'+'City'+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
								tox=tox+addr_id+'#**id**#'+'State'+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
								tox=tox+addr_id+'#**id**#'+'Postal'+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
								tox=tox+addr_id+'#**id**#'+'Country'+'#**label**#'+tr.getAttribute('type')+'#****#'; 
							}
							else
								tox=tox+tr.id+'#**id**#'+l_label+'#**label**#'+tr.getAttribute('type')+'#****#';
						}
					}
				}
			}
		}
	}

		document.getElementById('label_order').value=tox;
		refresh_();
		document.getElementById('pagination').value=document.getElementById('pages').getAttribute("type");
		document.getElementById('show_title').value=document.getElementById('pages').getAttribute("show_title");
		document.getElementById('show_numbers').value=document.getElementById('pages').getAttribute("show_numbers");
		
		submitform( pressbutton );

}
gen=1; 
form_view=1; 
form_view_max=1; 
form_view_count=1;

function set_preview()
{
	appWidth			=parseInt(document.body.offsetWidth);
	appHeight			=parseInt(document.body.offsetHeight);
	document.getElementById('preview_form').href='<?php echo admin_url('admin-ajax.php'); ?>?action=frommakerpreview&id='+document.getElementById('theme').value+'&TB_iframe=1';
}


 //add main form  id
    function enable()
	{
	for(iiiii=0; iiiii<1000;iiiii++)
	{
	if(document.getElementsByTagName("iframe")[iiiii]){
		if(document.getElementsByTagName("iframe")[iiiii].id=='contact_form_editor_ifr'){
		id_ifr_editor=iiiii;
		break;
		}
	}
	}
	alltypes=Array('customHTML','text','checkbox','radio','time_and_date','select','file_upload','captcha','map','button','page_break','section_break');
	for(x=0; x<12;x++)
	{
		document.getElementById('img_'+alltypes[x]).src="<?php echo  plugins_url("images",__FILE__) ?>/"+alltypes[x]+".png";
	}
	
		document.getElementById('formMakerDiv').style.display	=(document.getElementById('formMakerDiv').style.display=='block'?'none':'block');
		document.getElementById('formMakerDiv1').style.display	=(document.getElementById('formMakerDiv1').style.display=='block'?'none':'block');
		if(document.getElementById('formMakerDiv').offsetWidth)
			document.getElementById('formMakerDiv1').style.width	=(document.getElementById('formMakerDiv').offsetWidth - 60)+'px';
		document.getElementById('when_edit').style.display		='none';
	}

    function enable2()
	{
	alltypes=Array('customHTML','text','checkbox','radio','time_and_date','select','file_upload','captcha','map','button','page_break','section_break');
	for(x=0; x<12;x++)
	{
		document.getElementById('img_'+alltypes[x]).src="<?php echo  plugins_url("images",__FILE__) ?>/"+alltypes[x]+".png";
	}
	
		document.getElementById('formMakerDiv').style.display	=(document.getElementById('formMakerDiv').style.display=='block'?'none':'block');
		document.getElementById('formMakerDiv1').style.display	=(document.getElementById('formMakerDiv1').style.display=='block'?'none':'block');
		if(document.getElementById('formMakerDiv').offsetWidth)
			document.getElementById('formMakerDiv1').style.width	=(document.getElementById('formMakerDiv').offsetWidth - 60)+'px';
		document.getElementById('when_edit').style.display		='block';
		if(document.getElementById('field_types').offsetWidth)
			document.getElementById('when_edit').style.width	=document.getElementById('field_types').offsetWidth+'px';
		
		if(document.getElementById('field_types').offsetHeight)
			document.getElementById('when_edit').style.height	=document.getElementById('field_types').offsetHeight+'px';
		
	}
	
	
	
	var thickDims, tbWidth, tbHeight;
jQuery(document).ready(function($) {

        thickDims = function() {
                var tbWindow = $('#TB_window'), H = $(window).height(), W = $(window).width(), w, h;

                w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 40;
                h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 40;

                if ( tbWindow.size() ) {
                        tbWindow.width(w).height(h);
                        $('#TB_iframeContent').width(w).height(h - 27);
                        tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
                        if ( typeof document.body.style.maxWidth != 'undefined' )
                                tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
                }
        };

        thickDims();
        $(window).resize( function() { thickDims() } );

        $('a.thickbox-preview').click( function() {
                tb_click.call(this);

                var alink = $(this).parents('.available-theme').find('.activatelink'), link = '', href = $(this).attr('href'), url, text;

                if ( tbWidth = href.match(/&tbWidth=[0-9]+/) )
                        tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
                else
                        tbWidth = $(window).width() - 120;

                if ( tbHeight = href.match(/&tbHeight=[0-9]+/) )
                        tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
                else
                        tbHeight = $(window).height() - 120;

                if ( alink.length ) {
                        url = alink.attr('href') || '';
                        text = alink.attr('title') || '';
                        link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
                } else {
                        text = $(this).attr('title') || '';
                        link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
                }

                $('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
                $('#TB_closeAjaxWindow').css({'float':'left'});
                $('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);

                $('#TB_iframeContent').width('100%');
                thickDims();

                return false;
        } );

        // Theme details
        $('.theme-detail').click(function () {
                $(this).siblings('.themedetaildiv').toggle();
                return false;
        });

});

    </script>
<style>
.calendar .button
{
display:table-cell !important;
}
#when_edit
{
position:absolute;
background-color:#666;
z-index:101;
display:none;
width:100%;
height:100%;
opacity: 0.7;
filter: alpha(opacity = 70);
}
#formMakerDiv
{
position:fixed;
background-color:#666;
z-index:100;
display:none;
left:0;
top:0;
width:100%;
height:100%;
opacity: 0.7;
filter: alpha(opacity = 70);
}
#formMakerDiv1
{
	padding-top:20px;
position:fixed;
z-index:100;
background-color:transparent;
top:0;
left:0;
display:none;
margin-left:30px;
margin-top:15px;
}
</style>
<?php
foreach($themes as $theme) 
	{
		if($theme->default == 1 )
		{		
			$my_selected_theme=$theme->id;

		}	
		
	}
    ?>
  <table width="95%">
  <tr>
  <td colspan="11"><div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
		<a href="http://web-dorado.com/files/fromContactForm.php" target="_blank" style="color:red; text-decoration:none;">
		<img src="<?php echo plugins_url( 'images/header.png' , __FILE__ ); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
		Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
		</a></div>
	</td>
    </tr>
  <tr>
  <td width="100%" ><?php echo "<h2>Contact Form</h2>"; ?></td>
  <td><a id="preview_form" href="<?php echo admin_url('admin-ajax.php').'?action=frommakerpreview&id='.$my_selected_theme.'&TB_iframe=1'; ?>" class="thickbox-preview" title="Form Preview" onclick="return false;"><input type="button"  value="preview" class="button-primary" /></a> </td>
  <td><input type="button" onclick="submitbutton('Actions_after_submission')" value="Actions after submission" class="button-primary" /> </td>
  <td> <input type="button" onclick="submitbutton('Edit_JavaScript')" value="Edit JavaScript" class="button-primary" /> </td>  
  <td style="width:300px"><input type="button" onclick="submitbutton('Custom_text_in_email_for_administrator')" value="Custom text in email for administrator" class="button-primary" /> </td>
  <td style="width:300px"><input type="button" onclick="submitbutton('Custom_text_in_email_for_user')" value="Custom text in email for user" class="button-primary" /> </td>
  <td align="right"><input type="button" onclick="submitbutton('Save')" value="Save" class="button-secondary action" /> </td>  
  <td align="right"><input type="button" onclick="submitbutton('Apply')" value="Apply"  class="button-secondary action"/> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=contact_form'" value="Cancel" class="button-secondary action" /> </td> 
  </tr>
  </table>
  <br />

<form action="admin.php?page=contact_form" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
<table  style="border:6px #00aeef solid; background-color:#00aeef " width="95%" cellpadding="0" cellspacing="0">
<tr>


    <td align="left" valign="middle" rowspan="3" style="padding:10px;">
    <img src="<?php echo  plugins_url("images/FormMaker.png",__FILE__) ?>" />
	</td>

    <td width="300" align="right" valign="middle">

    <span style="font-size:16.76pt; font-family:BauhausItcTEEMed; color:#FFFFFF; vertical-align:middle;">Form title:&nbsp;&nbsp;</span>

    </td>

    <td width="153" height="30px" align="center" valign="middle">

    <div style="background-image:url(<?php echo plugins_url("images/input.png",__FILE__) ?>); height:19px">
    <input type="hidden" value="<?php echo plugins_url("",__FILE__) ?>" id="form_plugins_url" />
    <input id="title" name="title" style="background:none; padding:inherit; width:151px; height:19px; border:none; font-size:11px; " />

    </div>

    </td>
	
</tr>


<tr>

    <td width="300" align="right" valign="middle">

    <span style="font-size:16.76pt; font-family:BauhausItcTEEMed; color:#FFFFFF; vertical-align:middle;">Email to send submissions to:&nbsp;&nbsp;</span>

    </td>

    <td width="153" height="30px" align="center" valign="middle">

    <div style="background-image:url(<?php echo  plugins_url("images/input.png",__FILE__) ?>); height:19px">

    <input id="mail" name="mail"  style="background:none; padding:inherit; width:151px; height:19px; border:none; font-size:11px" />

    </div>

    </td>

    </tr>

<tr>

    <td width="300" align="right" valign="middle">

    <span style="font-size:16.76pt; font-family:BauhausItcTEEMed; color:#FFFFFF; vertical-align:middle;">Theme:&nbsp;&nbsp;</span>

    </td>

    <td width="153" height="30px" align="center" valign="middle">

    <div style="height:19px">

    <select id="theme" name="theme" style="background:transparent; width:151px; height:19px; border:none; font-size:11px" onChange="set_preview()" >
	
	<?php 
	$form_theme='';
	foreach($themes as $theme) 
	{
		if($theme->default == 1 )
		{		
			echo '<option value="'.$theme->id.'" selected>'.$theme->title.'</option>';
			$form_theme=$theme->css;
		}	
		else
			echo '<option value="'.$theme->id.'">'.$theme->title.'</option>';
		
	}
	?>
	</select>

    </div>

    </td>

    </tr>



  <tr>
  <td align="left" colspan="3">
  
  <img src="<?php echo plugins_url("images/addanewfield.png",__FILE__)  ?>" onclick="enable(); Enable()" style="cursor:pointer;margin:10px;" />

  </td>
  </tr>
  </table>
  
  
  
<div id="formMakerDiv" onclick="close_window()"></div>   

<div id="formMakerDiv1" align="center">
    
<table border="0" width="100%" cellpadding="0" cellspacing="0" height="100%" style="border:6px #00aeef solid; background-color:#FFF">
  <tr>
    <td style="padding:0px">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
        <tr valign="top">
         <td width="15%" height="100%" style="border-right:dotted black 1px;" id="field_types">
         <div id="when_edit" style="display:none"></div>
            <table border="0" cellpadding="0" cellspacing="3" width="100%">
            <tr>
            <td align="center" onClick="addRow('customHTML')" id="table_editor" class="field_buttons"><img src="<?php echo plugins_url("images/customHTML.png",__FILE__); ?>" style="margin:5px" id="img_customHTML"/></td>
            
            <td align="center" onClick="addRow('text')" id="table_text" class="field_buttons"><img src="<?php echo plugins_url("images/text.png",__FILE__); ?>" style="margin:5px" id="img_text"/></td>
            </tr>
            <tr>
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" id="table_time_and_date" style="background-color: rgb(114, 113, 113) !important;" class="field_buttons"><img src="<?php echo plugins_url("images/time_and_date.png",__FILE__); ?>" style="margin:5px" id="img_time_and_date"/></td>
            
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" id="table_select" style="background-color: rgb(114, 113, 113) !important;" class="field_buttons" ><img src="<?php echo plugins_url("images/select.png",__FILE__); ?>" style="margin:5px" id="img_select"/></td>
            </tr>
            <tr>             
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" id="table_checkbox" style="background-color: rgb(114, 113, 113) !important;" class="field_buttons"><img src="<?php echo plugins_url("images/checkbox.png",__FILE__); ?>" style="margin:5px" id="img_checkbox"/></td>
            
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" id="table_radio" style="background-color: rgb(114, 113, 113) !important;" class="field_buttons"><img src="<?php echo plugins_url("images/radio.png",__FILE__); ?>" style="margin:5px" id="img_radio"/></td>
            </tr>
            <tr>
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" id="table_file_upload" style="background-color: rgb(114, 113, 113) !important;" class="field_buttons"><img src="<?php echo plugins_url("images/file_upload.png",__FILE__); ?>" style="margin:5px" id="img_file_upload"/></td>
            
            <td align="center" onClick="addRow('captcha')" id="table_captcha" class="field_buttons"><img src="<?php echo plugins_url("images/captcha.png",__FILE__); ?>" style="margin:5px" id="img_captcha"/></td>
            </tr>
            <tr>
            <td align="center" onClick="addRow('page_break')" id="table_page_break" class="field_buttons"><img src="<?php echo plugins_url("images/page_break.png",__FILE__); ?>" style="margin:5px" id="img_page_break"/></td>  
            
            <td align="center" onClick="addRow('section_break')" id="table_section_break" class="field_buttons"><img src="<?php echo plugins_url("images/section_break.png",__FILE__); ?>" style="margin:5px" id="img_section_break"/></td>
            </tr>
            <tr>
            <td align="center" onClick="addRow('map')" id="table_map" class="field_buttons"><img src="<?php echo plugins_url("images/map.png",__FILE__); ?>" style="margin:5px" id="img_map"/></td>  
            
            <td align="center" onClick="addRow('button')" id="table_button" class="field_buttons"><img src="<?php echo plugins_url("images/button.png",__FILE__); ?>" style="margin:5px" id="img_button"/></td>
            </tr>
            </table>
         </td>
         <td width="40%" height="100%" align="left"><div id="edit_table" style="padding:0px; overflow-y:scroll; height:531px" ></div></td>
   <td align="center" valign="top" style="background:url(<?php echo plugins_url("images/border2.png",__FILE__); ?>) repeat-y;">&nbsp;</td>
         <td style="padding:15px">
         <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
         
            <tr>
                <td align="right"><input type="radio" value="end" name="el_pos" checked="checked" id="pos_end" onclick="Disable()"/>
                  At The End
                  <input type="radio" value="begin" name="el_pos" id="pos_begin" onclick="Disable()"/>
                  At The Beginning
                  <input type="radio" value="before" name="el_pos" id="pos_before" onclick="Enable()"/>
                  Before
                  <select style="width:100px; margin-left:5px" id="sel_el_pos" disabled="disabled">
                  </select>
                  <img alt="ADD" title="add" style="cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo plugins_url("images/save.png",__FILE__); ?>" onClick="add(0)"/>
                  <img alt="CANCEL" title="cancel"  style=" cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo plugins_url("images/cancel_but.png",__FILE__); ?>" onClick="close_window()"/>
				
                	<hr style=" margin-bottom:10px" />
                  </td>
              </tr>
              
              <tr height="100%" valign="top">
                <td  id="show_table"></td>
              </tr>
              
            </table>
         </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<input type="hidden" id="old" />
<input type="hidden" id="old_selected" />
<input type="hidden" id="element_type" />
<input type="hidden" id="editing_id" />
<input type="hidden" id="editing_page_break" />
<div id="main_editor" style="position:absolute; display:none; z-index:140;"><?php
if(function_exists ('the_editor') || function_exists ('wp_editor')){ 
if(get_bloginfo('version')<'3.3'){?>
<div  style=" max-width:500px; height:300px;text-align:left" id="poststuff">
<div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea"><?php the_editor("","contact_form_editor","title",$media_buttons = true, $tab_index = 1, $extended = true ); ?>
</div>
<?php  } else { echo "<style>#wp-contact_form_editor-media-buttons{ text-align:left }</style>"; wp_editor("","contact_form_editor");}?>
</div>
<?php



}
else
{
?>
<textarea name="editor" id="editor" cols="40" rows="6" style="width: 450px; height: 350px; " class="mce_editable" aria-hidden="true"></textarea>
<?php

}
 ?>


</div>

<?php if(!function_exists ('the_editor'))
?>
<iframe id="tinymce" style="display:none"></iframe>

<?php
?>



<br />
<br />

<fieldset>

    <legend>

    <h2 style="color:#00aeef">Form</h2>
    
    </legend>

     <style><?php global $first_css;
	 				 echo $first_css; ?></style>

<table width="100%" style="margin:8px"><tr id="page_navigation"><td align="center" width="90%" id="pages" show_title="false" show_numbers="true" type="none"></td><td align="left" id="edit_page_navigation"></td></tr></table>
<div id="take" class="main"><table cellpadding="4" cellspacing="0" class="wdform_table1" style="border-top:0px solid black;"><tbody id="form_id_tempform_view1" class="wdform_tbody1" page_title="Untitled page" next_title="Next" next_type="button" next_class="wdform_page_button" next_checkable="false" previous_title="Previous" previous_type="button" previous_class="wdform_page_button" previous_checkable="false"><tr class="wdform_tr1" ><td class="wdform_td1" ><table class="wdform_table2"><tbody class="wdform_tbody2"></tbody></table></td></tr><tr class="wdform_footer"><td colspan="100" valign="top"><table width="100%" style="padding-right:170px"><tbody><tr id="form_id_temppage_nav1"></tr></tbody></table></td></tr><tbody id="form_id_tempform_view_img1" style="float:right !important ;" ><tr><td width="0%"></td><td align="right"><img src="<?php echo plugins_url("images/minus.png",__FILE__); ?>" title="Show or hide the page" class="page_toolbar" onclick="show_or_hide('1')" id="show_page_img_1" /></td><td><img src="<?php echo plugins_url("images/page_delete.png",__FILE__); ?>" title="Delete the page"  class="page_toolbar" onclick="remove_page('1')" /></td><td><img src="<?php echo plugins_url("images/page_delete_all.png",__FILE__); ?>" title="Delete the page with fields"  class="page_toolbar" onclick="remove_page_all('1')" /></td><td><img src="<?php echo plugins_url("images/page_edit.png",__FILE__); ?>" title="Edit the page"  class="page_toolbar" onclick="edit_page_break('1')" /></td></tr></tbody></table></div>
</fieldset>

 <input type="hidden" name="form_front" id="form_front" />
    <input type="hidden" name="form" id="form" />

    <input type="hidden" name="counter" id="counter" />
    
    <input type="hidden" name="pagination" id="pagination" />
    <input type="hidden" name="show_title" id="show_title" />
    <input type="hidden" name="show_numbers" id="show_numbers" />
	
    <input type="hidden" name="public_key" id="public_key" />
    <input type="hidden" name="private_key" id="private_key" />
    <input type="hidden" name="recaptcha_theme" id="recaptcha_theme" />

	<input type="hidden" name="label_order" id="label_order" />
    <input type="hidden" name="option" value="com_formmaker" />

    <input type="hidden" name="task" value="" />

</form>

<script>
plugin_url=document.getElementById('form_plugins_url').value;
	//appWidth			=parseInt(document.body.offsetWidth);
	//appHeight			=parseInt(document.body.offsetHeight);
	//document.getElementById('toolbar-popup-popup').childNodes[1].href='index.php?option=com_formmaker&task=preview&tmpl=component&theme='+document.getElementById('theme').value;
	//document.getElementById('toolbar-popup-popup').childNodes[1].setAttribute('rel',"{handler: 'iframe', size: {x:"+(appWidth-100)+", y: "+(appHeight-30)+"}}");
</script>
<?php


}














function html_edit_contact_form($row, $labels, $themes){

	?>
    
<script type="text/javascript">



function submitform( pressbutton ){

document.getElementById('adminForm').action=document.getElementById('adminForm').action+"&task="+pressbutton;
document.getElementById('adminForm').submit();

}
function submitbutton(pressbutton) 

{

	if(!document.getElementById('araqel'))
	{
		alert('Please wait while page loading');
		return;
	}
	else
		if(document.getElementById('araqel').value=='0')
		{
			alert('Please wait while page loading');
			return;
		}
		
	var form = document.adminForm;

	if (pressbutton == 'cancel') 

	{

		submitform( pressbutton );

		return;

	}

	if (form.title.value == "")

	{

				alert( "The form must have a title." );	
				return;

	}		

	if(form.mail.value!='')
	{
		subMailArr=form.mail.value.split(',');
		emailListValid=true;
		for(subMailIt=0; subMailIt<subMailArr.length; subMailIt++)
		{
		trimmedMail = subMailArr[subMailIt].replace(/^\s+|\s+$/g, '') ;
		if (trimmedMail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1)
		{
					alert( "This is not a list of valid email addresses." );	
					emailListValid=false;
					break;
		}
		}
		if(!emailListValid)	
		return

	}		
	
		tox='';
		l_id_array=[<?php echo $labels['id']?>];
		l_label_array=[<?php echo $labels['label']?>];
		l_type_array=[<?php echo $labels['type']?>];
		l_id_removed=[];
		
		for(x=0; x< l_id_array.length; x++)
			{
				l_id_removed[x]=true;
			}

for(t=1;t<=form_view_max;t++)
{
	if(document.getElementById('form_id_tempform_view'+t))
	{
		form_view_element=document.getElementById('form_id_tempform_view'+t);		
		n=form_view_element.childNodes.length-2;
		
		for(q=0;q<=n;q++)
		{
				if(form_view_element.childNodes[q].nodeType!=3)
				if(!form_view_element.childNodes[q].id)
				{
					GLOBAL_tr=form_view_element.childNodes[q];
					
					for (x=0; x < GLOBAL_tr.firstChild.childNodes.length; x++)
					{
			
						table=GLOBAL_tr.firstChild.childNodes[x];
						tbody=table.firstChild;
						for (y=0; y < tbody.childNodes.length; y++)
						{
							is_in_old=false;
							tr=tbody.childNodes[y];
							l_id=tr.id;
							
							l_label=document.getElementById( tr.id+'_element_labelform_id_temp').innerHTML;
							l_label = l_label.replace(/(\r\n|\n|\r)/gm," ");
							l_type=tr.getAttribute('type');
							for(z=0; z< l_id_array.length; z++)
							{
								if(l_id_array[z]==l_id)
								{
									l_id_removed[z]=false;
									if(l_type_array[z]=="type_address")
									{
										z++;	
										l_id_removed[z]=false;
										z++;	
										l_id_removed[z]=false;
										z++;	
										l_id_removed[z]=false;
										z++;	
										l_id_removed[z]=false;
										z++;	
										l_id_removed[z]=false;
									}
								}
							}
							
								if(tr.getAttribute('type')=="type_address")
								{
									addr_id=parseInt(tr.id);
									tox=tox+addr_id+'#**id**#'+'Street Line'+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 
									tox=tox+addr_id+'#**id**#'+'Street Line2'+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 
									tox=tox+addr_id+'#**id**#'+'City'+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
									tox=tox+addr_id+'#**id**#'+'State'+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
									tox=tox+addr_id+'#**id**#'+'Postal'+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
									tox=tox+addr_id+'#**id**#'+'Country'+'#**label**#'+tr.getAttribute('type')+'#****#'; 
								}
								else
									tox=tox+l_id+'#**id**#'+l_label+'#**label**#'+l_type+'#****#';

							
							
						}
					}
				}
		}
	}	
}
	for(x=0; x< l_id_array.length; x++)
	{
		if(l_id_removed[x])
				tox=tox+l_id_array[x]+'#**id**#'+l_label_array[x]+'#**label**#'+l_type_array[x]+'#****#';
	}
	
	
	document.getElementById('label_order').value=tox;
	
	
	refresh_()
	document.getElementById('pagination').value=document.getElementById('pages').getAttribute("type");
	document.getElementById('show_title').value=document.getElementById('pages').getAttribute("show_title");
	document.getElementById('show_numbers').value=document.getElementById('pages').getAttribute("show_numbers");
	
	
		submitform( pressbutton );
}

function remove_whitespace(node)
{
	for (ttt=0; ttt < node.childNodes.length; ttt++)
	{
        if( node.childNodes[ttt].nodeType == '3')
		{
			if(!node.childNodes[ttt])
			node.removeChild(node.childNodes[ttt]);
		}
		else
		{
			if(node.childNodes[ttt].childNodes.length)
				remove_whitespace(node.childNodes[ttt]);
		}
	}
	return
}

function refresh_()
{
		
	document.getElementById('form').value=document.getElementById('take').innerHTML;
	document.getElementById('counter').value=gen;
	n=gen;
	for(i=0; i<n; i++)
	{
		if(document.getElementById(i))
		{	
			for(z=0; z<document.getElementById(i).childNodes.length; z++)
				if(document.getElementById(i).childNodes[z].nodeType==3)
					document.getElementById(i).removeChild(document.getElementById(i).childNodes[z]);

			if(document.getElementById(i).getAttribute('type')=="type_captcha" || document.getElementById(i).getAttribute('type')=="type_recaptcha")
			{
				if(document.getElementById(i).childNodes[10])
				{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				}
				else
				{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				}
				continue;
			}
						
			if(document.getElementById(i).getAttribute('type')=="type_section_break")
			{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				continue;
			}
						


			if(document.getElementById(i).childNodes[10])
			{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
			}
			else
			{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
			}
		}
	}
	
	for(i=0; i<=n; i++)
	{	
		if(document.getElementById(i))
		{
			type=document.getElementById(i).getAttribute("type");
				switch(type)
				{
					case "type_text":
					case "type_number":
					case "type_password":
					case "type_submitter_mail":
					case "type_own_select":
					case "type_country":
					case "type_hidden":
					case "type_map":
					{
						remove_add_(i+"_elementform_id_temp");
						break;
					}
					
					case "type_submit_reset":
					{
						remove_add_(i+"_element_submitform_id_temp");
						if(document.getElementById(i+"_element_resetform_id_temp"))
							remove_add_(i+"_element_resetform_id_temp");
						break;
					}
					
					case "type_captcha":
					{
						remove_add_("_wd_captchaform_id_temp");
						remove_add_("_element_refreshform_id_temp");
						remove_add_("_wd_captcha_inputform_id_temp");
						break;
					}
					
					case "type_recaptcha":
					{
						document.getElementById("public_key").value = document.getElementById("wd_recaptchaform_id_temp").getAttribute("public_key");
						document.getElementById("private_key").value= document.getElementById("wd_recaptchaform_id_temp").getAttribute("private_key");
						document.getElementById("recaptcha_theme").value= document.getElementById("wd_recaptchaform_id_temp").getAttribute("theme");
						document.getElementById('wd_recaptchaform_id_temp').innerHTML='';
						remove_add_("wd_recaptchaform_id_temp");
						break;
					}
						
					case "type_file_upload":
						{
							remove_add_(i+"_elementform_id_temp");
							
								break;
						}
						
					case "type_textarea":
						{
						remove_add_(i+"_elementform_id_temp");

								break;
						}
						
					case "type_name":
						{
						
							if(document.getElementById(i+"_element_titleform_id_temp"))
							{
								remove_add_(i+"_element_titleform_id_temp");
								remove_add_(i+"_element_firstform_id_temp");
								remove_add_(i+"_element_lastform_id_temp");
								remove_add_(i+"_element_middleform_id_temp");
							}
							else
							{
								remove_add_(i+"_element_firstform_id_temp");
								remove_add_(i+"_element_lastform_id_temp");
							}
								break;

						}
						
					case "type_phone":
						{
						
							remove_add_(i+"_element_firstform_id_temp");
							remove_add_(i+"_element_lastform_id_temp");
							break;

						}
						case "type_address":
							{	
								remove_add_(i+"_street1form_id_temp");
								remove_add_(i+"_street2form_id_temp");
								remove_add_(i+"_cityform_id_temp");
								remove_add_(i+"_stateform_id_temp");
								remove_add_(i+"_postalform_id_temp");
								remove_add_(i+"_countryform_id_temp");
							
								break;
	
							}
							
						
					case "type_checkbox":
					case "type_radio":
						{
							is=true;
							for(j=0; j<100; j++)
								if(document.getElementById(i+"_elementform_id_temp"+j))
								{
									remove_add_(i+"_elementform_id_temp"+j);
								}

							/*if(document.getElementById(i+"_randomize").value=="yes")
								choises_randomize(i);*/
							
							break;
						}
						
					case "type_button":
						{
							for(j=0; j<100; j++)
								if(document.getElementById(i+"_elementform_id_temp"+j))
								{
									remove_add_(i+"_elementform_id_temp"+j);
								}
							break;
						}
						
					case "type_time":
						{	
						if(document.getElementById(i+"_ssform_id_temp"))
							{
							remove_add_(i+"_ssform_id_temp");
							remove_add_(i+"_mmform_id_temp");
							remove_add_(i+"_hhform_id_temp");
							}
							else
							{
							remove_add_(i+"_mmform_id_temp");
							remove_add_(i+"_hhform_id_temp");

							}
							break;

						}
						
					case "type_date":
						{	
						remove_add_(i+"_elementform_id_temp");
						remove_add_(i+"_buttonform_id_temp");
						
							break;
						}
					case "type_date_fields":
						{	
						remove_add_(i+"_dayform_id_temp");
						remove_add_(i+"_monthform_id_temp");
						remove_add_(i+"_yearform_id_temp");
								break;
						}
				}	
		}
	}
	
	for(i=1; i<=form_view_max; i++)
	{
		if(document.getElementById('form_id_tempform_view'+i))
		{
			if(document.getElementById('page_next_'+i))
				document.getElementById('page_next_'+i).removeAttribute('src');
			if(document.getElementById('page_previous_'+i))
				document.getElementById('page_previous_'+i).removeAttribute('src');
			
			document.getElementById('form_id_tempform_view'+i).parentNode.removeChild(document.getElementById('form_id_tempform_view_img'+i));
			document.getElementById('form_id_tempform_view'+i).removeAttribute('style');
		}
	}
	

	document.getElementById('form_front').value=document.getElementById('take').innerHTML;

}

function set_preview()
{
	appWidth			=parseInt(document.body.offsetWidth);
	appHeight			=parseInt(document.body.offsetHeight);
	document.getElementById('preview_form').href='<?php echo admin_url('admin-ajax.php'); ?>?action=frommakerpreview&id='+document.getElementById('theme').value+'&TB_iframe=1';
}

	gen=<?php echo $row->counter; ?>;//add main form  id
    function enable()
	{
	for(iiiii=0; iiiii<1000;iiiii++)
	{
	if(document.getElementsByTagName("iframe")[iiiii]){
		if(document.getElementsByTagName("iframe")[iiiii].id=='contact_form_editor_ifr'){
		id_ifr_editor=iiiii;
		break;
		}
	}
	}
	alltypes=Array('customHTML','text','checkbox','radio','time_and_date','select','file_upload','captcha','map','button','page_break','section_break');
	for(x=0; x<12;x++)
	{
		document.getElementById('img_'+alltypes[x]).src="<?php echo plugins_url("images/",__FILE__) ?>"+alltypes[x]+".png";
	}
	

		document.getElementById('formMakerDiv').style.display	=(document.getElementById('formMakerDiv').style.display=='block'?'none':'block');
		document.getElementById('formMakerDiv1').style.display	=(document.getElementById('formMakerDiv1').style.display=='block'?'none':'block');
		
		if(document.getElementById('formMakerDiv').offsetWidth)
			document.getElementById('formMakerDiv1').style.width	=(document.getElementById('formMakerDiv').offsetWidth - 60)+'px';
		document.getElementById('when_edit').style.display		='none';
	}

    function enable2()
	{
	
	alltypes=Array('customHTML','text','checkbox','radio','time_and_date','select','file_upload','captcha','map','button','page_break','section_break');
	for(x=0; x<12;x++)
	{

		document.getElementById('img_'+alltypes[x]).src="<?php echo plugins_url("images/",__FILE__) ?>"+alltypes[x]+".png";
	}
	

		document.getElementById('formMakerDiv').style.display	=(document.getElementById('formMakerDiv').style.display=='block'?'none':'block');
		document.getElementById('formMakerDiv1').style.display	=(document.getElementById('formMakerDiv1').style.display=='block'?'none':'block');
		if(document.getElementById('formMakerDiv').offsetWidth)
			document.getElementById('formMakerDiv1').style.width	=(document.getElementById('formMakerDiv').offsetWidth - 60)+'px';
		document.getElementById('when_edit').style.display		='block';
		if(document.getElementById('field_types').offsetWidth)
			document.getElementById('when_edit').style.width	=document.getElementById('field_types').offsetWidth+'px';
		
		if(document.getElementById('field_types').offsetHeight)
			document.getElementById('when_edit').style.height	=document.getElementById('field_types').offsetHeight+'px';
		
		//document.getElementById('when_edit').style.position='none';
		
	}
	
	var thickDims, tbWidth, tbHeight;
jQuery(document).ready(function($) {

        thickDims = function() {
                var tbWindow = $('#TB_window'), H = $(window).height(), W = $(window).width(), w, h;

                w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 40;
                h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 40;

                if ( tbWindow.size() ) {
                        tbWindow.width(w).height(h);
                        $('#TB_iframeContent').width(w).height(h - 27);
                        tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
                        if ( typeof document.body.style.maxWidth != 'undefined' )
                                tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
                }
        };

        thickDims();
        $(window).resize( function() { thickDims() } );

        $('a.thickbox-preview').click( function() {
                tb_click.call(this);

                var alink = $(this).parents('.available-theme').find('.activatelink'), link = '', href = $(this).attr('href'), url, text;

                if ( tbWidth = href.match(/&tbWidth=[0-9]+/) )
                        tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
                else
                        tbWidth = $(window).width() - 120;

                if ( tbHeight = href.match(/&tbHeight=[0-9]+/) )
                        tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
                else
                        tbHeight = $(window).height() - 120;

                if ( alink.length ) {
                        url = alink.attr('href') || '';
                        text = alink.attr('title') || '';
                        link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
                } else {
                        text = $(this).attr('title') || '';
                        link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
                }

                $('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
                $('#TB_closeAjaxWindow').css({'float':'left'});
                $('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);

                $('#TB_iframeContent').width('100%');
                thickDims();

                return false;
        } );

        // Theme details
        $('.theme-detail').click(function () {
                $(this).siblings('.themedetaildiv').toggle();
                return false;
        });

});

    </script>
<style>
.calendar .button
{
display:table-cell !important;
}
#when_edit
{
position:absolute;
background-color:#666;
z-index:101;
display:none;
width:100%;
height:100%;
opacity: 0.7;
filter: alpha(opacity = 70);
}

#formMakerDiv
{
position:fixed;
background-color:#666;
z-index:100;
display:none;
left:0;
top:0;
width:100%;
height:100%;
opacity: 0.7;
filter: alpha(opacity = 70);
}
#formMakerDiv1
{
	padding-top:20px;
position:fixed;
z-index:100;
background-color:transparent;
top:0;
left:0;
display:none;
margin-left:30px;
margin-top:15px;
}
</style>
  <table width="95%">
    <tr>
  <td colspan="11"><div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
		<a href="http://web-dorado.com/files/fromContactForm.php" target="_blank" style="color:red; text-decoration:none;">
		<img src="<?php echo plugins_url( 'images/header.png' , __FILE__ ); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
		Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
		</a></div>
	</td>
    </tr>
  <tr>
  <td width="100%"><?php echo "<h2>Contact Form</h2>"; ?></td>
   <td><a id="preview_form" href="<?php echo admin_url('admin-ajax.php').'?action=frommakerpreview&id='.$row->theme.'&TB_iframe=1'; ?>" class="thickbox-preview" title="Form Preview" onclick="return false;"><input type="button"  value="preview" class="button-primary" /></a> </td>
  <td><input type="button" onclick="submitbutton('Actions_after_submission')" value="Actions after submission" class="button-primary" /> </td>
  <td> <input type="button" onclick="submitbutton('Edit_JavaScript')" value="Edit JavaScript" class="button-primary" /> </td>  
  <td style="width:300px"><input type="button" onclick="submitbutton('Custom_text_in_email_for_administrator')" value="Custom text in email for administrator" class="button-primary" /> </td>
  <td style="width:300px"><input type="button" onclick="submitbutton('Custom_text_in_email_for_user')" value="Custom text in email for user" class="button-primary" /> </td>
  <td style="width:300px"><input type="button" onclick="submitbutton('save_as_copy')" value="Save As Copy" class="button-secondary action" /> </td>
  <td align="right"><input type="button" onclick="submitbutton('Save')" value="Save" class="button-secondary action" /> </td>  
  <td align="right"><input type="button" onclick="submitbutton('Apply')" value="Apply"  class="button-secondary action"/> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=contact_form'" value="Cancel" class="button-secondary action" /> </td> 
  </tr>
  </table>
  <br />



<form action="admin.php?page=contact_form&id=<?php echo $row->id; ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<table  style="border:6px #00aeef solid; background-color:#00aeef" width="95%" cellpadding="0" cellspacing="0">
<tr>


    <td align="left" valign="middle" rowspan="3" style="padding:10px;">
    <img src="<?php echo plugins_url("images/FormMaker.png",__FILE__) ?>" />
	</td>

    <td width="70" align="right" valign="middle">

    <span style="font-size:16.76pt; font-family:BauhausItcTEEMed; color:#FFFFFF; vertical-align:middle;">Form title:&nbsp;&nbsp;</span>

    </td>

    <td width="153" height="30px" align="center" valign="middle">

    <div style="background-image:url(<?php echo plugins_url("images/input.png",__FILE__) ?>);">

    <input id="title" name="title" <?php echo 'value="'.htmlspecialchars($row->title).'"' ?> style="background:none; padding:inherit; width:151px; height:17px; border:none; font-size:11px" />

    </div>

    </td>
	
</tr><tr>

    <td width="300" align="right" valign="middle">

    <span style="font-size:16.76pt; font-family:BauhausItcTEEMed; color:#FFFFFF; vertical-align:middle;">Email to send submissions to:&nbsp;&nbsp;</span>

    </td>

    <td width="153" height="30px" align="center" valign="middle">

    <div style="background-image:url(<?php echo plugins_url("images/input.png",__FILE__) ?>);">

    <input id="mail" name="mail" <?php  echo 'value="'.$row->mail.'"' ?> style="background:none; padding:inherit; width:151px; height:17px; border:none; font-size:11px" />

    </div>

    </td>

    </tr>
<tr>

    <td width="300" height="30px" align="right" valign="middle">

    <span style="font-size:16.76pt; font-family:BauhausItcTEEMed; color:#FFFFFF; vertical-align:middle;">Theme:&nbsp;&nbsp;</span>

    </td>

    <td width="153" align="center" valign="middle">

    <div style="height:19px">

    <select id="theme" name="theme" style="background:transparent; width:151px; height:19px; border:none; font-size:11px"  onChange="set_preview()" >
	
	<?php 
	$form_theme='';
	foreach($themes as $theme) 
	{
		if($theme->id==$row->theme)
		{
			echo '<option value="'.$theme->id.'" selected>'.$theme->title.'</option>';
			$form_theme=$theme->css;
		}
		else
			echo '<option value="'.$theme->id.'">'.$theme->title.'</option>';
	}
	?>
	</select>

    </div>

    </td>

    </tr>



  <tr>
  <td align="left" colspan="3">
  
  <img src="<?php echo plugins_url("images/addanewfield.png",__FILE__) ?>" onclick="enable(); Enable()" style="cursor:pointer;margin:10px;" />

  </td>
  </tr>
  </table>

<div id="formMakerDiv" onclick="close_window()"></div>  
<div id="formMakerDiv1" style="padding-top:20px"  align="center">
    
    
<table border="0" width="100%" cellpadding="0" cellspacing="0" height="100%" style="border:6px #00aeef solid; background-color:#FFF">
  <tr>
    <td style="padding:0px">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
        <tr valign="top">
         <td width="15%" height="100%" style="border-right:dotted black 1px;" id="field_types">
            <div id="when_edit" style="display:none"></div>
		<table border="0" cellpadding="0" cellspacing="3" width="100%">
            <tr>
            <td align="center" onClick="addRow('customHTML')" style="cursor:pointer" id="table_editor"  class="field_buttons"><img src="<?php echo plugins_url("images/customHTML.png",__FILE__) ?>" style="margin:5px" id="img_customHTML"/></td>
            
            <td align="center" onClick="addRow('text')" style="cursor:pointer" id="table_text" class="field_buttons"><img src="<?php echo plugins_url("images/text.png",__FILE__) ?>" style="margin:5px" id="img_text"/></td>
            </tr>
            <tr>
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" style="cursor:pointer; background-color: rgb(114, 113, 113) !important;" id="table_time_and_date" class="field_buttons"><img src="<?php echo plugins_url("images/time_and_date.png",__FILE__) ?>" style="margin:5px" id="img_time_and_date"/></td>
            
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" style="cursor:pointer; background-color: rgb(114, 113, 113) !important;" id="table_select" class="field_buttons"><img src="<?php echo plugins_url("images/select.png",__FILE__) ?>" style="margin:5px" id="img_select"/></td>
            </tr>
            <tr>             
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" style="cursor:pointer; background-color: rgb(114, 113, 113) !important;" id="table_checkbox" class="field_buttons"><img src="<?php echo plugins_url("images/checkbox.png",__FILE__) ?>" style="margin:5px" id="img_checkbox"/></td>
            
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" style="cursor:pointer; background-color: rgb(114, 113, 113) !important;" id="table_radio" class="field_buttons"><img src="<?php echo plugins_url("images/radio.png",__FILE__) ?>" style="margin:5px" id="img_radio"/></td>
            </tr>
            <tr>
            <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" style="cursor:pointer; background-color: rgb(114, 113, 113) !important;" id="table_file_upload" class="field_buttons"><img src="<?php echo plugins_url("images/file_upload.png",__FILE__) ?>" style="margin:5px" id="img_file_upload"/></td>
            
            <td align="center" onClick="addRow('captcha')" style="cursor:pointer" id="table_captcha" class="field_buttons"><img src="<?php echo plugins_url("images/captcha.png",__FILE__) ?>" style="margin:5px" id="img_captcha"/></td>
            </tr>
            <tr>
            <td align="center" onClick="addRow('page_break')" style="cursor:pointer" id="table_page_break" class="field_buttons"><img src="<?php echo plugins_url("images/page_break.png",__FILE__) ?>" style="margin:5px" id="img_page_break"/></td>  
            
            <td align="center" onClick="addRow('section_break')" style="cursor:pointer" id="table_section_break" class="field_buttons"><img src="<?php echo plugins_url("images/section_break.png",__FILE__) ?>" style="margin:5px" id="img_section_break"/></td>
            </tr>
            <tr>
            <td align="center" onClick="addRow('map')" style="cursor:pointer" id="table_map" class="field_buttons"><img src="<?php echo plugins_url("images/map.png",__FILE__) ?>" style="margin:5px" id="img_map"/></td>  
            
            <td align="center" onClick="addRow('button')" style="cursor:pointer" id="table_button" class="field_buttons"><img src="<?php echo plugins_url("images/button.png",__FILE__) ?>" style="margin:5px" id="img_button"/></td>
            </tr>
            </table>

         </td>
         <td width="35%" height="100%" align="left"><div id="edit_table" style="padding:0px; overflow-y:scroll; height:531px" ></div></td>

		 <td align="center" valign="top" style="background:url(<?php echo plugins_url("images/border2.png",__FILE__) ?>) repeat-y;">&nbsp;</td>
         <td style="padding:15px">
         <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
         
            <tr>
                <td align="right"><input type="radio" value="end" name="el_pos" checked="checked" id="pos_end" onclick="Disable()"/>
                  At The End
                  <input type="radio" value="begin" name="el_pos" id="pos_begin" onclick="Disable()"/>
                  At The Beginning
                  <input type="radio" value="before" name="el_pos" id="pos_before" onclick="Enable()"/>
                  Before
                  <select style="width:100px; margin-left:5px" id="sel_el_pos" disabled="disabled">
                  </select>
                  <img alt="ADD" title="add" style="cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo plugins_url("images/save.png",__FILE__) ?>" onClick="add(0)"/>
                  <img alt="CANCEL" title="cancel"  style=" cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo plugins_url("images/cancel_but.png",__FILE__) ?>" onClick="close_window()"/>
				
                	<hr style=" margin-bottom:10px" />
                  </td>
              </tr>
              
              <tr height="100%" valign="top">
                <td  id="show_table"></td>
              </tr>
              
            </table>
         </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<input type="hidden" id="old" />
<input type="hidden" id="old_selected" />
<input type="hidden" id="element_type" />
<input type="hidden" id="editing_id" />
<input type="hidden" value="<?php echo plugins_url("",__FILE__) ?>" id="form_plugins_url" />
<div id="main_editor" style="position:absolute; display:none; z-index:140;"> <?php if(function_exists ('the_editor') || function_exists ('wp_editor')){ 
if(get_bloginfo('version')<'3.3'){?>
<div  style=" max-width:500px; height:300px;text-align:left" id="poststuff">
<div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea"><?php the_editor("","contact_form_editor","title",$media_buttons = true, $tab_index = 1, $extended = true ); ?>
</div>
</div>
<?php  } else { echo "<style>#wp-contact_form_editor-media-buttons{ text-align:left }</style>"; wp_editor("","contact_form_editor");}?>

<?php
}
else
{
?>
<textarea name="contact_form_editor" id="contact_form_editor" cols="40" rows="6" style="width: 440px; height: 350px; " class="mce_editable" aria-hidden="true"></textarea>
<?php

}
 ?></div>
</div>

 <?php if(!function_exists ('the_editor'))
 {
?>
<iframe id="tinymce" style="display:none"></iframe>

<?php
}
?>



<br />
<br />

    <fieldset>

    <legend>

    <h2 style="color:#00aeef">Form</h2>

    </legend>

        <?php
		global $first_css;
    echo '<style>'.$first_css.'</style>';

?><table width="100%" style="margin:8px"><tr id="page_navigation"><td align="center" width="90%" id="pages" show_title="<?php echo $row->show_title; ?>" show_numbers="<?php echo $row->show_numbers; ?>" type="<?php echo $row->pagination; ?>"></td><td align="left" id="edit_page_navigation"></td></tr></table><div id="take"><?php

    if($row->form)

	    echo $row->form;

	  else 

	    echo '<table border="0" cellpadding="4" cellspacing="0" class="wdform_table1" width="100%" style="border-top:0px solid black;"><tbody id="form_view1" style="float:left;" page_title="Untitled page" next_title="Next" next_type="button" next_class="" next_checkable="true" previous_title="Previous" previous_type="button" previous_class="" previous_checkable="true"><tr><td valign="top"><table class="wdform_table2"><tbody></tbody></table></td></tr><tr><td colspan="100" valign="top"><table width="100%" style="padding-right:170px"><tbody><tr id="page_nav1"></tr></tbody></table></td></tr><tbody id="form_view_img1" style="float:right ;display:none" ><tr><td width="0%"></td><td align="right"><img src="'.plugins_url("images/minus.png",__FILE__).'" title="Show or hide the page" class="page_toolbar" onclick="show_or_hide("1")" id="show_page_img_1" /></td><td><img src="'.plugins_url("images/page_delete.png",__FILE__).'" title="Delete the page" class="page_toolbar" onclick="remove_page("1")" /></td><td><img src="'.plugins_url("images/page_delete_all.png",__FILE__).'" title="Delete the page with fields"  class="page_toolbar" onclick="remove_page_all("1")" /></td><td><img src="'.plugins_url("images/page_edit.png",__FILE__).'"  title="Edit the page" class="page_toolbar" onclick="edit_page_break("1")" /></td></tr></tbody></table>';
	 ?></div>

    </fieldset>

    <input type="hidden" name="form" id="form">
    <input type="hidden" name="form_front" id="form_front">
    
    <input type="hidden" name="pagination" id="pagination" />
    <input type="hidden" name="show_title" id="show_title" />
    <input type="hidden" name="show_numbers" id="show_numbers" />

    <input type="hidden" name="public_key" id="public_key" />
    <input type="hidden" name="private_key" id="private_key" />
    <input type="hidden" name="recaptcha_theme" id="recaptcha_theme" />

    <input type="hidden" id="label_order" name="label_order" value="<?php echo $row->label_order;?>" />
    <input type="hidden" name="counter" id="counter" value="<?php echo $row->counter;?>">

<script type="text/javascript">

function formOnload()
{
//enable maps
for(t=0; t<<?php echo $row->counter;?>; t++)
	if(document.getElementById(t+"_typeform_id_temp"))
	{
		if(document.getElementById(t+"_typeform_id_temp").value=="type_map" || document.getElementById(t+"_typeform_id_temp").value=="type_mark_map")
		{
			if_gmap_init(t);
			for(q=0; q<20; q++)
				if(document.getElementById(t+"_elementform_id_temp").getAttribute("long"+q))
				{
				
					w_long=parseFloat(document.getElementById(t+"_elementform_id_temp").getAttribute("long"+q));
					w_lat=parseFloat(document.getElementById(t+"_elementform_id_temp").getAttribute("lat"+q));
					w_info=parseFloat(document.getElementById(t+"_elementform_id_temp").getAttribute("info"+q));
					add_marker_on_map(t,q, w_long, w_lat, w_info, false);
				}
		}
		else
		if(document.getElementById(t+"_typeform_id_temp").value=="type_date")
				Calendar.setup({
						inputField: t+"_elementform_id_temp",
						ifFormat: document.getElementById(t+"_buttonform_id_temp").getAttribute('format'),
						button: t+"_buttonform_id_temp",
						align: "Tl",
						singleClick: true,
						firstDay: 0
						});

	}
	
	
	form_view=1;
	form_view_count=0;
	for(i=1; i<=30; i++)
	{
		if(document.getElementById('form_id_tempform_view'+i))
		{
			form_view_count++;
			form_view_max=i;
		}
	}
	
	if(form_view_count>1)
	{
		for(i=1; i<=form_view_max; i++)
		{
			if(document.getElementById('form_id_tempform_view'+i))
			{
				first_form_view=i;
				break;
			}
		}
		form_view=form_view_max;
		
		generate_page_nav(first_form_view);
		
	var img_EDIT = document.createElement("img");
			img_EDIT.setAttribute("src", "<?php echo plugins_url('',__FILE__) ?>/images/edit.png");
			img_EDIT.style.cssText = "margin-left:40px; cursor:pointer";
			img_EDIT.setAttribute("onclick", 'el_page_navigation()');
			
	var td_EDIT = document.getElementById("edit_page_navigation");
			td_EDIT.appendChild(img_EDIT);
	
	document.getElementById('page_navigation').appendChild(td_EDIT);

			
	}


//if(document.getElementById('take').innerHTML.indexOf('up_row(')==-1) location.reload(true);
//else 
document.getElementById('form').value=document.getElementById('take').innerHTML;
document.getElementById('araqel').value=1;

}

function formAddToOnload()
{ 
	if(formOldFunctionOnLoad){ formOldFunctionOnLoad(); }
	formOnload();
}

function formLoadBody()
{
	formOldFunctionOnLoad = window.onload;
	window.onload = formAddToOnload;
}

var formOldFunctionOnLoad = null;

formLoadBody();


</script>

    <input type="hidden" name="option" value="com_formmaker" />

    <input type="hidden" name="id" value="<?php echo $row->id?>" />

    <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />

    <input type="hidden" name="task" value="" />
    <input type="hidden" id="araqel" value="0" />

</form>

<script>
	plugin_url=document.getElementById('form_plugins_url').value;
	appWidth			=parseInt(document.body.offsetWidth);
	appHeight			=parseInt(document.body.offsetHeight);
//	document.getElementById('toolbar-popup-popup').childNodes[1].href='index.php?option=com_formmaker&task=preview&tmpl=component&theme='+document.getElementById('theme').value;
//	document.getElementById('toolbar-popup-popup').childNodes[1].setAttribute('rel',"{handler: 'iframe', size: {x:"+(appWidth-100)+", y: "+(appHeight-30)+"}}");
</script>
<?php

	

       



}























function html_Actions_after_submission($row){
		$value="";
		?>

<script language="javascript" type="text/javascript">			
function remove_article()
{
	document.getElementById('id_name').value="Select an Article";
	document.getElementById('article_id').value="";
}
function set_type(type)
{
	switch(type)
	{
		case 'post':
			document.getElementById('post').removeAttribute('style');
			document.getElementById('page').setAttribute('style','display:none');
			document.getElementById('custom').setAttribute('style','display:none');
			document.getElementById('url').setAttribute('style','display:none');
			document.getElementById('none').setAttribute('style','display:none');
			break;
			
			case 'page':
			document.getElementById('page').removeAttribute('style');
			document.getElementById('post').setAttribute('style','display:none');
			document.getElementById('custom').setAttribute('style','display:none');
			document.getElementById('url').setAttribute('style','display:none');
			document.getElementById('none').setAttribute('style','display:none');
			break;
			
		case 'custom':
			document.getElementById('page').setAttribute('style','display:none');
			document.getElementById('post').setAttribute('style','display:none');
			document.getElementById('custom').removeAttribute('style');
			document.getElementById('url').setAttribute('style','display:none');
			document.getElementById('none').setAttribute('style','display:none');
			break;
			
		case 'url':
			document.getElementById('page').setAttribute('style','display:none');
			document.getElementById('post').setAttribute('style','display:none');
			document.getElementById('custom').setAttribute('style','display:none');
			document.getElementById('url').removeAttribute('style');
			document.getElementById('none').setAttribute('style','display:none');
			break;
			
		case 'none':
			document.getElementById('page').setAttribute('style','display:none');
			document.getElementById('post').setAttribute('style','display:none');
			document.getElementById('custom').setAttribute('style','display:none');
			document.getElementById('url').setAttribute('style','display:none');
			document.getElementById('none').removeAttribute('style');
			break;
	}
}
function submit_in(pressbutton){


document.getElementById('adminForm').action=document.getElementById('adminForm').action+"&task="+pressbutton;
document.getElementById('adminForm').submit();

}
</script>

<style>
.borderer
{
border-radius:5px;
padding-left:5px;
background-color:#F0F0F0;
height:19px;
width:153px;
}
</style>
<table width="95%">
  <tbody>
    <tr>
  <td colspan="11"><div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
		<a href="http://web-dorado.com/files/fromContactForm.php" target="_blank" style="color:red; text-decoration:none;">
		<img src="<?php echo plugins_url( 'images/header.png' , __FILE__ ); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
		Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
		</a></div>
	</td>
    </tr><tr>
  <td width="100%"><h2>Actions after submission - <?php echo $row->title; ?></h2></td>
  <td align="right"><input type="button" onclick="submit_in('Save_Actions_after_submission')" value="Save" class="button-secondary action"> </td>  
  <td align="right"><input type="button" onclick="submit_in('Apply_Actions_after_submission')" value="Apply" class="button-secondary action"> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=contact_form&task=edit_form&id=<?php echo $row->id; ?>'" value="Cancel" class="button-secondary action"> </td> 
  </tr>
  </tbody></table>
  <br />
<form action="admin.php?page=contact_form&id=<?php echo $row->id; ?>" id="adminForm" method="post" name="adminForm">
    <table >
        <tr valign="top">
            <td class="key">
                <label for="submissioni text"> Action type: </label>
            </td>
			<td>
			<input type="radio" name="submit_text_type" onclick="set_type('none')"		value="1" <?php if($row->submit_text_type!=2 and $row->submit_text_type!=3 and $row->submit_text_type!=4 and $row->submit_text_type!=5 ) echo "checked" ?> /> Stay on form<br/>
			<input type="radio" name="submit_text_type" onclick="set_type('post')"  	value="2" <?php if($row->submit_text_type==2 ) echo "checked" ?> /> Post<br/>
            <input type="radio" name="submit_text_type" onclick="set_type('page')"  	value="5" <?php if($row->submit_text_type==5 ) echo "checked" ?> /> Page<br/>
			<input type="radio" name="submit_text_type" onclick="set_type('custom')" 	value="3" <?php if($row->submit_text_type==3 ) echo "checked" ?> /> Custom text<br/>
			<input type="radio" name="submit_text_type" onclick="set_type('url')" 		value="4" <?php if($row->submit_text_type==4 ) echo "checked" ?> /> URL
			</td>
        </tr>
        <tr  id="none" <?php if($row->submit_text_type==2 or $row->submit_text_type==3 or $row->submit_text_type==4 ) echo 'style="display:none"' ?> >
			<td class="key">
                <label for="submissioni text"> Stay on form </label>
			</td>
			<td >
				<img src="<?php echo plugins_url("images/tick.png",__FILE__) ?>" border="0">			
			</td>
       </tr>
       <tr id="post" <?php if($row->submit_text_type!=2) echo 'style="display:none"' ?>   >
			<td class="key">
                <label for="submissioni text"> Post </label>
			</td>
			<td >
          		  <select name="post_name" style="width:153px; font-size:11px;">
                    <option value="0">- Select Post -</option>
                    <?php  
                    // The Loop
					query_posts('');
                    while ( have_posts() ) : the_post(); ?>
                        <option value="<?php $x=get_permalink(get_the_ID()); echo  $x; ?>" <?php if($row->article_id==$x){echo '  selected="selected"';} ?>>   <?php the_title();	?>	</option>
                        <?php
                    endwhile;
                     
                    // Reset Query
                    wp_reset_query();
                     
                    ?>
                </select>
	
			</td>
        </tr>
        <tr id="page" <?php if($row->submit_text_type!=5) echo 'style="display:none"' ?>   >
			<td class="key">
                <label for="submissioni text"> Page </label>
			</td>
			<td >
          		  <select name="page_name" style="width:153px; font-size:11px;">
                    <option value="0">- Select Page -</option>
                    <?php
                     
                    // The Query
                    $pages = get_pages();
                     
                    // The Loop
                    foreach ( $pages as $page ) {?>
                        <option value="<?php $x= get_page_link( $page->ID ); echo  $x; ?>" <?php if($row->article_id==$x){echo '  selected="selected"';} ?>>   <?php echo  $page->post_title;	?>	</option>
                        <?php
					}
                     
                    // Reset Query
                    wp_reset_query();
                     
                    ?>
                </select>
	
			</td>
        </tr>

		
		
		
        <tr  <?php if($row->submit_text_type!=3 ) echo 'style="display:none"' ?>  id="custom">
           <td class="key">
                <label for="submissioni text"> Text </label>
           </td>
           <td >
				<div  style="height:300px;text-align:left" id="poststuff">
                <?php if(get_bloginfo('version')<'3.3'){ ?>
                <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea"><?php the_editor($row->submit_text,"content","title",$media_buttons = true, $tab_index = 1, $extended = true ); ?>
                <?php }else { wp_editor($row->submit_text,"content");}?>
                </div>   
                </div>    
			</td>
        </tr>
        <tr  <?php if($row->submit_text_type!=4 ) echo 'style="display:none"' ?>  id="url">
           <td class="key">
                <label for="submissioni text"> URL </label>
           </td>
           <td >
			   <input type="text" id="url" name="url" style="width:300px" value="<?php echo $row->url ?>" />
			</td>
        </tr>
    </table>
    <input type="hidden" name="option" value="com_formmaker" />
    <input type="hidden" name="id" value="<?php echo $row->id?>" />
    <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
    <input type="hidden" name="task" value="" />
</form>

<?php		


}





















function html_Edit_JavaScript($row){

?>
<script type="text/javascript" language="javascript">
function submit_in(pressbutton){


document.getElementById('adminForm').action=document.getElementById('adminForm').action+"&task="+pressbutton;
document.getElementById('adminForm').submit();

}
</script>

<table width="95%">
  <tbody>
    <tr>
  <td colspan="11"><div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
		<a href="http://web-dorado.com/files/fromContactForm.php" target="_blank" style="color:red; text-decoration:none;">
		<img src="<?php echo plugins_url( 'images/header.png' , __FILE__ ); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
		Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
		</a></div>
	</td>
    </tr><tr>
  <td width="100%"><h2>Edit JavaScript - <?php echo $row->title; ?></h2></td>
  <td align="right"><input type="button" onclick="submit_in('Save_Edit_JavaScript')" value="Save" class="button-secondary action"> </td>  
  <td align="right"><input type="button" onclick="submit_in('Apply_Edit_JavaScript')" value="Apply" class="button-secondary action"> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=contact_form&task=edit_form&id=<?php echo $row->id; ?>'" value="Cancel" class="button-secondary action"> </td> 
  </tr>
  </tbody></table>
  <br />
<form action="admin.php?page=contact_form&id=<?php echo $row->id; ?>" id="adminForm" method="post" name="adminForm">
    <table class="adminform">

        <tr>

            <th>

                <label for="message"> Javascript </label>

            </th>

        </tr>

        <tr>

            <td >

                <textarea style="margin: 0px;" cols="110" rows="25" name="javascript" id="css" ><?php echo $row->javascript; ?></textarea>

            </td>

        </tr>

    </table>
</form>
<?php 


}

















function html_Custom_text_in_email_for_administrator($row){
	
	
	
	
	
	?>
<script type="text/javascript" language="javascript">
function submit_in(pressbutton){


document.getElementById('adminForm').action=document.getElementById('adminForm').action+"&task="+pressbutton;
document.getElementById('adminForm').submit();

}
</script>

<table width="95%">
  <tbody>  <tr>
  <td colspan="11"><div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
		<a href="http://web-dorado.com/files/fromContactForm.php" target="_blank" style="color:red; text-decoration:none;">
		<img src="<?php echo plugins_url( 'images/header.png' , __FILE__ ); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
		Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
		</a></div>
	</td>
    </tr><tr>
  <td width="100%"><h2>Text for Administrator - <?php echo $row->title; ?></h2></td>
  <td align="right"><input type="button" onclick="submit_in('Save_Custom_text_in_email_for_administrator')" value="Save" class="button-secondary action"> </td>  
  <td align="right"><input type="button" onclick="submit_in('Apply_Custom_text_in_email_for_administrator')" value="Apply" class="button-secondary action"> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=contact_form&task=edit_form&id=<?php echo $row->id; ?>'" value="Cancel" class="button-secondary action"> </td> 
  </tr>
  </tbody></table>
  <br />
<form action="admin.php?page=contact_form&id=<?php echo $row->id; ?>" id="adminForm" method="post" name="adminForm">
    <table width="95%" style="border-color:#000; border:medium;" >

        <tbody>
        <tr>

            <th style="text-align:left">

                <label for="message"  style="text-align:left"> Text before Message </label>
                <br />
             </th>
            </tr>
            <tr>
            
             <td style="width:95%; min-width:500px"><?php if(function_exists('the_editor') || function_exists('wp_editor')){if(get_bloginfo('version')<'3.3'){ the_editor ( $row->script1, $idd = 'script1', $prev_id = 'Mail_script1', $media_buttons = true, $tab_index = 1, $extended = true );} else wp_editor($row->script1, $idd = 'script1') ;} else {?>
 
			<textarea style="width:100%" name="script1" id><?php echo $row->script1 ?></textarea>
			<?php } ?>
            <br />
            </td>
			</tr>
            <tr>
            <td>
             <hr />
             <h2 align="center">MESSAGE</h2>
             <hr />
             <br />
            </td>
            </tr>
             <tr>

            <th style="text-align:left">

                <label for="message"  style="text-align:left"> Text after Message </label>
                <br />
            </th>
            </tr>
                        <tr>
            
           <td style="width:70%; min-width:500px"><?php if(function_exists('the_editor') || function_exists('wp_editor')){ if(get_bloginfo('version')<'3.3' ){the_editor ( $row->script2, $idd = 'script2', $prev_id = 'Mail_title2', $media_buttons = true, $tab_index = 2, $extended = true );}else wp_editor($row->script2, $idd = 'script2');}else { ?>
			
			<textarea style="width:100%" name="script2"><?php echo $row->script2 ?></textarea>
			<?php } ?></td>
			</tr>
        </tbody>
        </table>
    
</form>
<?php
	
	
	
	
	
	
	
	
	
}











function html_Custom_text_in_email_for_user($row){
	
	
	
	
	
	?>
<script type="text/javascript" language="javascript">
function submit_in(pressbutton){


document.getElementById('adminForm').action=document.getElementById('adminForm').action+"&task="+pressbutton;
document.getElementById('adminForm').submit();

}
</script>

<table width="95%">
  <tbody>  <tr>
  <td colspan="11"><div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
		<a href="http://web-dorado.com/files/fromContactForm.php" target="_blank" style="color:red; text-decoration:none;">
		<img src="<?php echo plugins_url( 'images/header.png' , __FILE__ ); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
		Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
		</a></div>
	</td>
    </tr><tr>
  <td width="100%"><h2>Text for User - <?php echo $row->title; ?></h2></td>
  <td align="right"><input type="button" onclick="submit_in('Save_Custom_text_in_email_for_user')" value="Save" class="button-secondary action"> </td>  
  <td align="right"><input type="button" onclick="submit_in('Apply_Custom_text_in_email_for_user')" value="Apply" class="button-secondary action"> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=contact_form&task=edit_form&id=<?php echo $row->id; ?>'" value="Cancel" class="button-secondary action"> </td> 
  </tr>
  </tbody></table>
  <br />
<form action="admin.php?page=contact_form&id=<?php echo $row->id; ?>" id="adminForm" method="post" name="adminForm">
    <table width="95%" style="border-color:#000; border:medium;" >

        <tbody>
        <tr>

            <th style="text-align:left">

                <label for="message"  style="text-align:left"> Text before Message </label>
                <br />
             </th>
            </tr>
            <tr>
            
             <td style="width:95%; min-width:500px"><?php if(function_exists('wp_editor') || function_exists('the_editor')){if(get_bloginfo('version')<'3.3'){ the_editor ( $row->script_user1, $idd = 'script_user1', $prev_id = 'Mail_script1', $media_buttons = true, $tab_index = 1, $extended = true );} else wp_editor($row->script_user1, $idd = 'script_user1');} else {?>
 
			<textarea style="width:100%" name="script_user1" id><?php echo $row->script_user1 ?></textarea>
			<?php } ?>
            <br />
            </td>
			</tr>
            <tr>
            <td>
             <hr />
             <h2 align="center">MESSAGE</h2>
             <hr />
             <br />
            </td>
            </tr>
             <tr>

            <th style="text-align:left">

                <label for="message"  style="text-align:left"> Text after Message </label>
                <br />
            </th>
            </tr>
                        <tr>
            
           <td style="width:70%; min-width:500px"><?php if(function_exists('wp_editor') || function_exists('the_editor')){ if(get_bloginfo('version')<'3.3'){ the_editor ( $row->script_user2, $idd = 'script_user2', $prev_id = 'Mail_title2', $media_buttons = true, $tab_index = 2, $extended = true );} else wp_editor($row->script_user2, $idd = 'script_user2');}else { ?>
			
			<textarea style="width:100%" name="script_user2"><?php echo $row->script_user2 ?></textarea>
			<?php } ?></td>
			</tr>
        </tbody>
        </table>
    
</form>
<?php
	
	
	
	
	
	
	
	
	
}
