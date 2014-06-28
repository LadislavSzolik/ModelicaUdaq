<?php /* Smarty version 2.6.25, created on 2011-05-07 14:46:12
         compiled from user.tpl */ ?>

<?php if ($this->_tpl_vars['succes']): ?>
	<fieldset>
		<legend><?php echo $this->_tpl_vars['text138']; ?>
</legend>
		<br />
		<div class="userClass" style="text-align:center;">
			<div class = 'goodReg'></div>
			<br />
			<h3><?php echo $this->_tpl_vars['text117']; ?>
</h3>		
		<br />
		<a  href="index.php?page=6"><img height="32" src="pic/backIcon.png"  alt="back" /><br /><?php echo $this->_tpl_vars['text81']; ?>
</a>
		</div>
	</fieldset>
<?php else: ?>
	<script type="text/javascript">//<![CDATA[<?php echo '
		$(document).ready(function(){ 
			$(\'.newPassw\').click(function(){
				if ($(\'.newPassw\').attr("checked") == true) {
					$(\'.trPassw1\').css("visibility","visible");
					$(\'.trPassw2\').css("visibility","visible");
				}else {
					$(\'.trPassw1\').css("visibility","hidden");
					$(\'.trPassw2\').css("visibility","hidden");
				}
			});
			$(\'.updateUser\').click(function(){
				$(\'.userForm\').submit();
			});
			$(\'.createUser\').click(function(){
				$(\'.userForm\').submit();
			});
			
		});
	//]]></script>'; ?>

	<div class="userClass">
		<form  class="userForm" action='index.php?page=7' method='post' enctype='multipart/form-data'>
		<fieldset>
			<legend><?php echo $this->_tpl_vars['text138']; ?>
</legend>
			<br />
			<table  align="center" style="width:100%;"  cellspacing="0" cellpadding="3">
			<?php if ($this->_tpl_vars['show']): ?>
					<tr ><td rowspan='9' align="center" valign='top'><div class='loginSettingsIcon'></div></td></tr>
					<tr><td>ID</td><td><b><?php echo $this->_tpl_vars['user']->id; ?>
</b></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text36']; ?>
</td><td><b><?php echo $this->_tpl_vars['choosedUser']->login; ?>
</b></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text49']; ?>
</td><td><b><?php echo $this->_tpl_vars['choosedUser']->name; ?>
</b></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text50']; ?>
</td><td><b><?php echo $this->_tpl_vars['choosedUser']->surname; ?>
</b></td></tr>
					<tr><td>E-mail</td><td><b><?php echo $this->_tpl_vars['choosedUser']->email; ?>
</b></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text110']; ?>
</td><td><b>
						<?php if ($this->_tpl_vars['choosedUser']->permission == '1'): ?>
							<?php echo $this->_tpl_vars['text144']; ?>

						<?php else: ?>
							<?php echo $this->_tpl_vars['text145']; ?>

						<?php endif; ?>
					</b></td></tr>
					<tr><td>IP</td><td><b><?php echo $this->_tpl_vars['choosedUser']->ip; ?>
</b></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text80']; ?>
</td><td><b><?php echo $this->_tpl_vars['choosedUser']->datum; ?>
</b></td></tr>
			<?php elseif ($this->_tpl_vars['change']): ?>
					<tr ><td rowspan='10' align="center" valign='top'><div class='loginSettingsIcon'></div></td></tr>
					<tr><td>ID</td><td><?php echo $this->_tpl_vars['choosedUser']->id; ?>
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['choosedUser']->id; ?>
" /></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text36']; ?>
</td><td><input name='login' type='text' value='<?php echo $this->_tpl_vars['choosedUser']->login; ?>
'/></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text49']; ?>
</td><td><input name='name' type='text' value='<?php echo $this->_tpl_vars['choosedUser']->name; ?>
'/></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text50']; ?>
</td><td><input name='surname' type='text' value='<?php echo $this->_tpl_vars['choosedUser']->surname; ?>
'/></td></tr>
					<tr><td>E-mail</td><td><input name='email' type='text' value='<?php echo $this->_tpl_vars['choosedUser']->email; ?>
'/></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text110']; ?>
</td><td>
					<select name='permission'>
					<?php if ($this->_tpl_vars['choosedUser']->permission == '1'): ?>
					  <option value="1" selected="selected" ><?php echo $this->_tpl_vars['text144']; ?>
</option>
					  <option value="2" ><?php echo $this->_tpl_vars['text145']; ?>
</option>
					<?php else: ?>
					  <option value="1" ><?php echo $this->_tpl_vars['text144']; ?>
</option>
					  <option value="2" selected="selected"><?php echo $this->_tpl_vars['text145']; ?>
</option>
					<?php endif; ?>
					</select>
					</td></tr>
					<tr><td  ><input type="checkbox" name="newPassw" class="newPassw" /><?php echo $this->_tpl_vars['text116']; ?>
</td></tr>
					<tr class="trPassw1"  style="visibility:hidden;"><td><?php echo $this->_tpl_vars['text47']; ?>
</td><td><input name='passw1' type='password' value=''/></td></tr>
					<tr class="trPassw2" style="visibility:hidden;"><td><?php echo $this->_tpl_vars['text48']; ?>
</td><td><input name='passw2' type='password' value=''/></td></tr>
			<?php elseif ($this->_tpl_vars['addNew']): ?>
					<tr ><td rowspan='8' align="center" valign='top'><div class='loginSettingsIcon'></div></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text36']; ?>
</td><td><input name='login' type='text' value=''/></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text47']; ?>
</td><td><input name='passw1' type='password' value=''/></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text48']; ?>
</td><td><input name='passw2' type='password' value=''/></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text49']; ?>
</td><td><input name='name' type='text' value=''/></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text50']; ?>
</td><td><input name='surname' type='text' value=''/></td></tr>
					<tr><td>E-mail</td><td><input name='email' type='text' value=''/></td></tr>
					<tr><td><?php echo $this->_tpl_vars['text110']; ?>
</td><td>
						<select name='permission'>
							<option value="1" ><?php echo $this->_tpl_vars['text144']; ?>
</option>
							<option value="2" ><?php echo $this->_tpl_vars['text145']; ?>
</option>
						</select></td></tr>
			<?php endif; ?>
				<tr><td colspan="3"><hr /></td></tr>
				<tr><td colspan="3" align="center">
					<table cellpadding="10px">
						<tr >
							<td >
								<a  href="index.php?page=6"><img height="32" src="pic/backIcon.png"  alt="back" /><br /><?php echo $this->_tpl_vars['text81']; ?>
</a>
							</td>
						<?php if ($this->_tpl_vars['change']): ?>
							<td>
								<input name="updateUser" type="hidden" value="yes" />
								<div class='updateUser' style="cursor:pointer;cursor:hand;" >
									<img src="pic/ulozenieIcon.png"  alt="save" height="32" /><br /><?php echo $this->_tpl_vars['text31']; ?>

								</div>
							</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['addNew']): ?>
							<td>
								<input name="createUser" type="hidden" value="yes" />
								<div class='createUser' style="cursor:pointer;cursor:hand;" >
									<img src="pic/ulozenieIcon.png"  alt="save" height="32" /><br /><?php echo $this->_tpl_vars['text31']; ?>

								</div>
							</td>
						<?php endif; ?>
						</tr>
					</table>
				</td></tr>
			</table>
		</fieldset>
		</form>
		<br /><br />
		<?php if ($this->_tpl_vars['errorArr']): ?>
			<fieldset>
				<legend><?php echo $this->_tpl_vars['text40']; ?>
</legend>
					<div style="color:red; padding:20px;">
					<?php $_from = $this->_tpl_vars['errorArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
						<b><?php echo $this->_tpl_vars['error']; ?>
</b><br />
					<?php endforeach; endif; unset($_from); ?>
					</div>
			</fieldset>
		<?php endif; ?>
	</div>
<?php endif; ?>
