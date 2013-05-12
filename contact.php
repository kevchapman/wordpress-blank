<?php
/*
Template Name: Contact
*/
update_option('template_name','contact');
$mailTo = 'kev@kevchapman.co.uk';
$subject = 'enquiry from kevchapman.co.uk';
#$feedback = "<p class=\"feedback\">Your Message has been sent</p>";

get_header(); ?>

<div class ="color-overflow-top">
	<div id="page-head">
		<div class="inner">
			<h1>Get in Touch</h1>
		</div>
	</div>
</div>

	<div id="content" role="main">
<?php 
# send the form data

if(isset($_POST['mailme'])){
	$yourname = $_POST[yourname];
	$email = $_POST[email];
	$msg = $_POST[msg];
	
	if (!isset($_POST['spam'])) {
		$feedback = "<p class=\"feedback error\">Please tick \"I'm not a spam bot\"</p>";
	}
	if ($_POST['email'] == '') {
		$feedback = $feedback ."<p class=\"feedback\">Please enter your email so I can get back to you.</p>";
	}
	if (isset($_POST['spam']) && $email !='') {
		$feedback = "<p class=\"feedback\">Your Message has been sent</p>";
		$header = "From: $email\n"
	."MIME-Version: 1.0\n"
	."Content-Type: text/html; charset=utf-8\n";
	
	$body = "<p>Name : <strong>$yourname</strong></p>\n
	<p>Email : <strong>$email</strong></p>\n
	<p>Enquiry : <br /><strong>$msg</strong></p>\n";
	
	
	mail($mailTo, $subject, $body, $header);
	}
}


 ?>	
		<div id="main">
			<?php echo $feedback; ?>
			<div class="pad">
			
			<form id="contact" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page_id=5" >
			<label>
			<input class="input-name" name="yourname" value="<?php echo $yourname; ?>" />
			</label>
			<label>
			<input class="input-email" name="email" value="<?php echo $email; ?>" />
			</label>
			<label>
			<textarea name="msg" class="input-msg" cols="40" rows="15" ><?php echo $msg; ?></textarea>
			</label>
			
			I'm not a spam bot: <input class="spam" type="checkbox" name="spam" />
			<input class="mail-me" type="image" src="<?php bloginfo('template_url'); ?>/images/ui/mail-me.gif" name="mailme" value="mailme" />
			
			
			
			</form>

			</div>
		</div> <!-- #main -->



<?php # get_sidebar(); ?>

<hr />

	</div> <!-- #content -->
	
<div class="color-overflow-bot">	
	<div id="footer-block">
		<div class="inner">
			
		</div>
	</div>
</div>
		
<?php get_footer(); ?>
