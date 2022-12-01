<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <select id="mailservertype">
        <option>IMAP</option>
        <option>POP</option>
    </select>
    <br>
    <select id="IncomingSeverEncryptionMethod">
        <option>SSL/TLS</option>
        <option>AUTO</option>
        <option value="STARTTLS">STARTTLS</option>
        <option>NONE</option>
    </select>

    <?php

    $hello = 'Hello';

    ?>

    <script type="text/javascript">
        var showTest = "<?php echo $hello; ?>";
        alert(showTest);

        $('#mailservertype').on('change', function() {
            var servertype = $('#mailservertype').find(":selected").text();

            if (servertype == "POP") {

                $('#IncomingSeverEncryptionMethod > :nth-child(2)').hide();
                $('#IncomingSeverEncryptionMethod > :nth-child(3)').hide();
            } else {
                $('#IncomingSeverEncryptionMethod > :nth-child(2)').show();
                $('#IncomingSeverEncryptionMethod > :nth-child(3)').show();

            }

        });
    </script>
</body>

</html>