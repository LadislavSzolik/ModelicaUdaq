<?php /* Smarty version 2.6.25, created on 2011-05-02 14:25:34
         compiled from report_table.tpl */ ?>
<script type="text/javascript">//<![CDATA[<?php echo '
	function deleteWarn(del){
		var response = confirm(\''; ?>
<?php echo $this->_tpl_vars['text113']; ?>
<?php echo '\');
		if(response){
			window.location = "index.php?page=7&delete="+del;
		}else {
			//window.location = "index.php?page=7";
		}
	}
	$(document).ready(function(){
		$(\'.reportClass\').hide();
		$(\'.reportClass\').slideDown(\'swing\');
	});
//]]></script>'; ?>


<fieldset>
<legend><?php echo $this->_tpl_vars['text139']; ?>
</legend>
	<br />
<div class="reportClass">
<table align="center" style="width:100%;border-color:white" cellpadding="3" cellspacing="0" border="1">	
	<tr align="center" style="color:white; background-color:#151B8D;">
			<td style="width:30px;"><b>ID</b></td>
		<?php if ($this->_tpl_vars['user']->permission < 2): ?>
			<td><b><?php echo $this->_tpl_vars['text36']; ?>
</b></td>
		<?php endif; ?>
			<td><b><?php echo $this->_tpl_vars['text12']; ?>
</b></td>
			<td><b><?php echo $this->_tpl_vars['text86']; ?>
</b></td>
			<td><b><?php echo $this->_tpl_vars['text80']; ?>
</b></td>
			<td colspan="2"><b><?php echo $this->_tpl_vars['text82']; ?>
</b></td>
	</tr>
	<?php if ($this->_tpl_vars['reportArr']): ?>
		<?php $_from = $this->_tpl_vars['reportArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['report']):
?>
			<?php if ($this->_tpl_vars['i']%2): ?>
				<?php $this->assign('style', 'background-color:white;color:black'); ?>
			<?php else: ?>
				<?php $this->assign('style', 'background-color:#b8c1ff;color:black'); ?>
			<?php endif; ?>
			<tr align="center" style="<?php echo $this->_tpl_vars['style']; ?>
" ><td><?php echo $this->_tpl_vars['report']->id; ?>
</td>
			<?php if ($this->_tpl_vars['user']->permission < 2): ?>
				<td><?php echo $this->_tpl_vars['report']->login; ?>
</td>
			<?php endif; ?>
				<td>
					<?php if ($this->_tpl_vars['report']->controllerId == '-2'): ?>
						-
					<?php else: ?>
						<?php echo $this->_tpl_vars['report']->controllerId; ?>

					<?php endif; ?>
				</td>
				<td>
				<?php if ($this->_tpl_vars['report']->controller->name == '-1'): ?>
					<?php echo $this->_tpl_vars['text85']; ?>

				<?php elseif ($this->_tpl_vars['report']->controller->name == '-2'): ?>
					<?php echo $this->_tpl_vars['text121']; ?>

				<?php else: ?>
					<?php echo $this->_tpl_vars['report']->controller->name; ?>

				<?php endif; ?>
				</td>
				<td><?php echo $this->_tpl_vars['report']->startTime; ?>
</td>
				<td>
					<a href="index.php?page=8&amp;id=<?php echo $this->_tpl_vars['report']->id; ?>
">
						<img src="pic/zoomIcon.png"  alt="load" style="vertical-align:middle;padding-right:5px;" />
					</a>
				</td>
			<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['user']->permission < 2): ?>
				<td>
	 				<a href="#"> 
						<img onclick="deleteWarn(<?php echo $this->_tpl_vars['report']->id; ?>
)" src="pic/remove.png" width="22" alt="load" />
 					</a> 
				</td>
			<?php endif; ?>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
		<tr><td colspan="4"><?php echo $this->_tpl_vars['text89']; ?>
</td></tr>
	<?php endif; ?>
</table>
</div>
</fieldset>