<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rave payment Gateway</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="redirect_design.css">
    </head>
    <body>
        <form action="pay.php" method="POST">

        <label>Email</label>
        <input type="email" name="email" placeholder="email">
        <br>
        <label>Amount</label>
        <input type="number" name="amount" placeholder="amount">
        <br>
        <input type="submit" name="pay" value="Send Payment">

        </form>
    </body>
</html>