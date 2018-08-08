<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <link rel="icon" href="<?php echo base_url();?>assets/img/favicon.jpeg" type="image/jpeg" sizes="16x16">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ILM College GRW">
    <meta name="author" content="ILM College GRW">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.minc726.css?=140">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

</head>
<body class="focusedform">
    <?php $this->load->view($view);?>
    <div class="container">
    <?php
    if ($this->session->flashdata('errors')) {
        echo $this->session->flashdata('errors');
    }
    if ($this->session->flashdata('msg')) {
        echo $this->session->flashdata('msg');
    }

    ?>
    </div>
</body>
</html>