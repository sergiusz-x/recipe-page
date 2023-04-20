<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <title>Przepisy kulinarne</title>
    
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/main.css">

    
    <style>
        canvas {
            text-align: center;
            margin-top: 100px;
            margin-left: 100px;
        }
    </style>
</head>
<body>
    <nav class="navbar-center">
        <a href="index.php">
            <div class="navbar-logo">
                <img src="../images/logo.png" alt="Logo strony">
                <p>PRZEPISY KULINARNE</p>
            </div>
        </a>
	</nav>
    <main>
        <canvas id="canvas" style="border: 1px solid" width="600" height="600"></canvas>
    </main>
    <script>
        const szerokosc_canvas = 600
        const wysokosc_canvas = 600
        //
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");
        //
        let _image_trzepaczka = new Image();
        let _image_walek = new Image();
        let image_trzepaczka, image_walek
        _image_trzepaczka.src = "../images/logo_trzepaczka.svg";
        _image_walek.src = "../images/logo_walek.svg";
        //
        _image_trzepaczka.onload = function(){
            image_trzepaczka = this
            //
            _image_walek.onload = function(){
                image_walek = this
                
            }
            //
        }
        const image = new Image();
        image.src = "../images/logo.png";
        image.onload = function() {
            // ctx.drawImage(this, 0, 0, 1000, 1000, 0, 0, szerokosc_canvas, wysokosc_canvas)
            start()
        }
        //
        //
        function start() {
            ctx.drawImage(image_walek, 0, 0, 1000, 1000, 67, 54, szerokosc_canvas, wysokosc_canvas);
            //
            
            //
            ctx.drawImage(image_trzepaczka, 0, 0, 1000, 1000, 0, 0, szerokosc_canvas, wysokosc_canvas);
        }
    </script>
</body>
</html>