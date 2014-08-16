<!--
When creating a new menu item on the top-most level
Please ensure that you assign the LI a unique ID

Examples can be seen below for menu_bep_system
-->

	<div style="background-color:#EFEFEF; padding:5px;width:auto;">
<div class="banner_logo"></div><div style="margin-top:25px;">
        <a href="<?=site_url('user')?>" id="menu-input-item-for-sale-button" class="easyui-linkbutton" plain="true""><?=lang('input_item_for_sale_menu')?></a>

       
         <a href="<?=site_url('sale/user/dailysale')?>" id="menu-sns-button" class="easyui-linkbutton" plain="true" iconCls="icon-bubble"><?=lang('daily_sales')?></a>
       
        
        <a href="javascript:void(0)" id="menu-profile-button" class="easyui-menubutton" menu="#profile-menu" iconCls="icon-profile"><?=lang('profile_menu')?></a>
        
       
        
	</div>

<!-- Sub Menu of  System Menu-->
<div id="system-menu" style="width:150px">

<?php if(check('Members',NULL,FALSE)):?><div iconCls="icon-members" href="<?=site_url('auth/admin/members')?>" ><?= lang('members_menu')?></div>
<?php endif;?>

 <?php if(check('Access Control',NULL,FALSE)):?><div iconCls="icon-access" href="<?php print site_url('auth/admin/access_control')?>"><?= lang('access_control_menu')?></div><?php endif;?>

<?php if(check('Settings',NULL,FALSE)):?>

<div href="<?=site_url('admin/settings')?>"  plain="false" iconCls="icon-tools"><?=lang('setting_menu')?>

</div><?php endif;?>
</div>


<!-- Sub Menu of  Profile Menu-->
<div id="profile-menu" style="width:100px;">
<div iconCls="icon-profile_edit" href="#"><?=lang('profile_edit_menu')?></div> 
<div iconCls="icon-logout" href="#" onclick="logout()"><?=lang('logout_menu')?></div>
</div></div>



<script language="javascript">
  function logout(){
    $.messager.defaults={ok:"OK",cancel:"<?=lang('cancel')?>"};
    $.messager.confirm('<?=lang('confirm')?>', '<?=lang('logout_confirm')?>', function(r){
    if (r){
     location.href = '<?=site_url('auth/logout')?>';
    }
   });
  }
 </script>
<!--	<div id="mm1" style="width:150px;">
		<div iconCls="icon-undo">Undo</div>
		<div iconCls="icon-redo">Redo</div>
		<div class="menu-sep"></div>
		<div>Cut</div>
		<div>Copy</div>
		<div>Paste</div>
		<div class="menu-sep"></div>
		<div>
			<span>Toolbar</span>
			<div style="width:150px;">
				<div>Address</div>
				<div>Link</div>
				<div>Navigation Toolbar</div>
				<div>Bookmark Toolbar</div>
				<div class="menu-sep"></div>
				<div>New Toolbar...</div>
			</div>
		</div>
		<div iconCls="icon-remove">Delete</div>
		<div>Select All</div>
	</div>
	<div id="mm2" style="width:100px;">
		<div>Help</div>
		<div>Update</div>
		<div>About</div>
	</div>-->