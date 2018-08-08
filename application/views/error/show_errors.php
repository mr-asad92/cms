
<?php
	if ($this->session->flashdata('errors')) {
		echo "<h2 class=\"text-danger\">Oops.! There are some errors.</h2>";
	
		echo "<div class=\"text-danger\">".$this->session->flashdata('errors')."</div>";

	}

?>