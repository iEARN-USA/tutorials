<!DOCTYPE html>

<html lang="en">

<head>
	
	<meta charset="utf-8">
	
	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
	
	<?php if(is_front_page()) { ?>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<?php } ?>
	
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<link rel="stylesheet" href="<?php echo THEME_URI; ?>/css/global.css">
	
	<link rel="dns-prefetch" href="//translate.google.com">
	
	<?php wp_head(); ?>
	
</head>

<body><div class="wrapper">
	<header class="header">
		<a class="logo" href="/">
			<img class="logo--image" src="<?php echo THEME_URI; ?>/images/logo.svg" width="180" height="54" alt="iEARN">
			<span class="logo--tagline">Collaboration Centre Tutorials</span>
		</a>
		<?php global $segmentation; ?>
		<div class="functionality">
			<form action="" method="post" class="segmentation" id="segmentation">
				<span class="segmentation--label">I am a &nbsp;</span>
				<select name="ns-audience">
					<option value="all">All</option>
					<option <?php if($segmentation->actual['audience'] == 'teachers') { echo 'selected="selected"'; } ?> value="teachers">Teacher</option>
					<option <?php if($segmentation->actual['audience'] == 'facilitators') { echo 'selected="selected"'; } ?> value="facilitators">Facilitator</option>
					<option <?php if($segmentation->actual['audience'] == 'students') { echo 'selected="selected"'; } ?> value="students">Student</option>
				</select>
				<span class="segmentation--label">&nbsp;in&nbsp;</span>
				<select name="ns-locale">
					<option value="intl">iEARN</option>
					<option <?php if($segmentation->actual['locale'] == 'usa') { echo 'selected="selected"'; } ?> value="usa">iEARN-USA</option>
				</select>
			</form>
			<span class="functionality--pipe">&nbsp;|&nbsp;</span>
			<button class="btn translate" id="translate">Translate</button>
			<span class="translate_google" id="translate_google"></span>
		</div>
	</header>