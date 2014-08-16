<!--<div id="navigation">
    <?php //print $this->load->view($this->config->item('template_admin') . 'menu');?>
</div>
<div id="breadcrumb">
        <?php //print $this->bep_site->get_breadcrumb();?>
    </div>-->
    
<!--- for change password --->
<div id="usr_chpwd_win" class="easyui-window" style="width:auto;height:auto;padding:10px 20px"
     closed="true" closable="true" collapsible="false" minimizable="false" maximizable="false" buttons="#dlg-buttons" iconCls="icon-change_password" modal="true">

        <form name="user_change_password_form" id="user_change_password_form" method="post" data-ajax="true" action="<?php echo site_url('profile/user/profile/change_password_ajax')?>">
            <table width="100%" border="0"  cellspacing="20" cellpadding="0" class="list">
              <tr>
                <td width="67%" ><label><?=lang('new_password')?>: &nbsp; </label></td>
                <td width="33%">
                <input type="password" name="new_password" id="new_password" class="easyui-validatebox" style="width:200px" required="true">
                </td>
              </tr>
              <tr>
                <td width="67%" ><label><?=lang('confirm_new_password')?>: &nbsp; </label></td>
                <td width="33%">
                <input type="password" name="confirm_new_password" id="confirm_new_password" class="easyui-validatebox" style="width:200px" required="true">
                </td>
              </tr>
            </table>
        </form>

        <div id="dlg-buttons">
            <a href="#" class="easyui-linkbutton" id="change_password_btn" iconCls="icon-ok"><?= lang('save')?></a>
        </div>

</div>
<!--- end change password --->
    <?php print (isset($content)) ? $content : NULL; ?>
    <?php
    if( isset($page)){
    if( isset($module)){
            $this->load->module_view($module,$page);
        } else {
            $this->load->view($page);
        }}
    ?>
