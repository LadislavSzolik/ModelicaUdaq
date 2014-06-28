<?php /* Smarty version 2.6.25, created on 2011-05-04 12:53:18
         compiled from register.tpl */ ?>

<?php if (isset ( $this->_tpl_vars['smartyRegisterRequest'] ) && ! $this->_tpl_vars['error_arr']): ?>
  <fieldset><h3 align="center"><?php echo $this->_tpl_vars['text42']; ?>
</h3><br /><div class = 'goodReg'></div></fieldset>
<?php elseif (isset ( $this->_tpl_vars['smartyChangeRequest'] ) && ! $this->_tpl_vars['error_arr']): ?>
  <fieldset><h3 align="center"><?php echo $this->_tpl_vars['text43']; ?>
</h3><br /><div class = 'goodReg'></div></fieldset>
<?php else: ?>
  <form action='index.php?page=12' method='post' enctype='multipart/form-data'>
	<fieldset>
		<legend>
		<?php if ($this->_tpl_vars['user']): ?>
			<?php echo $this->_tpl_vars['text136']; ?>

		<?php else: ?>
			<?php echo $this->_tpl_vars['text44']; ?>

		<?php endif; ?>
		</legend>
	<div class='registerContent' >
		<br />
		<table class='regiterTable' >
		<tr ><td rowspan='7' valign='top'><div class='loginSettingsIcon'></div></td></tr>
		<?php if ($this->_tpl_vars['user']): ?>
		<tr><td><?php echo $this->_tpl_vars['text45']; ?>
</td> <td><input name='pouMeno' type='text' value='<?php echo $this->_tpl_vars['pouMeno']; ?>
' /></td></tr>
		<?php else: ?>
		<tr><td><?php echo $this->_tpl_vars['text46']; ?>
</td> <td><input name='pouMeno' type='text' value='<?php echo $this->_tpl_vars['pouMeno']; ?>
'/></td></tr>
		<?php endif; ?>
		<tr><td><?php echo $this->_tpl_vars['text47']; ?>
</td><td><input  type='password' name='heslo1'  value='<?php echo $this->_tpl_vars['heslo1']; ?>
' /></td></tr>
		<tr><td><?php echo $this->_tpl_vars['text48']; ?>
</td><td><input  type='password' name='heslo2'  value='<?php echo $this->_tpl_vars['heslo2']; ?>
' /></td></tr>
		<tr><td><?php echo $this->_tpl_vars['text49']; ?>
</td><td><input type='text'  name='meno' value='<?php echo $this->_tpl_vars['meno']; ?>
' /> </td></tr>
		<tr><td><?php echo $this->_tpl_vars['text50']; ?>
</td><td><input type='text'  name='priezvisko' value='<?php echo $this->_tpl_vars['priezvisko']; ?>
' /></td></tr>
		<tr><td>E-mail</td><td><input type='text'  name='email' value='<?php echo $this->_tpl_vars['email']; ?>
' /></td></tr>
			<tr><td colspan="3" align="center">
			<br />
			<?php if ($this->_tpl_vars['user']): ?>
				<input  type='submit' name='changeRequest' value='<?php echo $this->_tpl_vars['text51']; ?>
' />
			<?php else: ?>
				<input  type='submit' name='registerRequest' value='<?php echo $this->_tpl_vars['text52']; ?>
' />
			<?php endif; ?>
			</td></tr>
		</table>
	</div>
	</fieldset>
  </form>
<br /><br />
  <?php if ($this->_tpl_vars['error_arr'] != ''): ?>
      <fieldset>
      <legend><?php echo $this->_tpl_vars['text40']; ?>
</legend>
		<div style="color:red; padding:20px;">
			<?php $_from = $this->_tpl_vars['error_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
				<b><?php echo $this->_tpl_vars['error']; ?>
</b><br />
			<?php endforeach; endif; unset($_from); ?>
		</div>
      </fieldset>
  <?php endif; ?>
<?php endif; ?>
