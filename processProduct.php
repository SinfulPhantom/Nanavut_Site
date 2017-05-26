<?php

$id = $_GET["id_no"];
$desc = $_GET["desc"];
$image = $_GET["image"];

$config = parse_ini_file('config.ini');
$conn = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT item_name, price, inventory from product WHERE item_no='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo "
<!DOCTYPE html>
<html>
<head>
    <title>".$row['item_name']."</title>
	<meta charset='utf-8' />
    <style>
	body {
       background-color: #ffcc99;
    }

    h1 {
        text-align: center;
    }

    .box {
        float: left;
        margin: 10px;
        width: 175px;
        height: 175px;
        border-style: solid;
        text-align: center;
        overflow: auto;
    }
    .wrapper {
        width: 410px;
        height: auto;
        margin: auto;
    }

    .productimage {
        max-height: 100%;
        max-width: 100%;
        text-align: center;
    }

    #productdesc {
        font-family: 'Lucida Calligraphy';
        font-size: large;
        text-align: center;
        color: darkred;
    }

    #productcost {
		font-size: large;
		text-align: center;
		font-weight: bold;
		font-style: italic;
	}
	</style>
    <script type='text/javascript' src='Functions.js'></script>
</head>

<body onload='checkInventory()'>
    <h1>".$row['item_name']."</h1>
    <div class='productimage'>
        <img src='$image'/>
    </div>

    <div id='productdesc'>
        <br /> $desc <br /> <br />
    </div>

    <div id='productcost'>
        Price: ".$row['price']."<br />
        <form name='productForm'>
            Quantity: <input type='text' name='qty' id='qty' value='0' onchange='getQty()' /> <br />
                <div id = 'addtocart'></div>
                <input type='hidden' name='id_no' value='$id' />
                <input type='hidden' name='desc' value='$desc' />
                <input type='hidden' name='image' value='$image'/>
        </form>

        <div id = 'invstatus'></div>

        <a href ='store_index.html'>Continue Shopping</a>
    </div>
</body>
</html>
";
?>

<script type="text/javascript">
    var id = <?php echo json_encode($id); ?>;
    var name = <?php echo json_encode($row['item_name']); ?>;
    var q = <?php echo json_encode($row['inventory']); ?>;
    var qty = 0;
    id = id.trim(); //Trim extra space off of the id
    
    //Get the requested quantity in form field
    function getQty() {
        qty = document.getElementById('qty').value;
        if (+qty > +q) {
            alert("Only " + q + " " + name + " are left in stock!");
        }
        else
         updateButton();
    }

    //Update the button with the correct URL
    function updateButton() {
        var str = "id_no=" + id + "&qty=" + qty;
        document.getElementById('invstatus').innerHTML = "<input type='image' src='home/BuyNow.png' onclick=window.location='buynow.php?"+str+"' /> ";
    }

    //Check current inventory of product
    function checkInventory() {
        if (q <= 0) {
            document.getElementById('invstatus').innerHTML = "Out of Stock";
        }
        else {
            document.getElementById('addtocart').innerHTML = "<input type='image' src='atc1.bmp' onclick='addToCart("+id+")' />";
            updateButton();
        }
    }
</script>