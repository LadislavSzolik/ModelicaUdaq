<?php /* Smarty version 2.6.25, created on 2011-04-02 22:29:02
         compiled from reg_options.tpl */ ?>
<script type="text/javascript" src="skript/js/regOptionJS.js"></script>
<?php if ($this->_tpl_vars['option'] != 'add'): ?>	
	<fieldset>
	<legend><?php echo $this->_tpl_vars['text12']; ?>
</legend>
		<form action='index.php?page=2' method='post' class="regOptionsForm" enctype='multipart/form-data'>
	<table class="RegOptTable">
		<?php if (! $this->_tpl_vars['loginUser']): ?>
			<?php $this->assign('hideElement', 'display:none'); ?>
			<?php $this->assign('tdspan', 'rowspan="2"'); ?>
		<?php endif; ?>
			<tr>
				
				<TD align="left" rowspan="2">
					<?php if ($this->_tpl_vars['loginUser']): ?>
					<button type="SUBMIT"  name="addNew" style="padding:5px;">
					<img src="pic/pridat.png" alt="pridat" style="vertical-align:middle;padding-right:5px;" />
					<div style="display:inline;vertical-align:middle;"><?php echo $this->_tpl_vars['text13']; ?>
</div>
					</button>
					<?php endif; ?>
				</TD>
				
				<TD align="left" <?php echo $this->_tpl_vars['tdspan']; ?>
  >
					<input style="<?php echo $this->_tpl_vars['hideElement']; ?>
" type="radio" class="typReg1" name="typReg" value="defaultRegulators" <?php echo $this->_tpl_vars['defaultCheck']; ?>
>
					<?php echo $this->_tpl_vars['text14']; ?>

				</TD>
				<TD align="left" rowspan="2" style="width:150px;">
					<select class='regList' name='regList'>
					</select>
				</TD>
				<TD align="right" rowspan="2">
					<button type="SUBMIT"  name="loadReg" style="padding:5px;">
					<img src="pic/load.png" width="22" alt="load" style="vertical-align:middle;padding-right:5px;" />
					<div style="display:inline;vertical-align:middle;"><?php echo $this->_tpl_vars['text15']; ?>
</div>
					</button>
				</TD>
			</tr>
			<?php if ($this->_tpl_vars['admin']): ?>
			<tr style="<?php echo $this->_tpl_vars['hideElement']; ?>
">
				<TD align="left"><input type="radio" class="typReg2" name="typReg" value="savedRegulators" <?php echo $this->_tpl_vars['loadedCheck']; ?>
><?php echo $this->_tpl_vars['text16']; ?>
</TD>
			</tr>
			<?php endif; ?>
	</table>
	<input type="hidden" class="DefRegNames" value="<?php echo $this->_tpl_vars['defRegNames']; ?>
" />
	<input type="hidden" class="SavedRegNames" value="<?php echo $this->_tpl_vars['savedRegNames']; ?>
" />
	<input type="hidden" class="AktualName" value="<?php echo $this->_tpl_vars['aktualName']; ?>
" />
	</form>
	</fieldset>
	<br/>
<?php endif; ?>