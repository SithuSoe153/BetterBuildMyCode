<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="html2canvas.js"></script>
</head>

<body id="capture">

    <div>

        <h1>Sithu is </h1>
        <h2>Trying to screenshot the screen</h2>
        <h2>Ha Haa Done!</h2>
    </div>


    <script>
        function doCapture() {
            window.scrollTo(0, 0);

            html2canvas(document.getElementById("capture")).then(function(canvas) {
                console.log(canvas.toDataURL("image/jpeg", 0.9));

                var ajax = new XMLHttpRequest();


                ajax.open("POST", "save-capture.php", true);


                ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


                ajax.send("imagesave=" + canvas.toDataURL("image/jpeg", 0.9));

                ajax.onreadystatechange = function() {

                    if (this.readyState == 4 && this.status == 200) {

                        console.log(this.responseText);
                    }
                };

            });
        }
    </script>

    <button onclick="doCapture();">Capture</button>

</body>

</html>