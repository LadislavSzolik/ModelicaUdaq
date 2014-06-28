<?php /* Smarty version 2.6.25, created on 2011-05-04 12:41:10
         compiled from navigation_panel.tpl */ ?>
<script type="text/javascript">//<![CDATA[<?php echo '
$(document).ready(function(){
	$(\'#liquid-round\').hide(0);
	$(\'#liquid-round\').fadeIn(\'slow\');
});
//]]></script>'; ?>

<div class="navigation" id="navigation">
    <a href="index.php?page=1"><?php echo $this->_tpl_vars['text1']; ?>
</a>
	
    <a href="index.php?page=2"><?php echo $this->_tpl_vars['text2']; ?>
</a>
	
    <?php if (! $this->_tpl_vars['user']): ?>
     <a href="index.php?page=11"><?php echo $this->_tpl_vars['text3']; ?>
</a>
    <?php else: ?>
		<?php if ($this->_tpl_vars['user']->permission < 2): ?>
			<a href="index.php?page=6"><?php echo $this->_tpl_vars['text109']; ?>
</a>
		<?php endif; ?>
		<a href="index.php?page=8"><?php echo $this->_tpl_vars['text58']; ?>
</a>
	  	<a href="index.php?page=10"><?php echo $this->_tpl_vars['text88']; ?>
</a>
		<a href="index.php?page=13"><?php echo $this->_tpl_vars['text4']; ?>
</a>
     <label><?php echo $this->_tpl_vars['text5']; ?>
&nbsp;
		<?php if ($this->_tpl_vars['user']->ldap): ?>
			<?php echo $this->_tpl_vars['user']->login; ?>

		<?php else: ?>
			<a href="index.php?page=12"><?php echo $this->_tpl_vars['user']->name; ?>
&nbsp;<?php echo $this->_tpl_vars['user']->surname; ?>
</a>
		<?php endif; ?>
	</label>
    <?php endif; ?>
</div>
<div id="liquid-round"><div class="top"><span></span></div><div class = "center-content"><div id ="wait_loading"></div>