<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('pack_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="pack-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?=lang('pack_description')?></label>:</td>
<td><input type="text" name="search[pack_description]" id="search_pack_description"  class="easyui-validatebox"/></td>
<td><label><?=lang('created_datetime')?></label>:</td>
<td><input type="text" name="search[created_datetime]" id="search_created_datetime"  class="easyui-datebox"/></td>
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
<table id="pack-table" data-options="pagination:true,title:'<?php  echo lang('pack')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th field="checkbox" checkbox="true"></th>
<th field="pack_description" sortable="true" width="50"><?=lang('pack_description')?></th>
<th field="created_datetime" sortable="true" width="50"><?=lang('created_datetime')?></th>


    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_pack')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_pack')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit pack form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-pack" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?=lang('pack_description')?>:</label></td>
					  <td width="66%"><input name="pack_description" id="pack_description" class="easyui-validatebox" required="true"></td>
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
			$('#pack-search-form').form('clear');
			$('#pack-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#pack-table').datagrid({
				queryParams:{data:$('#pack-search-form').serialize()}
				});
		});		
		$('#pack-table').datagrid({
			url:'<?php  echo site_url('pack/admin/pack/json')?>',
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_pack')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removepack('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_pack')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-pack').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_pack')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#pack-table').datagrid('getRows')[index];
		if (row){
			$('#form-pack').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_pack')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removepack(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#pack-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('pack/admin/pack/delete_json')?>', {id:[row.id]}, function(){
					$('#pack-table').datagrid('deleteRow', index);
					$('#pack-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#pack-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('pack/admin/pack/delete_json')?>',{id:selected},function(data){
						$('#pack-table').datagrid('reload');
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
		$('#form-pack').form('submit',{
			url: '<?php  echo site_url('pack/admin/pack/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-pack').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#pack-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	
</script>