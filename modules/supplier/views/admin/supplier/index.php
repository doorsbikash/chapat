<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('supplier_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="supplier-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?=lang('supplier_name')?></label>:</td>
<td><input type="text" name="search[supplier_name]" id="search_supplier_name"  class="easyui-validatebox"/></td>
<td><label><?=lang('address')?></label>:</td>
<td><input type="text" name="search[address]" id="search_address"  class="easyui-validatebox"/></td>
</tr>
<tr>
<td><label><?=lang('contactno')?></label>:</td>
<td><input type="text" name="search[contactno]" id="search_contactno"  class="easyui-validatebox"/></td>
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
<table id="supplier-table" data-options="pagination:true,title:'<?php  echo lang('supplier')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th field="checkbox" checkbox="true"></th>
    <th field="supplier_name" sortable="true" width="50"><?=lang('supplier_name')?></th>
<th field="address" sortable="true" width="50"><?=lang('address')?></th>
<th field="contactno" sortable="true" width="50"><?=lang('contactno')?></th>


    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_supplier')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_supplier')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit supplier form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-supplier" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?=lang('supplier_name')?>:</label></td>
					  <td width="66%"><input name="supplier_name" id="supplier_name" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('address')?>:</label></td>
					  <td width="66%"><input name="address" id="address"  ></td>
		       </tr><tr>
		              <td width="34%" ><label><?=lang('contactno')?>:</label></td>
					  <td width="66%"><input name="contactno" id="contactno"  ></td>
		       </tr><input type="hidden" name="id" id="id"/>
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
			$('#supplier-search-form').form('clear');
			$('#supplier-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#supplier-table').datagrid({
				queryParams:{data:$('#supplier-search-form').serialize()}
				});
		});		
		$('#supplier-table').datagrid({
			url:'<?php  echo site_url('supplier/admin/supplier/json')?>',
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_supplier')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removesupplier('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_supplier')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-supplier').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_supplier')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#supplier-table').datagrid('getRows')[index];
		if (row){
			$('#form-supplier').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_supplier')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removesupplier(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#supplier-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('supplier/admin/supplier/delete_json')?>', {id:[row.id]}, function(){
					$('#supplier-table').datagrid('deleteRow', index);
					$('#supplier-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#supplier-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('supplier/admin/supplier/delete_json')?>',{id:selected},function(data){
						$('#supplier-table').datagrid('reload');
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
		$('#form-supplier').form('submit',{
			url: '<?php  echo site_url('supplier/admin/supplier/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-supplier').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#supplier-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	
</script>