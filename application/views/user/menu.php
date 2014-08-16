<!--
When creating a new menu item on the top-most level
Please ensure that you assign the LI a unique ID

Examples can be seen below for menu_bep_system
-->

<div id="bar" >

<div class="banner_logo"></div><div style="margin-top:2px;">
	<a href="<?=site_url('product/user/product')?>" id="menu-product-list-button" class="easyui-linkbutton" plain="true" iconCls="icon-product-list"><?=lang('product_list_menu')?></a>
	<a menu="#sales-menu" href="javascript:void(0)" id="menu-input-item-for-sale-button" class="easyui-menubutton" iconCls="icon-daily-sales"><?=lang('shop_sales_management')?></a>
	<a href="<?=site_url('supply/user/arrival')?>" id="menu-goods-arrival-button" iconCls="icon-supply" class="easyui-linkbutton" plain="true" ><?=lang('goods_arrival_confirmation_menu')?></a>
	<a href="<?=site_url('sale/user/dailysale')?>" id="menu-daily-sales-button" class="easyui-linkbutton" plain="true" iconCls="icon-daily-sales" ><?=lang('daily_sales_menu')?></a>
	<?php /*<a href="<?=site_url('sns/user/sns')?>" id="menu-sns-button" class="easyui-linkbutton" plain="true" iconCls="icon-bubble"><?=lang('sns_menu')?></a>
	<a href="javascript:void(0)" id="menu-profile-button" class="easyui-menubutton" menu="#profile-menu" iconCls="icon-profile"><?=lang('profile_menu')?></a>*/?>
	<a href="javascript:void(0)" id="menu-sales-button" class="easyui-linkbutton" plain="true" iconCls="icon-logout" onclick="logout()"><?=lang('logout_menu')?></a>

    <a style="float:right" href="<?=site_url('profile/user/profile/change_password')?>" id="menu-user-changepassword" class="easyui-linkbutton" plain="true" iconCls="icon-pwd"><?=lang('change_password')?></a>
    
    <span style="float:right; font-weight:bold; line-height:28px; margin-right:10px;"><a menu="#user-menu" href="javascript:void(0)" class="easyui-menubutton"><?php if(is_user()) echo $this->session->userdata('shop_name')."&nbsp;&nbsp;".$this->session->userdata('name');?></a></span>
    </div>
</div>

<div id="user-menu" style="width:200px;">
	<div href="<?=site_url('profile/user/profile')?>" id="menu-user-profile" iconCls="icon-profile"><?=lang('profile')?></div>
</div>

<div id="sales-menu" style="width:200px;">
	<div href="<?=site_url('sale/user/saleproduct')?>" iconCls="icon-daily-sales"><?=lang('input_item_for_sale_menu')?></div>
	<div href="<?=site_url('sale/user/saleproduct/shopsales')?>" iconCls="icon-daily-sales"><?=lang('shop_sales_return')?></div>
</div>

<script language="javascript">
$(document).ready(function() {
    $('#menu-user-changepassword').click(function(e) {
        e.preventDefault();
        $('#usr_chpwd_win').dialog('open').dialog('setTitle','<?=lang('change_password')?>');
        $('#user_change_password_form').form('clear');
    });
});
  function logout(){
    $.messager.defaults={ok:"OK",cancel:"<?=lang('cancel')?>"};
    $.messager.confirm('<?=lang('confirm')?>', '<?=lang('logout_confirm')?>', function(r){
    if (r){
     location.href = '<?=site_url('auth/logout')?>';
    }
   });
  }
</script>
