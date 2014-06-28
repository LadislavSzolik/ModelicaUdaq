<?php /* Smarty version 2.6.25, created on 2011-05-04 16:44:29
         compiled from user_list.tpl */ ?>
<script type="text/javascript">//<![CDATA[<?php echo '
	function deleteWarn(del){
		var response = confirm(\''; ?>
<?php echo $this->_tpl_vars['text113']; ?>
<?php echo '\');
		if(response){
			window.location = "index.php?page=6&delete="+del;
		}else {
			//window.location = "index.php?page=6";
		}
	}
	$(document).ready(function(){
		$(\'.userListClass\').hide();
		$(\'.userListClass\').slideDown(\'swing\');
	});
//]]></script>'; ?>


<fieldset>
<legend><?php echo $this->_tpl_vars['text137']; ?>
</legend>
	<br />
	<div class="userListClass" >
		<table align="center" style="width:100%;border-color:white" cellpadding="3" cellspacing="0" border="1" >
		<tr align="center" style="color:white; background-color:#151B8D;">
			<td>ID</td>
			<td><?php echo $this->_tpl_vars['text36']; ?>
</td>
			<td>E-mail</td>
			<td><?php echo $this->_tpl_vars['text110']; ?>
</td>
			<td>IP</td>
			<td colspan="3" align="center"><?php echo $this->_tpl_vars['text82']; ?>
</td>
		</tr>
		<?php if ($this->_tpl_vars['userList']): ?>	
			<?php $_from = $this->_tpl_vars['userList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['aktUser']):
?>
			<?php if ($this->_tpl_vars['i']%2): ?> 
				<?php $this->assign('style', 'background-color:white;color:black'); ?>
			<?php else: ?>
				<?php $this->assign('style', 'background-color:#b8c1ff;color:black'); ?>
			<?php endif; ?>
			<tr style="<?php echo $this->_tpl_vars['style']; ?>
" >
				<td><?php echo $this->_tpl_vars['aktUser']->id; ?>
</td>
				<td><?php echo $this->_tpl_vars['aktUser']->login; ?>
</td>
				<td><?php echo $this->_tpl_vars['aktUser']->email; ?>
</td>
				<td>
				    <?php if ($this->_tpl_vars['aktUser']->permission == '1'): ?>
					<?php echo $this->_tpl_vars['text144']; ?>

				    <?php else: ?>
					<?php echo $this->_tpl_vars['text145']; ?>

				    <?php endif; ?>
				</td>
				<td><?php echo $this->_tpl_vars['aktUser']->ip; ?>
</td>
				<td>
					<a href="index.php?page=7&amp;show=<?php echo $this->_tpl_vars['aktUser']->id; ?>
">
					<img src="pic/zoomIcon.png"  alt="load" style="vertical-align:middle;" /></a>
				</td>
				<td>
				<a href="index.php?page=7&amp;change=<?php echo $this->_tpl_vars['aktUser']->id; ?>
" >
					<img src="pic/changeIcon2.png" width="22" alt="load" />
					</a>
				</td>
				<td>
					<a href="#" >
					<img onclick="deleteWarn(<?php echo $this->_tpl_vars['aktUser']->id; ?>
)" src="pic/remove.png" width="22" alt="load" />
					</a>
				</td>

			</tr>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<tr><td colspan="5"><?php echo $this->_tpl_vars['text89']; ?>
</td></tr>
			
		<?php endif; ?>

		<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['user']->permission < 2): ?>
			<tr><td colspan="8" style="text-align:center;" ><br />
				<a href="index.php?page=7&amp;addNew=true">
				<img src="pic/pridat.png" alt="pridat" height="22" style="padding:5px;" /><br />
				<?php echo $this->_tpl_vars['text111']; ?>

				</a>
				<br /><br />
				</td>
			</tr>
		<?php endif; ?>
		</table>
	</div>
</fieldset>