<?php /* Smarty version 2.6.25, created on 2011-04-13 09:20:34
         compiled from regulator_panel.tpl */ ?>
<script  type="text/javascript">
<?php echo '
	$(\'.clearModel\').click(function(){
		var response = confirm(\''; ?>
<?php echo $this->_tpl_vars['text113']; ?>
<?php echo '\');
		if(response){
			var dataT = \'\';
			dataT += \'&contID=\'+encodeURIComponent($(\'.contID\').val());
			$.ajax({
			type: "POST",
			url: "save_clear_model.php",
			data: dataT,
			success:
				function(html){
					$(".notification").html(html);
				}
			});
		}
	});
'; ?>

</script>

</br>		
	<fieldset>	
		<div class="footer_nav" style="text-align:center;">		
		<a href="index.php?page=9"><button  class='back' type='button'><img height="32" src="pic/backIcon.png"  alt="back" />
		<br /><?php echo $this->_tpl_vars['text81']; ?>
</button></a>
		<?php if ($this->_tpl_vars['user']): ?>
		<button  class='predvolba' type='button'><img src="pic/default.png"  alt="default" />
		<br /><?php echo $this->_tpl_vars['text30']; ?>
</button>
		
			<?php if (( $this->_tpl_vars['option'] != 'default' || $this->_tpl_vars['user']->permission < 2 )): ?>
			<button class='saveModel' name='saveModel' type='button' ><img src="pic/ulozenieIcon.png"  alt="save" height="32" />
			<br /><?php echo $this->_tpl_vars['text31']; ?>
</button>
			<?php endif; ?>
			<?php if (( $this->_tpl_vars['option'] == 'saved' || $this->_tpl_vars['user']->permission < 2 ) && $this->_tpl_vars['option'] != 'add'): ?>
				<button class='clearModel' name='clearModel' type='button'>
				<img alt="remove" src="pic/remove.png" /><br /><?php echo $this->_tpl_vars['text32']; ?>
</button>
			<?php endif; ?>					
		<button class="spustitE" type="submit" name="startRequest">
		<img alt="remove"  src="pic/start.png" /><br /><?php echo $this->_tpl_vars['text33']; ?>
</button>
		</div>
		<?php endif; ?>
	</fieldset>
	
</form>