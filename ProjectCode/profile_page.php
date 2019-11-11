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
    _END;
?>