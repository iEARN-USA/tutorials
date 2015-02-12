<form role="search" method="get" action="/">
	<input type="search" name="s" value="<?php if(isset($_GET['s'])) { echo $_GET['s']; } ?>">
	<input type="submit" class="btn" value="Search">
</form>