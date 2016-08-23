<html>
    <head>
        <meta>
        <title>Guarani</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Le styles -->
        <link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
        <link href="css/bootstrap-theme.min.css" media="screen" rel="stylesheet" type="text/css">
        <link href="css/style.css" media="screen" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootbox.js"></script>        
    </head>

<a href="traducir.php">Traductor iframe</a>
<br><br>

<a href="traducir-full.php">Traductor Full</a>
    


<script>

    $.ajax({
        //url: "http://localhost/guarani/ws.php"
        url: "http://localhost/guarani/ws.php?method=buscar&palabra=abajo&traducira=gu"
    }).then(function(data) {
        
        var palabra2 = data.palabra2;
        alert("content es: *"+palabra2+"*");

    });

</script>

</html>