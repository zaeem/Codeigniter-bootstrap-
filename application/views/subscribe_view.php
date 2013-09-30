<div class="container-fluid">
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="login-form">
					<h2><?php echo $heading; ?></h2>
					<?php if(isset($msg) && ! is_null($msg)) echo $msg;?>
					<form action="<?php echo base_url();?>index.php/subscribe/do_subscribe" method="post" name="process">
						<fieldset>
							<div class="clearfix">
								<input type="text" name='fname' id='fname' value="<?php echo set_value('fname');?>" placeholder="First Name">
							</div>
							<div class="clearfix">
								<input type="text" name='lname' id='lname' value="<?php echo set_value('lname');?>" placeholder="Last Name">
							</div>
							<div class="clearfix">
								<input type="text" name='email' id='email' value="<?php echo set_value('email');?>" placeholder="Email">
							</div>

							<div class="clearfix">
								<select name = "list" title='Select a list to subscribe'>
								<?php foreach($lists as $list){?>
									
									<option value = "<?php echo $list['id']?>"> <?php echo $list['name']?> </option>
								
								<?php }?>
								</select>
							</div>

							<button class="btn btn-primary" type="submit">Subscribe</button>
						</fieldset>
						<br/>
						<?php echo validation_errors("<p class='error'>"); ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
