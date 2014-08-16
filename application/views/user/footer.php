    <div id="footer" region="south" border="false">
        <div id="copyright">
            Copyright &copy; <?php echo date('Y');?> <?php echo $this->preference->item('site_name');?>. All Rights Reserved.<div style="float:right"><a href="http://yonefu.com/it/" target="_blank"> Powered By YONEFU</a></div>
        </div>
        <?php /*?><div id="version">
            <a href="#top"><?php print $this->lang->line('general_top')?></a> |
            <a href="<?php print base_url()?>user_guide"><?php print $this->lang->line('general_documentation')?></a> |
            Version <?php print BEP_VERSION?></div><?php */?>
    </div>
</div>
<?php print $this->bep_assets->get_footer_assets();?>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/datagrid-detailview.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.blockui.js"></script>
</body>
</html>