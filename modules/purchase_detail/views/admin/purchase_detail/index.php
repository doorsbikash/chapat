<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('purchase_detail_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="purchase_detail-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?=lang('purchase_master_id')?></label>:</td>
<td><input type="text" name="search[purchase_master_id]" id="search_purchase_master_id"  class="easyui-numberbox"/></td>
<td><label><?=lang('item_code')?></label>:</td>
<td><input type="text" name="search[item_code]" id="search_item_code"  class="easyui-validatebox"/></td>
</tr>
<tr>
<td><label><?=lang('item_description')?></label>:</td>
<td><input type="text" name="search[item_description]" id="search_item_description"  class="easyui-validatebox"/></td>
<td><label><?=lang('pack')?></label>:</td>
<td><input type="text" name="search[pack]" id="search_pack"  class="easyui-numberbox"/></td>
</tr>
<tr>
<td><label><?=lang('batch')?></label>:</td>
<td><input type="text" name="search[batch]" id="search_batch"  class="easyui-validatebox"/></td>
<td><label><?=lang('expiry_date')?></label>:</td>
<td><input type="text" name="date[expiry_date][from]" id="search_expiry_date_from"  class="easyui-datebox"/> ~ <input type="text" name="date[expiry_date][to]" id="search_expiry_date_to"  class="easyui-datebox"/></td>
</tr>
<tr>
<td><label><?=lang('quantity')?></label>:</td>
<td><input type="text" name="search[quantity]" id="search_quantity"  class="easyui-numberbox"/></td>
<td><label><?=lang('cc_rate')?></label>:</td>
<td><input type="text" name="search[cc_rate]" id="search_cc_rate"  class="easyui-validatebox"/></td>
</tr>
<tr>
<td><label><?=lang('amount')?></label>:</td>
<td><input type="text" name="search[amount]" id="search_amount"  class="easyui-validatebox"/></td>
<td><label><?=lang('mrp')?></label>:</td>
<td><input type="text" name="search[mrp]" id="search_mrp"  class="easyui-validatebox"/></td>
</tr>
<tr>
<td><label><?=lang('modified_date')?></label>:</td>
<td><input type="text" name="date[modified_date][from]" id="search_modified_date_from"  class="easyui-datebox"/> ~ <input type="text" name="date[modified_date][to]" id="search_modified_date_to"  class="easyui-datebox"/></td>
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
<table id="purchase_detail-table" data-options="pagination:true,title:'<?php  echo lang('purchase_detail')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th field="checkbox" checkbox="true"></th>
    <th field="purchase_detail_id" sortable="true" width="30"><?=lang('purchase_detail_id')?></th>
<th field="purchase_master_id" sortable="true" width="50"><?=lang('purchase_master_id')?></th>
<th field="item_code" sortable="true" width="50"><?=lang('item_code')?></th>
<th field="item_description" sortable="true" width="50"><?=lang('item_description')?></th>
<th field="pack" sortable="true" width="50"><?=lang('pack')?></th>
<th field="batch" sortable="true" width="50"><?=lang('batch')?></th>
<th field="expiry_date" sortable="true" width="50"><?=lang('expiry_date')?></th>
<th field="quantity" sortable="true" width="50"><?=lang('quantity')?></th>
<th field="cc_rate" sortable="true" width="50"><?=lang('cc_rate')?></th>
<th field="amount" sortable="true" width="50"><?=lang('amount')?></th>
<th field="mrp" sortable="true" width="50"><?=lang('mrp')?></th>
<th field="modified_date" sortable="true" width="50"><?=lang('modified_date')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_purchase_detail')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_purchase_detail')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit purchase_detail form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-purchase_detail" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?=lang('purchase_master_id')?>:</label></td>
					  <td width="66%"><input name="purchase_master_id" id="purchase_master_id" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('item_code')?>:</label></td>
					  <td width="66%"><input name="item_code" id="item_code" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('item_description')?>:</label></td>
					  <td width="66%"><input name="item_description" id="item_description" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('pack')?>:</label></td>
					  <td width="66%"><input name="pack" id="pack" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('batch')?>:</label></td>
					  <td width="66%"><input name="batch" id="batch" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('expiry_date')?>:</label></td>
					  <td width="66%"><input name="expiry_date" id="expiry_date" class="easyui-datebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('quantity')?>:</label></td>
					  <td width="66%"><input name="quantity" id="quantity" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('cc_rate')?>:</label></td>
					  <td width="66%"><input name="cc_rate" id="cc_rate" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('amount')?>:</label></td>
					  <td width="66%"><input name="amount" id="amount" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('mrp')?>:</label></td>
					  <td width="66%"><input name="mrp" id="mrp" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('modified_date')?>:</label></td>
					  <td width="66%"><input name="modified_date" id="modified_date" class="easyui-datetimebox" required="true"></td>
		       </tr><input type="hidden" name="purchase_detail_id" id="purchase_detail_id"/>
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
			$('#purchase_detail-search-form').form('clear');
			$('#purchase_detail-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#purchase_detail-table').datagrid({
				queryParams:{data:$('#purchase_detail-search-form').serialize()}
				});
		});		
		$('#purchase_detail-table').datagrid({
			url:'<?php  echo site_url('purchase_detail/admin/purchase_detail/json')?>',
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_purchase_detail')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removepurchase_detail('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_purchase_detail')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-purchase_detail').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_purchase_detail')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#purchase_detail-table').datagrid('getRows')[index];
		if (row){
			$('#form-purchase_detail').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_purchase_detail')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removepurchase_detail(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#purchase_detail-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('purchase_detail/admin/purchase_detail/delete_json')?>', {id:[row.purchase_detail_id]}, function(){
					$('#purchase_detail-table').datagrid('deleteRow', index);
					$('#purchase_detail-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#purchase_detail-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].purchase_detail_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('purchase_detail/admin/purchase_detail/delete_json')?>',{id:selected},function(data){
						$('#purchase_detail-table').datagrid('reload');
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
		$('#form-purchase_detail').form('submit',{
			url: '<?php  echo site_url('purchase_detail/admin/purchase_detail/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-purchase_detail').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#purchase_detail-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	
</script>