<?php
	if ($this->session->flashdata('errors')) {
		echo "<div class='text-danger'>".$this->session->flashdata('errors')."</div>";
	}

?>