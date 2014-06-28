<?php /* Smarty version 2.6.25, created on 2011-05-04 12:53:16
         compiled from login.tpl */ ?>

<?php if ($this->_tpl_vars['user']): ?>
 <fieldset><div style="width:100%;text-align:center;"><h3><?php echo $this->_tpl_vars['text41']; ?>
</h3><div class='goodLogin'></div></div></fieldset>
<?php else: ?>
	<form action='index.php?page=11' method='post' enctype='multipart/form-data'>
	<fieldset >
		<legend><?php echo $this->_tpl_vars['text34']; ?>
</legend>
		<div class='loginContent'>
		<table style="width:500px;margin:auto;" class='loginTable' border='0' >
		<tr ><td rowspan="4"><div class='loginFigure'></div></td></tr>
		<tr align="left">
			<td><label><?php echo $this->_tpl_vars['text35']; ?>
</label></td>
			<td><select name="LdapLogin" ><option value="NOLDAP" >no LDAP</option><option value="LDAP" >LDAP stuba</option></select></td></tr>
    	<tr align="left" ><td><label for='pouMeno'><?php echo $this->_tpl_vars['text36']; ?>
</label></td><td><input type='text' name='pouMeno' class='pouMeno'/></td></tr>
    	<tr align="left" ><td><label for='heslo'><?php echo $this->_tpl_vars['text37']; ?>
</label></td><td><input type='password' name='heslo' class='heslo' /></td></tr>
		<tr align="right"><td colspan="2"><br /><button type='submit' name='loginRequest' id ='buttonBtn' ><?php echo $this->_tpl_vars['text38']; ?>
</button></td></tr>
		</table>
		</div>
		<br />	
		<div style="width:100%;text-align:right;"><?php echo $this->_tpl_vars['text134']; ?>
 <a href='index.php?page=12'  class ='anBtn'><?php echo $this->_tpl_vars['text135']; ?>
</a></div>
	</fieldset>
		<br /><br />
	</form>	
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