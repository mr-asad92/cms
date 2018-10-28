<div class="row">
    <form action="<?php echo base_url().'/accounts/profit_and_loss';?>" method="post">
        <div class="row">
            <div class="col-sm-1"><label class="control-label">From: </label></div>
            <div class="col-sm-2"><input type="date" name="from_date" value="<?php echo date('Y-m-d');?>" class="form-control"></div>

            <div class="col-sm-1"><label class="control-label">To: </label></div>
            <div class="col-sm-2"><input type="date" name="to_date" value="<?php echo date('Y-m-d');?>" class="form-control"></div>

            <div class="col-sm-1"><label class="control-label">&nbsp;</label><input type="submit" value="Submit" class="btn btn-info"></div>
        </div>
    </form>

</div>
<br />

<b>From:</b> <?php echo $fromDate;?> <br />
<b>To:</b> <?php echo $toDate;?> <br /> <br />
<br />
<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Expenses</div>
    <div class="panel-body">


        <table class="table table-responsive table-condensed table-bordered table-hover table-stripped">

            <thead>
            <tr>
                <th>Sr. </th>
                <th>Account Name</th>
                <th>Deescription</th>
                <th>Book Reference</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $sr = 1;
            $total_expense = 0;

            foreach ($expenses_listing as $key => $value){

                    ?>
                    <tr>
                        <td ><?php echo $sr;?></td>
                        <td ><?php echo $value['account_name']?></td>
                        <td ><?php echo $value['description']?></td>
                        <td ><?php echo $value['book_reference']?></td>
                        <td ><?php echo $value['amount']?></td>
                        <td ><?php echo $value['created_at']?></td>
                    </tr>

                    <?php
                    $sr++;
                    $total_expense+=$value['amount'];

            }
            ?>

            <tr class="bg-success">
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right">Total:</td>
                <td><?php echo $total_expense; ?></td>
                <td></td>
            </tr>

            </tbody>
        </table>

    </div>

</div>

<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Income</div>
    <div class="panel-body">


        <table class="table table-responsive table-condensed table-bordered table-hover table-stripped">

            <thead>
            <tr>
                <th>Sr. </th>
                <th>Account Name</th>
                <th>Deescription</th>
                <th>Book Reference</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $sr = 1;
            $total_income = 0;

            foreach ($income_listing as $key => $value){

                ?>
                <tr>
                    <td ><?php echo $sr;?></td>
                    <td ><?php echo $value['account_name']?></td>
                    <td ><?php echo $value['description']?></td>
                    <td ><?php echo $value['book_reference']?></td>
                    <td ><?php echo $value['amount']?></td>
                    <td ><?php echo $value['created_at']?></td>
                </tr>

                <?php
                $sr++;
                $total_income+=$value['amount'];

            }
            ?>

            <tr class="bg-success">
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right">Total:</td>
                <td><?php echo $total_income; ?></td>
                <td></td>
            </tr>

            </tbody>
        </table>

    </div>

</div>

<?php
$PL = $total_income - $total_expense;
$PL_text = ($PL >= 0)?'profit':'loss';
?>
<h2 class="<?php echo ($PL >= 0)?'text-success':'text-danger';?>">You are in <?php echo $PL_text.': '.$PL;?></h2>
