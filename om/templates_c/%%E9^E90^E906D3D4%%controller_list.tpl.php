<?php /* Smarty version 2.6.25, created on 2011-05-04 15:07:24
         compiled from controller_list.tpl */ ?>
<script type="text/javascript">//<![CDATA[<?php echo '
	function deleteWarn(def,del){
		var response = confirm(\''; ?>
<?php echo $this->_tpl_vars['text113']; ?>
<?php echo '\');
		if(response){
			window.location = "index.php?page=2&default="+def+"&delete="+del;
		}else {
			window.location = "index.php?page=2";
		}
	}
	function checkChange() {
			if (!$(\'.default\').is(\':hidden\')) {
				$(\'.default\').slideUp(\'slow\',tesingCheck);
			}
			if (!$(\'.userDef\').is(\':hidden\')) {
				$(\'.userDef\').slideUp(\'slow\',tesingCheck);
			}
			if (!$(\'.onlyStep\').is(\':hidden\')) {
				$(\'.onlyStep\').slideUp(\'slow\',tesingCheck);
			}
	}
	function tesingCheck() {
		if ($(\'.regDB0check\').attr(\'checked\')) {
				//$(\'.onlyStep\').css("display","block");
				$(\'.onlyStep\').slideDown(\'slow\');
			}
			if ($(\'.regDB1check\').attr(\'checked\')) {
				
				$(\'.default\').slideDown(\'slow\');
			}
			if ($(\'.regDB2check\').attr(\'checked\')) {
				$(\'.userDef\').slideDown(\'slow\');
		}
	}
	
	$(document).ready(function(){
		$(\'.default\').slideDown(\'slow\');
		$(\'.regDB0check\').click(function(){
			checkChange();
		});

		$(\'.regDB1check\').click(function(){
			checkChange();
			
		});
		$(\'.regDB2check\').click(function(){
			checkChange();
			
		});
	});
//]]></script>'; ?>



<div class="regList">
	<fieldset>
	<legend><?php echo $this->_tpl_vars['text124']; ?>
</legend>
	<?php if (! $this->_tpl_vars['user']): ?>
		<?php $this->assign('disable', 'disabled'); ?>
	<?php endif; ?>	
	<div>
		<table align="center">
			<tr><td ><input type="radio" name="regDB" class="regDB1check" checked="checked" /><?php echo $this->_tpl_vars['text14']; ?>
</td></tr>
			<tr><td ><input type="radio" name="regDB" class="regDB2check" <?php echo $this->_tpl_vars['disable']; ?>
 /><?php echo $this->_tpl_vars['text16']; ?>
</td></tr>
			<tr><td ><input type="radio" name="regDB" class="regDB0check" <?php echo $this->_tpl_vars['disable']; ?>
 /><?php echo $this->_tpl_vars['text121']; ?>
</td></tr>
		</table>
	</div>
</fieldset>
	<br />
	<fieldset>
		<legend><?php echo $this->_tpl_vars['text125']; ?>
</legend>
		<div style="padding:10px;">
		<div class="default" style="display:none;">
			<table align="center" style="width:100%;border-color:white" cellpadding="3" cellspacing="0" border="1">
			<tr  align="center" style="color:white; background-color:#151B8D;"><td>ID</td><td><?php echo $this->_tpl_vars['text61']; ?>
</td><td><?php echo $this->_tpl_vars['text80']; ?>
</td><td colspan="3"><?php echo $this->_tpl_vars['text82']; ?>
</td></tr>
			<?php if ($this->_tpl_vars['defaultArr']): ?>
				<?php $_from = $this->_tpl_vars['defaultArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['default']):
?>
				<?php if ($this->_tpl_vars['i']%2): ?> 
					<?php $this->assign('style', 'background-color:white;color:black'); ?>
				<?php else: ?>
					<?php $this->assign('style', 'background-color:#b8c1ff;color:black'); ?>
				<?php endif; ?>
				<tr align="center" style="<?php echo $this->_tpl_vars['style']; ?>
"><td><?php echo $this->_tpl_vars['default']->id; ?>
</td><td><?php echo $this->_tpl_vars['default']->name; ?>
</td><td><?php echo $this->_tpl_vars['default']->datum; ?>
</td>
					
				<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['user']->permission < 2): ?>
					<td>
						<a href="#"> 
						<img onclick="deleteWarn(0,<?php echo $this->_tpl_vars['default']->id; ?>
)" src="pic/remove.png" width="22" alt="remove" />
						</a> 
					</td>
				<?php endif; ?>
					<td>
					<a href="index.php?page=3&amp;default=true&amp;show=<?php echo $this->_tpl_vars['default']->id; ?>
" >
						<img src="pic/changeIcon2.png" width="22" alt="edit" />
						</a>
					</td>
				<?php if ($this->_tpl_vars['user']): ?>
					<td>
						<a href="index.php?page=4&amp;simCont=<?php echo $this->_tpl_vars['default']->id; ?>
" >
						<img src="pic/startIcon.png" width="22" alt="start" />
						</a>
					</td>
				<?php endif; ?>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<tr><td colspan="6"><?php echo $this->_tpl_vars['text89']; ?>
</td></tr>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['user']->permission < 2): ?>
				<tr><td colspan="6" style="text-align:center;" ><br />
					<a href="index.php?page=3&amp;addNew=true" >
					<img src="pic/pridat.png" alt="pridat" height="22" style="padding:5px;" /><br /><?php echo $this->_tpl_vars['text13']; ?>
</a><br /><br />
				</td></tr>
			<?php endif; ?>
			</table>
		</div>
		<div class="userDef" style="display:none;">
			<table align="center" style="width:100%;border-color:white;" cellpadding="3" cellspacing="0" border="1">	
			<tr  align="center"  style="color:white; background-color:#151B8D;">
				<td>ID</td>
			<?php if ($this->_tpl_vars['user']->permission < 2): ?>
				<td><?php echo $this->_tpl_vars['text36']; ?>
</td>
			<?php endif; ?>
				<td><?php echo $this->_tpl_vars['text61']; ?>
</td>
				<td><?php echo $this->_tpl_vars['text80']; ?>
</td>
			<?php if ($this->_tpl_vars['user']->permission < 2): ?>
				<td><?php echo $this->_tpl_vars['text83']; ?>
</td>
			<?php endif; ?>
				<td colspan="3"><?php echo $this->_tpl_vars['text82']; ?>
</td>
			</tr>
			<?php if ($this->_tpl_vars['userDefArr']): ?>
				<?php $_from = $this->_tpl_vars['userDefArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['j'] => $this->_tpl_vars['userDef']):
?>
					<?php if ($this->_tpl_vars['j']%2): ?>
						<?php $this->assign('style', 'background-color:white;color:black;'); ?>
					<?php else: ?>
						<?php $this->assign('style', 'background-color:#b8c1ff;color:black;'); ?>
					<?php endif; ?>
					<tr align="center"  style="<?php echo $this->_tpl_vars['style']; ?>
" >
						<td><?php echo $this->_tpl_vars['userDef']->id; ?>
</td>
					<?php if ($this->_tpl_vars['user']->permission < 2): ?>
						<td><?php echo $this->_tpl_vars['userDef']->login; ?>
</td>
					<?php endif; ?>
						<td><?php echo $this->_tpl_vars['userDef']->name; ?>
</td>
						<td><?php echo $this->_tpl_vars['userDef']->datum; ?>
</td>
					<?php if ($this->_tpl_vars['user']->permission < 2): ?>
						<td><?php echo $this->_tpl_vars['userDef']->activ; ?>
</td>
					<?php endif; ?>
						<td>
							<a href="#">
							<img onclick="deleteWarn(1,<?php echo $this->_tpl_vars['userDef']->id; ?>
)" src="pic/remove.png" width="22" alt="load" />
							</a>
						</td>
						<td>
						      <a href="index.php?page=3&amp;default=false&amp;show=<?php echo $this->_tpl_vars['userDef']->id; ?>
" >
							<img src="pic/changeIcon2.png" width="22" alt="edit" />
						      </a>
						</td>
					<?php if ($this->_tpl_vars['user']): ?>
						<td>	
							<a href="index.php?page=4&amp;simCont=<?php echo $this->_tpl_vars['userDef']->id; ?>
" >
							<img src="pic/startIcon.png" width="22" alt="start" />
							</a>
						</td>
					<?php endif; ?>
						
					</tr>
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<tr><td colspan="6" align="center"><?php echo $this->_tpl_vars['text89']; ?>
</td></tr>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['user']->permission > 1 && $this->_tpl_vars['user']): ?>
				<tr>
					<td colspan="6" style="text-align:center;" ><br />
					<a href="index.php?page=3&amp;addNew=true">
						<img src="pic/pridat.png" alt="pridat" height="22" style="padding:5px;" /><br />
						<?php echo $this->_tpl_vars['text13']; ?>

					</a>
					<br /><br />
					</td>
				</tr>
			<?php endif; ?>
			</table>
		</div>
		<div class="onlyStep" style="display:none;text-align:center;">
				<a href="index.php?page=5">
				<img alt="remove"  src="pic/startIcon.png" style="padding:5px;" /><br /><?php echo $this->_tpl_vars['text33']; ?>
</a>
		</div>
		</div>
	</fieldset>
</div>