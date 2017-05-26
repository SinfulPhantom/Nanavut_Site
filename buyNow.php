<?php
$id = $_GET["id_no"];
$qty = $_GET['qty'];

echo "
<!DOCTYPE html>
<html xmlns='http://w3.org/1999/xhtml'>
<head>
    <title>Checkout</title>
    <style type='text/css'>
        body {
            background-color: lightblue;
            margin: 0;
            padding: 0;
        }

        form {
            width: 400px;
            margin: 0 auto;
        }
    </style>
	<script type='text/javascript' src='Functions.js'></script>
</head>
<h1 align='center'>
    <b>Enter Customer Info Below</b>
</h1>
<body>
<div>
	<h3 align='center'>Shopping Cart</h3>
	<script type='text/javascript'>
		buildCheckout();
	</script>
</div>
<form action='buynow.php?id_no=$id&qty=$qty' method='POST'>
	<div style='padding-top:20px;'>
    <table align='center'>
        <tr>
            <td>
                Full Name:
            </td>
            <td>
                <input type='text' maxlength='30' pattern='[A-Za-z]'
                       name='fullName' size='25' required='required' autofocused='autofocused' />
            </td>
        </tr>
        <tr>
            <td>
                Password:
            </td>
            <td>
                <input type='password' maxlength='30'
                       name='pass' size='25' required='required' />
            </td>
        </tr>
        <tr>
            <td>
                Email:
            </td>
            <td>
                <input type='email' maxlength='50' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$'
                       name='email' size='25' required='required' />
            </td>
        </tr>
        <tr>
            <td>
                Address 1:
            </td>
            <td>
                <input type='text' maxlength='50'
                       name='address1' size='25' required='required' />
            </td>
        </tr>
        <tr>
            <td>
                Address 2:
            </td>
            <td>
                <input type='text' maxlength='50'
                       name='address2' size='25' />
            </td>
        </tr>
        <tr>
            <td>
                City:
            </td>
            <td>
                <input type='text' maxlength='25'
                       name='city' size='25' required='required' />
            </td>
        </tr>
        <tr>
            <td>
                State:
            </td>
            <td>
                <input type='text' maxlength='3'
                       name='state' size='2' required='required' />
            </td>
        </tr>
        <tr>
            <td>
                ZIP:
            </td>
            <td>
                <input type='text' maxlength='5' pattern = '[0-9]{5}'
                       name='zipCode' size='5' required='required' />
            </td>
        </tr>
        <tr>
            <td>
                Country:
            </td>
            <td>
                <input type='text' maxlength='25'
                       name='country' size='25' required='required' />
            </td>
        </tr>
        <tr>
            <td>
                Phone:
            </td>
            <td>
                <input type='text' maxlength='10' pattern = '[0-9]{10}'
                       name='phone' size='25' required='required ' /><br />
            </td>
        </tr>
        <tr>
            <td>
                Fax:
            </td>
            <td>
                <input type='text' maxlength='10' name='fax' size='25' pattern = '[0-9]{10}' /><br />
            </td>
        </tr>
        <tr>
            <td align='right'>
                <input type='checkbox'
                       name='mailing' align='center' />
            </td>
            <td>
                Check here to be added the mailing list.
            </td>
        </tr>
    </table>
	</div>

	<div style='position:relative;'>
    <h3 align='center'>Enter Credit Card Information Below</h3>
    <table align='center'>
        <tr>
            <td>
                <label>
                    <input type='radio' name='mc' />
					<img src='home/res/checkout/mc.jpg' alt='' height='25' width='30'
                        align='center' required='required' /> 
					Master Card
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type='radio' name='visa' />
					<img src='home/res/checkout/visa.jpg' alt='' height='25' width='30'
                        align='center' required='required' />
					VISA
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type='radio' name='amex' />
					<img src='home/res/checkout/amex.jpg' alt='' height='25' width='30'
                        align='center' required='required' />
					American Express
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>
                    <input type='radio' name='discover' />
					<img src='home/res/checkout/discover.jpg' alt='' height='25' width='30'
                        align='center' required='required' />
					Discover
                </label>
            </td>
        </tr>
    </table>
	</div>
	
	<div style='position:relative;'>
    <h3 align='center'>Enter Card Number and Expiration</h3>
    <table align='center'>
        <tr>
            <td>
                Credit Card #: <input type='text' maxlength='30' name='cc_no' 
				id = 'creditCard' pattern = '[0-9]{16}' onchange = 'checkCC();' 
				size='25' required='required'/>
            </td>
        </tr>

        <tr>
            <td>
                Enter Expiration Month:<select name='expMonth'>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                </select>
                Year:<select name='expYear'>
                    <option>2017</option>
                    <option>2018</option>
                    <option>2019</option>
                    <option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                </select>
            </td>
        </tr>
    </table><br /><br />
	</div>
	
	<div style='position:relative;'>
    <table align='center'>
        <tr>
            <td>
                <input type='submit' value='Buy Now!' name='buy_button' />
            </td>
            <td>
                <input type='reset' value='RESET' name='reset' align='left' />
            </td>
        </tr>
    </table>
	<p style='padding-top:20px;' align='center'>
        <a href=store_index.html>Return to Previous</a>
    </p>
	</div>
</form>
</body>
</html>
";

if( $_POST )
{
    $users_fname = $_POST['name_first'];
    $users_lname = $_POST['name_last'];
    $users_email = $_POST['email'];
    $users_address1 = $_POST['address1'];
    $users_address2 = $_POST['address2'];
    $users_city = $_POST['city'];
    $users_state = $_POST['state'];
    $users_zip = $_POST['zip'];
    $users_country = $_POST['country'];
    $users_phone = $_POST['phone'];
    $users_fax = $_POST['fax'];
    $users_ccno = $_POST['cc_no'];
    $users_expmo = $_POST['expMonth'];
    $users_expyr = $_POST['expYear'];
    $users_maillist = isset($_POST['maillist']) && $_POST['maillist']  ? "1" : "0";

    //Read config file and create a connection to the database
    $config = parse_ini_file('config.ini');
    $conn = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Insert data into customer table
    $sql = "INSERT INTO customer(cc_no, exp_mo, exp_yr, name_first, name_last, email, address1, address2, city, state, zip, country, phone, fax, mail_list)
            VALUES('$users_ccno', '$users_expmo', '$users_expyr', '$users_fname', '$users_lname', '$users_email', '$users_address1', '$users_address2', '$users_city',
            '$users_state', '$users_zip', '$users_country', '$users_phone', '$users_fax', '$users_maillist')";

    //Insert data into order table
    $sql2 = "INSERT INTO orders(quantity, date_sold, item_no, cc_no) VALUES ('$qty', now(), '$id', '$users_ccno')";

    //Update the inventory of the product
    $sql3 = "UPDATE product SET inventory=inventory-$qty WHERE item_no=$id";

    //Execute the queries
    if ($conn->query($sql) === TRUE && $conn->query($sql2) == TRUE && $conn->query($sql3) == TRUE) {
        echo "<h1>New order created successfully</h1>";
    } else {
        echo $conn->error;
    }

    //Close connection
    $conn->close();
}

?>


<script type="text/javascript">
    var id = <?php echo json_encode($id); ?>;
    var q = <?php echo json_encode($qty); ?>;
    var quantity = q;
    var productID = id;
    var productCost;
    var productTotal;

    function setImage(id)
    {
        if (id == '1')
            var imgstring = "<img src='images/products/footwear/boots1.jpg' style='width:128px;height:128px'/>"
        else if (id == "2")
            var imgstring = "<img src='images/products/footwear/slipper1.jpg' style='width:128px;height:128px'/>"
        else if (id == "8")
            var imgstring = "<img src='images/products/artsCrafts/dogsled1.jpg' style='width:128px;height:128px'/>"
        else if (id == "4")
            var imgstring = "<img src='images/products/jewelry/earring1.jpg' style='width:128px;height:128px'/>"
        else if (id == "6")
            var imgstring = "<img src='images/products/jewelry/hairclp1.jpg' style='width:128px;height:128px'/>"
        else if (id == "11")
            var imgstring = "<img src='images/products/artsCrafts/pendant2.jpg' style='width:128px;height:128px'/>"
        else if (id == "0")
            var imgstring = "<img src='images/products/footwear/boots2.jpg' style='width:128px;height:128px'/>"
        else if (id == "5")
            var imgstring = "<img src='images/products/jewelry/pendant4.jpg' style='width:128px;height:128px'/>"
        else if (id == "7")
            var imgstring = "<img src='images/products/jewelry/pendant6.jpg' style='width:128px;height:128px'/>"
        else if (id == "3")
            var imgstring = "<img src='images/products/footwear/slipper2.jpg' style='width:128px;height:128px'/>"
        else if (id == "9")
            var imgstring = "<img src='images/products/artsCrafts/craft5.jpg' style='width:128px;height:128px'/>"
        else if (id == "10")
            var imgstring = "<img src='images/products/artsCrafts/craft7.jpg' style='width:128px;height:128px'/>"

        return imgstring;
    }
   
    if (productID == "1") {
        productName = "Caribou Boots";
        productCost = 300;
        productTotal = productCost * quantity;
    }
    else if (productID == "2") {
        productName = "Brown Rabbit Slippers";
        productCost = 150;
        productTotal = productCost * quantity;
    }
    else if (productID == "8") {
        productName = "Dog Sled";
        productCost = 1000;
        productTotal = productCost * quantity;
    }
    else if (productID == "4") {
        productName = "Earring";
        productCost = 1000;
        productTotal = productCost * quantity;
    }
    else if (productID == "6") {
        productName = "Hairclip";
        productCost = 75;
        productTotal = productCost * quantity;
    }
    else if (productID == "11") {
        productName = "Ivory Carving";
        productCost = 2500;
        productTotal = productCost * quantity;
    }
    else if (productID == "0") {
        productName = "Moose Boots";
        productCost = 250;
        productTotal = productCost * quantity;
    }
    else if (productID == "5") {
        productName = "Necklace";
        productCost = 500;
        productTotal = productCost * quantity;
    }
    else if (productID == "7") {
        productName = "Pendant";
        productCost = 400;
        productTotal = productCost * quantity;
    }
    else if (productID == "3") {
        productName = "Snow Rabbit Boots";
        productCost = 150;
        productTotal = productCost * quantity;
    }
    else if (productID == "9") {
        productName = "Wood Carving 1";
        productCost = 500;
        productTotal = productCost * quantity;
    }
    else if (productID == "10") {
        productName = "Wood Carving 2";
        productCost = 1500;
        productTotal = productCost * quantity;
    }

    var image = setImage(productID);

    document.getElementById('purchaseditemdiv').innerHTML = "<h2>" + productName + "</h2><br />";
    document.getElementById('purchaseditemdiv').innerHTML += image;
    document.getElementById('purchaseditemdiv').innerHTML += "<h3>Quantity: " + quantity + "</h3><br />";
    document.getElementById('purchaseditemdiv').innerHTML += "<h3>Individual Cost: " + productCost + "</h3><br />";
    document.getElementById('purchaseditemdiv').innerHTML += "<h3>Total: " + productTotal + "</h3><br />";

</script>
