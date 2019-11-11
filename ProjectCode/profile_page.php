<?php
    echo <<<_END
    <style>
    div[title='profile'] {
        display: inline-block;
        margin: auto;
        margin-top: 75px;
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0px 0px 20px 3px #808080;
        padding: 20px;
    }
    </style>
        <center>
            <h1>$first $last</h1><br>
            <h2>@$username</h2>
            <h2>Email: $email</h2>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPaymentModal">Add Payment</button>
        </center>
    
    <div id="addPaymentModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Payment</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="text" name="first" placeholder="Name On Card">
                    <input type="text" name="last" placeholder="Card Number">
                    <input type="text" name="username" placeholder="CVV">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    _END;
?>