<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('sales_master_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="sales_master-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?=lang('sales_date')?></label>:</td>
<td><input type="text" name="date[sales_date][from]" id="search_sales_date_from"  class="easyui-datebox"/> ~ <input type="text" name="date[sales_date][to]" id="search_sales_date_to"  class="easyui-datebox"/></td>
<td><label><?=lang('amount')?></label>:</td>
<td><input type="text" name="search[amount]" id="search_amount"  class="easyui-validatebox"/></td>
</tr>
<tr>
<td><label><?=lang('sold_by')?></label>:</td>
<td><input type="text" name="search[sold_by]" id="search_sold_by"  class="easyui-validatebox"/></td>
<td><label><?=lang('created_date')?></label>:</td>
<td><input type="text" name="date[created_date][from]" id="search_created_date_from"  class="easyui-datebox"/> ~ <input type="text" name="date[created_date][to]" id="search_created_date_to"  class="easyui-datebox"/></td>
</tr>
<tr>
<td><label><?=lang('created_by')?></label>:</td>
<td><input type="text" name="search[created_by]" id="search_created_by"  class="easyui-numberbox"/></td>
<td><label><?=lang('delete_flag')?></label>:</td>
<td><input type="radio" name="search[delete_flag]" id="search_delete_flag1" value="1"/><?=lang('general_yes')?>
								<input type="radio" name="search[delete_flag]" id="search_delete_flag0" value="0"/><?=lang('general_no')?></td>
</tr>
<tr>
<td><label><?=lang('modified_datetime')?></label>:</td>
<td><input type="text" name="date[modified_datetime][from]" id="search_modified_datetime_from"  class="easyui-datebox"/> ~ <input type="text" name="date[modified_datetime][to]" id="search_modified_datetime_to"  class="easyui-datebox"/></td>
</tr>
  <tr>
    <td colspan="4">
    <a href="#" class="easyui-linkbutton" id="search" iconCls="icon-search"><?php  echo lang('search')?></a>  
    <a href="#" class="easyui-linkbutton" id="clear" iconCls="icon-clear"><?php  echo lang('clear')?></a>
    </td>
    </tr>
</table>

</form>
</div>
<br/>
<table id="sales_master-table" data-options="pagination:true,title:'<?php  echo lang('sales_master')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th field="checkbox" checkbox="true"></th>
    <th field="sales_master_id" sortable="true" width="30"><?=lang('sales_master_id')?></th>
<th field="sales_date" sortable="true" width="50"><?=lang('sales_date')?></th>
<th field="amount" sortable="true" width="50"><?=lang('amount')?></th>
<th field="sold_by" sortable="true" width="50"><?=lang('sold_by')?></th>
<th field="created_date" sortable="true" width="50"><?=lang('created_date')?></th>
<th field="created_by" sortable="true" width="50"><?=lang('created_by')?></th>
<th field="delete_flag" sortable="true" width="50"><?=lang('delete_flag')?></th>
<th field="modified_datetime" sortable="true" width="50"><?=lang('modified_datetime')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_sales_master')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_sales_master')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit sales_master form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-sales_master" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?=lang('sales_date')?>:</label></td>
					  <td width="66%"><input name="sales_date" id="sales_date" class="easyui-datebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('amount')?>:</label></td>
					  <td width="66%"><input name="amount" id="amount" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('sold_by')?>:</label></td>
					  <td width="66%"><input name="sold_by" id="sold_by" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('created_date')?>:</label></td>
					  <td width="66%"><input name="created_date" id="created_date" class="easyui-datetimebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('created_by')?>:</label></td>
					  <td width="66%"><input name="created_by" id="created_by" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('delete_flag')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="delete_flag" id="delete_flag1" /><?=lang("general_yes")?> <input type="radio" value="0" name="delete_flag" id="delete_flag0" /><?=lang("general_no")?></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('modified_datetime')?>:</label></td>
					  <td width="66%"><input name="modified_datetime" id="modified_datetime" class="easyui-datetimebox" required="true"></td>
		       </tr><input type="hidden" name="sales_master_id" id="sales_master_id"/>
    </table>
    </form>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="save()"><?php  echo  lang('general_save')?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg').window('close')"><?php  echo  lang('general_cancel')?></a>
	</div>    
</div>
<!--div ends-->
   
</div>
</div>
<script language="javascript" type="text/javascript">
	$(function(){
		$('#clear').click(function(){
			$('#sales_master-search-form').form('clear');
			$('#sales_master-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#sales_master-table').datagrid({
				queryParams:{data:$('#sales_master-search-form').serialize()}
				});
		});		
		$('#sales_master-table').datagrid({
			url:'<?php  echo site_url('sales_master/admin/sales_master/json')?>',
			height:'auto',
			width:'auto',
			onDblClickRow:function(index,row)
			{
				edit(index);
			}
		});
	});
	
	function getActions(value,row,index)
	{
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_sales_master')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removesales_master('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_sales_master')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
		return e+d;		
	}
	
	function formatStatus(value)
	{
		if(value==1)
		{
			return 'Yes';
		}
		return 'No';
	}

	function create(){
		//Create code here
		$('#form-sales_master').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_sales_master')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#sales_master-table').datagrid('getRows')[index];
		if (row){
			$('#form-sales_master').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_sales_master')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removesales_master(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#sales_master-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('sales_master/admin/sales_master/delete_json')?>', {id:[row.sales_master_id]}, function(){
					$('#sales_master-table').datagrid('deleteRow', index);
					$('#sales_master-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#sales_master-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].sales_master_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('sales_master/admin/sales_master/delete_json')?>',{id:selected},function(data){
						$('#sales_master-table').datagrid('reload');
					});
				}
				
			});
			
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');	
		}
		
	}
	
	function save()
	{
		$('#form-sales_master').form('submit',{
			url: '<?php  echo site_url('sales_master/admin/sales_master/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-sales_master').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#sales_master-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	
</script>