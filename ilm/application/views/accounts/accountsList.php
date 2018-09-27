<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 8/15/2018
 * Time: 6:36 PM
 */
?>

<div class="panel panel-midnightblue">
    <div class="row">
        <h4>Accounts</h4>
        <!--<button class="btn btn-primary pull-right">Add </button>-->
    </div>
    <div class="panel-body">
        <div class="syllabus_table">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Book Reference</th>
                        <th class="text-center">Debit Account</th>
                        <th class="text-center">Credit Account</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="accounts_data">


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    //$.noConflict();
    //jQuery(document).ready(function(){
        //alert('Hello');
    //});

    $(document).ready(function(){
        alert('Hello');
    });

</script>
<!--<script type="text/javascript">

    $(document).ready(function () {
        alert('Hello');

    });

    function accountsData()
    {

        $.ajax({
            type: 'ajax',
            url: <?php echo base_url()?>'Accounts/showAccounts',
            async: false,
            dataType: 'json',
            success: function (data) {

                var html = '';
                var i;
                for (i = 0; i < data.length; i++)
                {
                    //alert(data[i].book_reference);
                    html += '<tr>' +
                            '<td>' + data[i].book_reference + '</td>' +
                            '<td>' + data[i].debit_account + '</td>' +
                            '<td>' + data[i].credit_account + '</td>' +
                            //'<td>' + data[i].amount + '</td>' +
                            '<td>' +
                                '<a class="btn btn-primary" ' +
                                'href="<?php echo base_url()?>">' +
                                '<i class="fa fa-pencil"></i>' +
                                '</a>' +

                                '<a class="btn btn-danger" ' +
                                'href="<?php echo base_url()?>">' +
                                '<i class="fa fa-trash-o"></i>' +
                                '</a>' +

                            '</td>' +

                            '</tr>';

                }

                $('#accounts_data').html(html);
            },
            error: function () {
                alert('error');
            }

        });
    }
</script>-->