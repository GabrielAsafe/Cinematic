<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bilhete de Cinema</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ticket {
            max-width: 600px;
            margin: 30px auto;
            border: 1px dashed #333;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .ticket-header {
            text-align: center;
            border-bottom: 1px dashed #333;
            margin-bottom: 20px;
        }
        .ticket-details p {
            margin: 5px 0;
        }
        .ticket-details strong {
            display: inline-block;
            width: 150px;
        }
    </style>
</head>
<body>
<div class="ticket">
    <div class="ticket-header">
        <h2>Validação da compra</h2>
    </div>
    <div class="ticket-details">
        <img src="{{asset("storage/fotos/".$user->foto_url)}}" alt="(Avatar)" class="bg-dark rounded-circle mr-3" width="45" height="45">

        <p><strong>Nome:</strong> {{$user->name}}</p>



    </div>


</div>





<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



