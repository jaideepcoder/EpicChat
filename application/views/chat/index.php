
<html>
<!DOCTYPE HTML>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" " />
		<meta name="description" content="<?= $description; ?>" />
		<meta name="keywords" content="<?= $keywords; ?>" />
		<title><?= $title; ?></title>
		<link rel="stylesheet" href="<?= base_url(); ?>css/style.css" type="text/css" />
		<link rel="icon" type="image/ico" href="<?= base_url(); ?>images/Chat.ico">
		<script src="<?= base_url(); ?>js/jquery-latest.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>js/chat.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" src="<?= base_url(); ?>js/transliterator.js"></script>
		<script type="text/javascript">
			//Server Initialisation
			var base_url = '<?= base_url(); ?>';
			var user = <?= $user; ?>;
			var state = <?= $state; ?>;
		</script>
		<?= smiley_js(); ?>
	</head>
	<body>
		<div id='splash'>
			<p>Enter your Name <input type="text" id="user" style="width: 250px;" /><br />
			<button name="Submit" id="submit" >Submit</button>
			
		</div>
		<div id="header">
			<?= $head; ?>
		</div>
		<div id="container">
			<?php $this->load->view('chat/ui'); ?>
		</div>
	</body>
</html>