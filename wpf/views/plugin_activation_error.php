<?php
	@header( 'Content-Type: ' . \get_option( 'html_type' ) . '; charset=' . \get_option( 'blog_charset' ) );
	\nocache_headers();
?>
<!DOCTYPE html>
<html <?php \language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php echo \get_option( 'html_type' ); ?>; charset=<?php echo \get_option( 'blog_charset' ); ?>">
	<style type="text/css">
body {
	color: #444;
	font-family: "Open Sans", sans-serif;
	font-size: 13px;
	line-height: 1.5;
	margin: 0;
	padding: 2;
}

p {
	font-size: 13px;
	line-height: 1.5;
	margin: 0.5em 0;
}
	</style>
</head>
<body><?php
	foreach ( $errors as $error ) {
		echo '<p>', $error, '</p>';
	};
?></body>
</html>