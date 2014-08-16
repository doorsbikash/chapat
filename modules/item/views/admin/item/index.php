<div region="center" border="false">
	<div style="padding:20px">
		<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('item_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
			<form action="" method="post" id="item-search-form">
				<table width="100%" border="1" cellspacing="1" cellpadding="1">
					<tr><td><label><?=lang('item_code')?></label>:</td>
						<td><input type="text" name="search[item_code]" id="search_item_code"  class="easyui-validatebox"/></td>
						<td><label><?=lang('item_description')?></label>:</td>
						<td><input type="text" name="search[item_description]" id="search_item_description"  class="easyui-validatebox"/></td>
					</tr>
					<tr>
						<td><label><?=lang('manufacture_id')?></label>:</td>
						<td><input type="text" name="search[manufacture_id]" id="search_manufacture_id"  class="easyui-numberbox"/></td>
						<td><label><?=lang('supplier_id')?></label>:</td>
						<td><input type="text" name="search[supplier_id]" id="search_supplier_id"  class="easyui-numberbox"/></td>
					</tr>
					<tr>
						<td><label><?=lang('pack_id')?></label>:</td>
						<td><input type="text" name="search[pack_id]" id="search_pack_id"  class="easyui-numberbox"/></td>
						<td><label><?=lang('manufactured_date')?></label>:</td>
						<td><input type="text" name="date[manufactured_date][from]" id="search_manufactured_date_from"  class="easyui-datebox"/> ~ <input type="text" name="date[manufactured_date][to]" id="search_manufactured_date_to"  class="easyui-datebox"/></td>
					</tr>
					<tr>
						<td><label><?=lang('expiry_date')?></label>:</td>
						<td><input type="text" name="date[expiry_date][from]" id="search_expiry_date_from"  class="easyui-datebox"/> ~ <input type="text" name="date[expiry_date][to]" id="search_expiry_date_to"  class="easyui-datebox"/></td>
						<td><label><?=lang('quantity')?></label>:</td>
						<td><input type="text" name="search[quantity]" id="search_quantity"  class="easyui-numberbox"/></td>
					</tr>
					<tr>
						<td><label><?=lang('cost_price')?></label>:</td>
						<td><input type="text" name="search[cost_price]" id="search_cost_price"  class="easyui-validatebox"/></td>
						<td><label><?=lang('sell_price')?></label>:</td>
						<td><input type="text" name="search[sell_price]" id="search_sell_price"  class="easyui-validatebox"/></td>
					</tr>
					<tr>
						<td><label><?=lang('currency')?></label>:</td>
						<td><input type="text" name="search[currency]" id="search_currency"  class="easyui-validatebox"/></td>
						<td><label><?=lang('remarks')?></label>:</td>
						<td><input type="text" name="search[remarks]" id="search_remarks"  class="easyui-validatebox"/></td>
					</tr>
					<tr>
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
		<table id="item-table" data-options="pagination:true,title:'<?php  echo lang('item')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
			<thead>
				<th field="checkbox" checkbox="true"></th>
				<th field="item_code" sortable="true" width="50"><?=lang('item_code')?></th>
				<th field="item_description" sortable="true" width="50"><?=lang('item_description')?></th>
				<th field="pack_id" sortable="true" width="50"><?=lang('pack_id')?></th>
				<th field="remarks" sortable="true" width="50"><?=lang('remarks')?></th>

				<th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
			</thead>
		</table>

		<div id="toolbar" style="padding:5px;height:auto">
			<p>
				<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_item')?>"><?php  echo lang('create')?></a>
				<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_item')?>"><?php  echo lang('remove_selected')?></a>
			</p>

		</div> 

		<!--for create and edit item form-->
		<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
		data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
		<form id="form-item" method="post" >
			<table>
				<tr>
					<td width="34%" ><label><?=lang('item_code')?>:</label></td>
					<td width="66%"><input name="item_code" id="item_code" class="easyui-validatebox" required="true"></td>
				</tr>
				<tr>
					<td width="34%" ><label><?=lang('item_description')?>:</label></td>
					<td width="66%"><input name="item_description" id="item_description" class="easyui-validatebox" required="true"></td>
				</tr>
				<tr>
					<td width="34%" ><label><?=lang('pack_id')?>:</label></td>
					<td width="66%"><input name="pack_id" id="pack_id" class="easyui-numberbox" required="true"></td>
				</tr>
				<tr>
					<td width="34%" ><label><?=lang('remarks')?>:</label></td>
					<td width="66%"><input name="remarks" id="remarks" ></td>
				</tr>
				<input type="hidden" name="item_id" id="item_id"/>
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
		$('#item-search-form').form('clear');
		$('#item-table').datagrid({
			queryParams:null
		});

	});

	$('#search').click(function(){
		$('#item-table').datagrid({
			queryParams:{data:$('#item-search-form').serialize()}
		});
	});		
	$('#item-table').datagrid({
		url:'<?php  echo site_url('item/admin/item/json')?>',
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
	var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_item')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
	var d = '<a href="#" onclick="removeitem('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_item')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-item').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_item')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#item-table').datagrid('getRows')[index];
		if (row){
			$('#form-item').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_item')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	

	function removeitem(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#item-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('item/admin/item/delete_json')?>', {id:[row.item_id]}, function(){
					$('#item-table').datagrid('deleteRow', index);
					$('#item-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#item-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].item_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('item/admin/item/delete_json')?>',{id:selected},function(data){
						$('#item-table').datagrid('reload');
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
		$('#form-item').form('submit',{
			url: '<?php  echo site_url('item/admin/item/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-item').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#item-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close

		});		
		
	}
	
	
	</script>