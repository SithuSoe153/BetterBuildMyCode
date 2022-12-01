<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <select id="categoryType">
        <option>IMAP</option>
        <option>POP</option>
    </select>
    <br>
    <select id="productType">
        <option>SSL/TLS</option>
        <option>AUTO</option>
        <option value="STARTTLS">STARTTLS</option>
        <option>NONE</option>
    </select>

    <?php

    $hello = 'POP';

    ?>

    <script type="text/javascript">
        var showTest = "<?php echo $hello; ?>";
        alert(showTest);

        $('#categoryType').on('change', function() {
            var servertype = $('#categoryType').find(":selected").text();

            if (servertype == "<?php echo $hello; ?>") {

                $('#productType > :nth-child(2)').hide();
                $('#productType > :nth-child(3)').hide();
            } else {
                $('#productType > :nth-child(2)').show();
                $('#productType > :nth-child(3)').show();

            }

        });
    </script>
</body>

</html>