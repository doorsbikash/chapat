<!-- Child datagrid detail view js call starts -->
	<script type="text/javascript">
		$(function(){
			$('#purchaseDatagrid').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';
				},
				onExpandRow: function(index,row){
						$('#ddv-'+index).datagrid({
						url:'<?=site_url('purchase/admin/purchase/getPurchaseDetailjson')?>?purchase_master_id='+row.purchase_master_id,
						fitColumns:true,
						singleSelect:true,
						rownumbers:true,
						loadMsg:'',
						height:'auto',
						columns:[[
						{field:'item_code',title:'Code',width:90},
						{field:'item_description',title:'Item Description',width:200,align:'right'},
						{field:'pack',title:'Pack',width:80,align:'right',
							formatter: function(value,row,index){
								return row.pack_description;
							},
							editor:{
								type:'combobox',
								options:{
									valueField:'id',
			                        textField:'pack_description',
			                        url:'<?=site_url("purchase/admin/pack/json") ?>'
								}
							}
						},		
						{field:'batch',title:'Batch',width:100,align:'right'},
						{field:'expiry_date',title:'Exp.Date',width:100,align:'right'},
						{field:'quantity',title:'QTY',width:80,align:'right'},
						{field:'cc_rate',title:'CC/Rate',width:100,align:'right'},
						{field:'amount',title:'Amount',width:100,align:'right'},
						{field:'mrp',title:'M.R.P',width:100,align:'right'}
						]],

						onResize:function(){
							$('#purchaseDatagrid').datagrid('fixDetailRowHeight',index);
						},
						onLoadSuccess:function(){
							setTimeout(function(){
								$('#purchaseDatagrid').datagrid('fixDetailRowHeight',index);
							},0);
						}
					});
					$('#purchaseDatagrid').datagrid('fixDetailRowHeight',index);
				}
			});
		});
	</script>
<!-- ends script ends  -->
<!-- Main purchase view datagrid -->
	<div region="center" border="false">
		<div style="padding:20px">
			<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('purchase_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
				<form action="" method="post" id="purchase-search-form">
					<table width="100%" border="1" cellspacing="1" cellpadding="1">
						<tr><td><label><?=lang('invoice_no')?></label>:</td>
							<td><input type="text" name="search[invoice_no]" id="search_invoice_no"  class="easyui-validatebox"/></td>
							<td><label><?=lang('total')?></label>:</td>
							<td><input type="text" name="search[total]" id="search_total"  class="easyui-validatebox"/></td>
						</tr>
						<tr>
							<td><label><?=lang('less_discount')?></label>:</td>
							<td><input type="text" name="search[less_discount]" id="search_less_discount"  class="easyui-validatebox"/></td>
							<td><label><?=lang('net_total')?></label>:</td>
							<td><input type="text" name="search[net_total]" id="search_net_total"  class="easyui-validatebox"/></td>
						</tr>
						<tr>
							<td><label><?=lang('received_by')?></label>:</td>
							<td><input type="text" name="search[received_by]" id="search_received_by"  class="easyui-validatebox"/></td>
							<td><label><?=lang('supplier_id')?></label>:</td>
							<td><input type="text" name="search[supplier_id]" id="search_supplier_id"  class="easyui-numberbox"/></td>
						</tr>
						

						<tr>
							<td><label><?=lang('memo_type')?></label>:</td>
							<td><input type="text" name="search[memo_type]" id="search_memo_type"  class="easyui-validatebox"/></td>
							<td><label><?=lang('purchase_datetime')?></label>:</td>
							<td><input type="text" name="date[created_datetime][from]" id="search_created_datetime_from"  class="easyui-datebox"/> ~ <input type="text" name="date[created_datetime][to]" id="search_created_datetime_to"  class="easyui-datebox"/></td>
							<td><label><?=lang('pack')?></label>:</td>
							<td><input type="text" name="search[pack]" id="search_pack"  class="easyui-validatebox"/></td>

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

			<table id="purchaseDatagrid" class="easyui-datagrid" style="width:auto;height:250px" url="<?=site_url('purchase/admin/purchase/json')?>" title="Purchase"data-options="iconCls: 'icon-edit',singleSelect: true,method:'get',toolbar:'#toolbar'">

				<thead>
					<tr>
						<th data-options="field:'supplier_id',width:150,editor:'text'">Suplier</th>
						<th data-options="field:'purchase_master_id',width:80,editor:'text'" >Purchase Id</th>
						<th data-options="field:'invoice_no',width:100,editor:'text'">Invoice No</th>
						<th data-options="field:'net_total',width:100,align:'right',editor:'text'" >Total</th>
						<th data-options="field:'memo_type',align:'right',width:100,editor:'text'" >Memo Type</th>
						<th data-options="field:'created_datetime',align:'right',width:120,editor:'text'" >Purchase Date</th>
						<th field="action" formatter="getActions"><?php  echo lang('action')?></th>
					</tr>
				</thead>
			</table>

		</div>
	</div>
<!-- ends Main purchase view datagrid ends  -->
<!-- tool bar for purchase datagrid -->
	<div id="toolbar" style="padding:5px;height:auto">
		<p>
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_purchase')?>"><?php  echo lang('create')?></a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_purchase')?>"><?php  echo lang('remove_selected')?></a>
		</p>

	</div> 
<!--ends Toolbar for data ends -->
<!-- create and edit purchase form with datagrid-->
<div id="dlg-form" class="easyui-dialog" style="width:500px;min-height:180px;height:auto;padding:10px 20px"
		data-options="closed:true,collapsible:true,buttons:'#dlg-from-buttons',modal:true">
	<form id="form-purchase" method="post" >
	<table>
					<tr>
						<td width="34%" ><label><?=lang('supplier_id')?>:</label>
							<input name="supplier_id" id="supplier_id" class="easyui-validatebox">
						</td>
						
						<td width="34%" ><label><?=lang('invoice_no')?>:</label>
							<input name="invoice_no" id="invoice_no" class="easyui-validatebox" required="true">
					<tr>
						<td width="34%" ><label><?=lang('purchase_datetime')?>:</label>
						<input name="purchase_datetime" id="purchase_datetime" class="easyui-datebox"></td>
						<td width="34%" ><label><?=lang('memo_type')?>:</label>
						<input name="memo_type" id="memo_type" ></td>
					</tr>
				</table>
				<input type="hidden" name="purchase_master_id" id="purchase_master_id"/>
				<div id="dlg-from-buttons">
			<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="save()"><?php  echo  lang('general_save')?></a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg-form').window('close')"><?php  echo  lang('general_cancel')?></a>
		</div>
	
</form>
</div>	
	<div id="dlg-purchaseDetail" class="easyui-dialog"  style="width:730px;min-height:180px;height:auto;padding:0px"
		data-options="closed:true,collapsible:true,modal:true">
		<table id="dg" title="Add/Edit Purchse" style="width:auto;height:250px"
		toolbar="#toolbar_dlg" pagination="true" idField="purchase_detail_id"
		rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="item_code" width="50" editor="{type:'validatebox',options:{required:true}}">CODE</th>
				<th field="item_description" width="200" editor="{type:'validatebox',options:{required:true}}">ITEM DESCRIPTION</th>
				<th field="pack" width="50" editor="text">PACK</th>
				<th field="batch" width="50" editor="text">BATCH</th>
				<th field="expiry_date" width="50" editor="text">EXP.DATE</th>
				<th field="quantity" width="50" editor="text">QTY</th>
				<th field="cc_rate" width="50" editor="text">CC/RATE</th>
				<th field="amount" width="50" editor="numberbox">AMOUNT</th>
				<th field="mrp" width="50" editor="text">MRP</th>
			</tr>
		</thead>
	</table>
	</div>
	<div id="toolbar_dlg">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>

	
<!-- ends create form with grid -->

<script type="text/javascript">
	$('#clear').click(function(){
		$('#purchase-search-form').form('clear');
		$('#purchaseDatagrid').datagrid({
			queryParams:null
		});

	});

	
	$('#search').click(function(){
		$('#purchaseDatagrid').datagrid({
			queryParams:{data:$('#purchase-search-form').serialize()}
		});
	});	
	function getActions(value,row,index)
	{
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_purchase')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removepurchase('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('remove-purchase')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
		var f = '<a href="#" onclick="showinvoicedetail('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-view"  title="View Invoice Detail"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-view"></span></span></a>';
		return e+d+f;		
	}

	function removepurchase(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#purchaseDatagrid').datagrid('getRows')[index];
				$.post('<?php  echo site_url('purchase/admin/purchase/delete_json')?>', {id:[row.purchase_master_id]}, function(){
					$('#purchaseDatagrid').datagrid('deleteRow', index);
					$('#purchaseDatagrid').datagrid('reload');
				});

			}
		});
	}

	function create(){
		//Create code here
		$('#form-purchase').form('clear');
		$('#dlg-form').window('open').window('setTitle','<?php  echo lang('create_purchase')?>');
	}	

	function edit(index)
	{
		var row = $('#purchaseDatagrid').datagrid('getRows')[index];
		if (row){
			$('#form-purchase').form('clear');
			$('#dlg-form').window('close');	
			purchaseDetaildg(row);		}
			else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		function save()
		{
			$('#form-purchase').form('submit',{
				url: '<?php  echo site_url('purchase/admin/purchase/save')?>',
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					var purchase_master_id = result.data;
					if (result.success && purchase_master_id)
					{
						
						$('#form-purchase').form('clear');
						$('#dlg-form').window('close');	
						purchaseDetaildg(purchase_master_id);
						
						//showAddPurchaseGrid();
						//$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
						//$('#purchase-table').datagrid('reload');	// reload the user data
					} 
					else 
					{
						$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
					} //if close
				}//success close
			});				
		}
		function purchaseDetaildg(pmid){
			if(pmid!=''){
				//<?=site_url('purchase/admin/purchase/getPurchaseDetailjson')?>?purchase_master_id='+row.purchase_master_id;
				// var getUrl = "<?=site_url('purchase/admin/purchase/getPurchaseDetailjson')?>/?purchase_master_id ="+id;
				// var saveUrl = "<?=site_url('purchase/admin/purchase/savePurchaseDetail')?>/?purchase_master_id ="+id;
			
			$('#dlg-purchaseDetail').dialog('open').dialog('setTitle','Add Purchase description');
			$(function(){
				$('#dlg-purchaseDetail #dg').edatagrid({
					url: "<?=site_url('purchase/admin/purchase/getPurchaseDetailjson')?>/?purchase_master_id="+pmid,
					saveUrl: "<?=site_url('purchase/admin/purchase/savePurchaseDetail')?>/?purchase_master_id="+pmid ,
					updateUrl: "<?php echo site_url('purchase/admin/purchase/updatePurchaseDetail')?>/?purchase_master_id="+pmid,
					destroyUrl: "<?php echo site_url('purchase/admin/purchase/deletePurchaseDetail')?>/?purchase_master_id="+pmid
				});
			});
		}

		}
		//http://www.jeasyui.com/forum/index.php?topic=566.0;wap2
		function tagData(){
		 var row = $('#dg').datagrid('getSelected');
		  if (row){
		   $('#dlgtag').dialog('open').dialog('setTitle','Set Supplier');
		    $(function(){
		$('#dlgt').edatagrid({	
		  onEdit:function(index,row){
		   var ed = $(this).edatagrid('getEditor',{
		index:index,
		field:'name_supplier'
		});
		$(ed.target).combobox('reload','supplier.php?id='+row.id_part_cat);
		},
		url: 'get_data1.php?id='+row.idfbrequestpo,
		updateUrl: 'update_ing.php?idx='+row.idfbrequestpo,
		columns:[[
		{field:'name_part',title:'name of part',width:100,
		editor:{type:'text'}},
		{field:'name_supplier',title:'supplier',width:100,
		editor:{type:'combobox',options:{
		valueField:'id_supplier',textField:'name_supplier',required:true}}
		}	
		]],
		});
		    });}
		}	

		 
		 /*$(function(){
			$('#dlg-purchaseDetail #dg').edatagrid({
				url: '<?php site_url("purchase/admin/purchase/json ") ?>',
				saveUrl: '<?php site_url("purchase/admin/purchase/json ") ?>+',
				updateUrl: 'update_user.php',
				destroyUrl: 'destroy_user.php'
			});
		});*/
</script>


