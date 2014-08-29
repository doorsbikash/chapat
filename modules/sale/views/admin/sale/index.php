<div region="center" border="false">
	<div style="padding:20px">
		<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('sale_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
			<form action="" method="post" id="sale-search-form">
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
		<table id="sale-table" data-options="pagination:true,title:'<?php  echo lang('sale')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
			<thead>
				<th field="checkbox" checkbox="true"></th>
				<th field="bill_no" sortable="true" width="30">Bill No.</th>
				<th field="amount" sortable="true" width="50">Amount</th>
				<th field="sold_by" sortable="true" width="50">Sold By</th>
				<th field="created_date" sortable="true" width="50">Sold Date</th>

				<th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
			</thead>
		</table>

		<div id="toolbar" style="padding:5px;height:auto">
			<p>
				<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_sale')?>"><?php  echo lang('create')?></a>
				<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_sale')?>"><?php  echo lang('remove_selected')?></a>
			</p>

		</div> 

		<!--for create and edit sale form-->
		<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
		data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
		<form id="form-sale" method="post" >
			<table>
				<tr>
					<td width="34%" ><label><?=lang('sales_date')?>:</label></td>
					<td width="66%"><input name="sales_date" id="sales_date" class="easyui-datebox" required="true"></td>
				</tr>
				<tr>
					<td width="34%" ><label>Item Description:</label></td>
					<td width="66%"><input name="item_description" id="item_description" ></td>
				</tr>
				<tr>
					<td width="34%" ><label>Price:</label></td>
					<td width="66%"><input name="price" id="price" ></td>
				</tr>
				<tr>
					<td width="34%" ><label>Batch:</label></td>
					<td width="66%"><input name="batch" type="text" id="batch" ></td>
				</tr>
				<tr>
					<td width="34%" ><label>Item Code:</label></td>
					<td width="66%"><input type="text" name="item_code"  id="item_code" ></td>
				</tr>
				<tr>
					<td width="34%" ><label>MRP:</label></td>
					<td width="66%"><input name="mrp" type="text" id="mrp" ></td>
				</tr>
				<tr>
					<td width="34%" ><label>Total:</label></td>
					<td width="66%"><input name="amount" id="amount" class="" required="true"></td>
				</tr>
				<tr>
					<td width="34%" ><label><?=lang('sold_by')?>:</label></td>
					<td width="66%"><input name="sold_by" id="sold_by" class="" required="true"></td>
				</tr>
				
				<input type="hidden" name="sales_master_id" id="sales_master_id"/>
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

		$('#item_description').combobox({
			 url:'<?=site_url('sale/admin/sale/getItemDescription')?>',
			    valueField:'item_description',
			    textField:'item_description',

			    onSelect: function(rec){
			    	var batch= rec.batch,
			    		 item_code= rec.item_code,
			    		mrp= rec.mrp;

			                $('#batch').val(batch); 
			                $('#item_code').val(item_code); 
			                $('#mrp').val(mrp); 
			            }
		});

		$('#clear').click(function(){
			$('#sale-search-form').form('clear');
			$('#sale-table').datagrid({
				queryParams:null
			});

		});
		
		$('#search').click(function(){
			$('#sale-table').datagrid({
				queryParams:{data:$('#sale-search-form').serialize()}
			});
		});		
		$('#sale-table').datagrid({
			url:'<?php  echo site_url('sale/admin/sale/json')?>',
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_sale')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removesale('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_sale')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-sale').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_sale')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#sale-table').datagrid('getRows')[index];
		if (row){
			$('#form-sale').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_sale')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	

	function removesale(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#sale-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('sale/admin/sale/delete_json')?>', {id:[row.sales_master_id]}, function(){
					$('#sale-table').datagrid('deleteRow', index);
					$('#sale-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#sale-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].sales_master_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('sale/admin/sale/delete_json')?>',{id:selected},function(data){
						$('#sale-table').datagrid('reload');
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
		$('#form-sale').form('submit',{
			url: '<?php  echo site_url('sale/admin/sale/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-sale').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#sale-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close

		});		
		
	}
	
	
</script>