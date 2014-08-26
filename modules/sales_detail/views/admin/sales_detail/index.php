<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('sales_detail_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="sales_detail-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?=lang('sales_master_id')?></label>:</td>
<td><input type="text" name="search[sales_master_id]" id="search_sales_master_id"  class="easyui-numberbox"/></td>
<td><label><?=lang('item_id')?></label>:</td>
<td><input type="text" name="search[item_id]" id="search_item_id"  class="easyui-numberbox"/></td>
</tr>
<tr>
<td><label><?=lang('price')?></label>:</td>
<td><input type="text" name="search[price]" id="search_price"  class="easyui-validatebox"/></td>
<td><label><?=lang('quantity')?></label>:</td>
<td><input type="text" name="search[quantity]" id="search_quantity"  class="easyui-numberbox"/></td>
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
<table id="sales_detail-table" data-options="pagination:true,title:'<?php  echo lang('sales_detail')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th field="checkbox" checkbox="true"></th>
    <th field="sales_detail_id" sortable="true" width="30"><?=lang('sales_detail_id')?></th>
<th field="sales_master_id" sortable="true" width="50"><?=lang('sales_master_id')?></th>
<th field="item_id" sortable="true" width="50"><?=lang('item_id')?></th>
<th field="price" sortable="true" width="50"><?=lang('price')?></th>
<th field="quantity" sortable="true" width="50"><?=lang('quantity')?></th>
<th field="modified_datetime" sortable="true" width="50"><?=lang('modified_datetime')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_sales_detail')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_sales_detail')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit sales_detail form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-sales_detail" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?=lang('sales_master_id')?>:</label></td>
					  <td width="66%"><input name="sales_master_id" id="sales_master_id" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('item_id')?>:</label></td>
					  <td width="66%"><input name="item_id" id="item_id" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('price')?>:</label></td>
					  <td width="66%"><input name="price" id="price" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('quantity')?>:</label></td>
					  <td width="66%"><input name="quantity" id="quantity" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('modified_datetime')?>:</label></td>
					  <td width="66%"><input name="modified_datetime" id="modified_datetime" class="easyui-datetimebox" required="true"></td>
		       </tr><input type="hidden" name="sales_detail_id" id="sales_detail_id"/>
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
			$('#sales_detail-search-form').form('clear');
			$('#sales_detail-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#sales_detail-table').datagrid({
				queryParams:{data:$('#sales_detail-search-form').serialize()}
				});
		});		
		$('#sales_detail-table').datagrid({
			url:'<?php  echo site_url('sales_detail/admin/sales_detail/json')?>',
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_sales_detail')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removesales_detail('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_sales_detail')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-sales_detail').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_sales_detail')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#sales_detail-table').datagrid('getRows')[index];
		if (row){
			$('#form-sales_detail').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_sales_detail')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removesales_detail(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#sales_detail-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('sales_detail/admin/sales_detail/delete_json')?>', {id:[row.sales_detail_id]}, function(){
					$('#sales_detail-table').datagrid('deleteRow', index);
					$('#sales_detail-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#sales_detail-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].sales_detail_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('sales_detail/admin/sales_detail/delete_json')?>',{id:selected},function(data){
						$('#sales_detail-table').datagrid('reload');
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
		$('#form-sales_detail').form('submit',{
			url: '<?php  echo site_url('sales_detail/admin/sales_detail/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-sales_detail').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#sales_detail-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	
</script>