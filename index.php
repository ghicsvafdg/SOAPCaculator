<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Caculator</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <h2 class="text-center">Simple SOAP Caculator</h2>
        <br>
        <div class="content">
            <!-- the interface -->
            <form action="index.php" method="post">
                <table class="table-bordered table-hover">
                    <tr>
                        <td>
                            <label>Enter first number: </label>
                        </td>
                        <td>
                            <input type="text" name="x" pattern="^\d+(\.\d{1,15})?$" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Enter second number: </label>
                        </td>
                        <td>
                            <input type="text" name="y" pattern="^\d+(\.\d{1,15})?$" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Choose caculation method: </label>
                        </td>
                        <td>
                            <input type="radio" name="z" value="1" checked="checked"> summation
                            <input type="radio" name="z" value="2"> subtraction
                            <input type="radio" name="z" value="3"> multiplication
                            <input type="radio" name="z" value="4"> division
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary">Caculate</button>
                        </td>   
                    </tr>
                </table>
            </form>
            <br>
            <!-- get data to caculate -->
            <?php
                if(isset($_POST['x'])||isset($_POST['y'])||isset($_POST['z']))
                {
                    require_once ('lib/nusoap.php');
                    //Give it value at parameter
                    $x = $_POST['x'];
                    $y = $_POST['y'];
                    $z = $_POST['z'];
                    
                    $param = array( 'x' => $x,
                                    'y' => $y,
                                    'z' => $z);
                    //Create object that referer a web services
                    $client = new soapclient('http://localhost/WebServiceSOAP/caculator-with-soap/server.php');
                    //Call a function at server and send parameters too
                    $result = $client->call('caculate',$param);
                    //Process result
                    if($client->fault)
                    {
                        echo "FAULT: <p>Code: (".$client->faultcode."</p>";
                        echo "String: ".$client->faultstring;
                    }
                    else
                    {
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            The result of <?php echo '<strong>'.$x.'</strong>'; ?> 
                                <?php 
                                    if($z == 1)
                                    {
                                        echo '+';
                                    }elseif($z == 2)
                                    {
                                        echo '-';
                                    }elseif($z == 3)
                                    {
                                        echo '*';
                                    }elseif($z == 4)

                                    {
                                        echo '/';
                                    }
                                ?>
                                <?php echo '<strong>'.$y.'</strong>'; ?> is: <?php echo $result; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </body>
</html>


