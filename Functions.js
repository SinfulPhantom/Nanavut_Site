var prices = [300, 250, 150, 150,
              1000, 500, 75, 400,
              1000, 500, 1500, 2500];

var images = ["boots1.jpg","boots2.jpg","slipper1.jpg","slipper2.jpg",
              "earing1.jpg","pendent4.jpg","hairclp1.jpg","pendent6.jpg",
              "dogsled1.jpg","craft5.jpg","craft7.jpg","pendent2.jpg"];

var names = ["Caribou Skin Boots", "Moose Boots", "Brown Rabbit Slippers", "Snow Rabbit Slippers",
                      "Earrings", "Necklace", "Hair Clip", "Pendant",
                      "Dog Sled", "Wood Carving 1", "Wood Carving 2", "Ivory Carving"];

var header = ["Catalog #", "Item", "Price", "Quantity", "Total"];

var request;
var validPass, validName, loginBool, lastBool;

function createForm() {
  document.getElementById("form").innerHTML =
    "Username(Must be at least 6 characters in length)<br/>" +
    "<input type = \"text\" id = \"createUsername\" onchange = \"validateUsername(false)\"></input><span id=\"spanUser\"></span><br/><br/>" +
    "Password(Must be at least 6 characters in length and have 1 number)<br/>" +
    "<input type= \"password\" id = \"createPassword\" onchange=\"validatePassword()\"></input><span id=\"spanPassword\"></span><br/><br/>" +
    "Re-Enter Password <br/>" +
    "<input type= \"password\" id = \"rePassword\" onchange=\"validatePassword()\"></input><span id=\"spanPassword2\"></span><br/><br/>" +
    "Email<br/>" +
    "<input type= \"text\" id = \"createEmail\" onchange=\"validateEmail()\"></input><span id=\"spanEmail\"></span><br/><br/>" +
    "<div id=\"button\"><button onClick=\"addToDatabase()\">CREATE ACCOUNT</button><span id=\"spanButton\"</span>";
}

function login(loginCheck) {
  request = new XMLHttpRequest();
  lastBool = loginCheck;

   var comp = "username";
   var data;

   request.span('POST', 'http://localhost:8090/login.php', true);
   request.setRequestHeader("Content-Type", "application/x-www.form-urlencoded");
   request.setRequestHeader("Content-Length", document.getElementById("username").value.length + document.getElementById("password").value.length);

   if (loginCheck) {
     data = comp + "=" + document.getElementById("username").value + "&password" + document.getElementById("password").value;
   } else {
     data = comp + "=" + document.getElementById("createUsername").value + "&password=" + document.getElementById("createPassword").value;
   }

   request.onreadystatechange = loginCallback;
   request.send(data);
}

function callback() {
  if (request.readyState == 4) {
    if (request.status == 200) {
      if (lastBool) {
        if (request.responseText == "true") {
          document.getElementById("user").innerHTML = "";
        } else {
          document.getElementById("user").innerHTML = "Invalid Username!";
        }
      } else {
        if (request.responseText == "true") {
          document.getElementById("spanUser").innerHTML = "Invalid Username!";
          validName = false;
        } else {
          document.getElementById("spanUser").innerHTML = "";
          validName = true;
        }
      }
    }
  }
}

function addToDatabase() {
  request = new XMLHttpRequest();
  request.open('POST', 'http://localhost:8090/addUser.php', true);
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.setRequestHeader("Content-Length", document.getElementById("createUsername").value.length + document.getElementById("createPassword").value.length) + document.getElementById("createEmail");

  var data = "username" + "=" + document.getElementById("createUsername").value + "&" +
  "password" + "=" + document.getElementById("createPassword").value + "&" +
  "email" + "=" + document.getElementById("createEmail").value;

  if (validateEmail && validName && validatePassword) {
    request.send(data);

    document.getElementById("button").innerHTML = "<button onclick=\"login(false)\">Login Now!</button><span id=\"spanButton\"</span>";
  } else {
    document.getElementById("spanButton").innerHTML = "One or more fields are incorrect!";
  }
}

function createAccountCallback() {
  if (request.readyState == 4) {
    if (request.status == 200) {
      document.getElementById("spanButton").innerHTML = request.responseText;
    }
  }
}

function validateUsername(loginBool) {
  request = new XMLHttpRequest();
  lastBool = loginBool;

   var comp = "username";
   var data;

   request.open('POST', 'http://localhost:8090/validateUsername.php', true);
   request.setRequestHeader("Content-Type", "application/x-www.form-urlencoded");

   if (loginBool) {
     request.setRequestHeader("Content-Length", document.getElementById("username").value.length);
     data = comp + "=" + document.getElementById("username").value;
   } else {
     request.setRequestHeader("Content-Length", document.getElementById("username").value.length);
     data = comp + "=" + document.getElementById("createUsername").value;
   }

   request.onreadystatechange = callback;
   request.send(data);
}

function validatePassword() {
  var password1 = document.getElementById("createPassword").value;
  var password2 = document.getElementById("rePassword").value;
  var regex = new RegExp(/\d/);

  if (password1.search(regex) != -1) {
    if (password1.length < 6 || password1.length > 16) {
      document.getElementById("spanPassword").innerHTML = "Invalid Password!";
      validPass = false;
    } else {
      document.getElementById("spanPassword").innerHTML = "";
      validPass = true;
    }
    if (password1 != password2) {
      document.getElementById("spanPassword2").innerHTML = "Passwords do not match!";
      validPass = false;
    } else {
      document.getElementById("spanPassword2").innerHTML = "";
    }
  } else {
    document.getElementById("spanPassword").innerHTML = "Invalid Password!";
    validPass = false;
  }
}

function validateEmail() {
  var email = document.getElementById("createEmail").value;

  if (email.indexOf('@') == -1) {
    document.getElementById("spanEmail").innerHTML = "Invalid Email!";
    validateEmail = false;
  } else {
    document.getElementById("spanEmail").innerHTML = "";
    validateEmail = true;
  }
}

function showSlides() {
	var i;
	var slides = document.getElementsByClassName("mySlides");
	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
	}
	slideIndex++;
	if (slideIndex> slides.length) {slideIndex = 1}
	slides[slideIndex-1].style.display = "block";
	setTimeout(showSlides, 3000); // Change image every 3 seconds
}

function addToCart(catNum) {
	var inner = document.getElementsByTagName("h1")[0].innerHTML;
	var quantity = document.getElementsByTagName("input")[0].value;

	if(window.confirm("Add " + inner + " to Cart?")) {
		if(document.cookie.length == 12) {
			window.alert("Cart is full!");
			window.location = "store_index.html";
			return;
		}

		document.cookie = catNum + "=" + quantity;

		window.location = "store_index.html";

		return;
	}
}

function buildCheckout() {
	if (document.cookie.length == 0) {
		alert("Empty Cart - Please Buy Something First");
	}
	var cookies = document.cookie.split(";");

    var splitCookies = new Array();
    var catNum = new Array();
    var quantity = new Array();

	var total = 0;

    for(var i = 0; i < cookies.length; i++) {
        splitCookies[i] = cookies[i].split("=");
    }

    for (var i = 0; i < splitCookies.length; i++) {
        catNum[i] = splitCookies[i][0];
        quantity[i] = splitCookies[i][1];
    }

	var table = document.createElement('TABLE');
	table.border = 1;
	table.align = "center";

	var head = document.createElement('THEAD');
    table.appendChild(head);

    var headRow = document.createElement('TR');
    head.appendChild(headRow);

    for(var t=0; t<5; t++)
    {
        var headCell = document.createElement('TD');
        headCell.style.textAlign = "center";
        headCell.appendChild(document.createTextNode(header[t]));
        headRow.appendChild(headCell);
    }

	for (var i=0; i<document.cookie.length; i++) { //document.cookie.length
       var tr = document.createElement('TR');
       table.appendChild(tr);

       index = parseInt(catNum[i]);

        if(cookies[i] == undefined)
        {
            break;
        }

        for (var j=0; j<5; j++) {
            var td = document.createElement('TD');
            td.width='75';
            td.style.textAlign = "center";

            if(j == 0)
            {
                //Catalog Number
                td.appendChild(document.createTextNode(index));
                tr.appendChild(td);
            }
            else if(j == 1)
            {
                //Name/Image/Remove Button
                td.appendChild(document.createTextNode(names[index]));

                var img = document.createElement("IMG");
                img.setAttribute("width", "80");
                img.setAttribute("height", "80");


                if(catNum[i]>=0 && catNum[i]<=3)
                {
                    img.setAttribute("src", "home\\res\\products\\footwear\\" + images[index]);
                }
                if(catNum[i]>=4 && catNum[i]<=7)
                {
                    img.setAttribute("src", "home\\res\\products\\jewelry\\" + images[index]);
                }
                if(catNum[i]>=8 && catNum[i]<=11)
                {
                    img.setAttribute("src", "home\\res\\products\\artsCrafts\\" + images[index]);
                }

                td.appendChild(img);

				// var b = document.createElement("BUTTON");
                // b.appendChild(document.createTextNode("Remove"));
                // b.setAttribute("onClick","removeCookie(this)");
                // td.appendChild(b);

                tr.appendChild(td);

            }
            else if(j == 2) {
                //Price
                td.appendChild(document.createTextNode("$" + prices[index]));
                tr.appendChild(td);
            }
            else if(j == 3) {
                //Quantity
                td.appendChild(document.createTextNode(quantity[i]));
                tr.appendChild(td);
            }
            else if(j == 4) {
                //Total
                total += quantity[i] * prices[index];

                td.appendChild(document.createTextNode("$" + quantity[i] * prices[index]));
                tr.appendChild(td);
            }
            else
                break;
        }
    }
	var footer = document.createElement('TFOOT');
    table.appendChild(footer);

    footer.style.textAlign = "center"

    var footRow = document.createElement('TR');
    footer.appendChild(footRow);


    for(var i = 0; i<5; i++)
    {
        var footCell = document.createElement('TD');
        if(i == 0)
        {
            footCell.appendChild(document.createTextNode("Total"));
            footRow.appendChild(footCell);
        }
        if(i == 4)
        {

            footCell.appendChild(document.createTextNode("$" + total));
            footRow.appendChild(footCell);
        }
        else
        {
            footCell.appendChild(document.createTextNode(""));
            footRow.appendChild(footCell);
        }
    }
	document.body.appendChild(table);
}

function buildCart()
{
	if (document.cookie.length == 0) {
		alert("Empty Cart - Please Buy Something First");
	}
	var cookies = document.cookie.split(";");

    var splitCookies = new Array();
    var catNum = new Array();
    var quantity = new Array();

	var total = 0;

    for(var i = 0; i < cookies.length; i++) {
        splitCookies[i] = cookies[i].split("=");
    }

    for (var i = 0; i < splitCookies.length; i++) {
        catNum[i] = splitCookies[i][0];
        quantity[i] = splitCookies[i][1];
    }

	var table = document.createElement('TABLE');
	table.border = 1;
	table.align = "center";

	var head = document.createElement('THEAD');
    table.appendChild(head);

    var headRow = document.createElement('TR');
    head.appendChild(headRow);

    for(var t=0; t<5; t++)
    {
        var headCell = document.createElement('TD');
        headCell.style.textAlign = "center";
        headCell.appendChild(document.createTextNode(header[t]));
        headRow.appendChild(headCell);
    }

	for (var i=0; i<document.cookie.length; i++) { //document.cookie.length
       var tr = document.createElement('TR');
       table.appendChild(tr);

       index = parseInt(catNum[i]);

        if(cookies[i] == undefined)
        {
            break;
        }

        for (var j=0; j<5; j++) {
            var td = document.createElement('TD');
            td.width='75';
            td.style.textAlign = "center";

            if(j == 0)
            {
                //Catalog Number
                td.appendChild(document.createTextNode(index));
                tr.appendChild(td);
            }
            else if(j == 1)
            {
                //Name/Image/Remove Button
                td.appendChild(document.createTextNode(names[index]));

                var img = document.createElement("IMG");
                img.setAttribute("width", "80");
                img.setAttribute("height", "80");


                if(catNum[i]>=0 && catNum[i]<=3)
                {
                    img.setAttribute("src", "home\\res\\products\\footwear\\" + images[index]);
                }
                if(catNum[i]>=4 && catNum[i]<=7)
                {
                    img.setAttribute("src", "home\\res\\products\\jewelry\\" + images[index]);
                }
                if(catNum[i]>=8 && catNum[i]<=11)
                {
                    img.setAttribute("src", "home\\res\\products\\artsCrafts\\" + images[index]);
                }

                td.appendChild(img);

				var b = document.createElement("BUTTON");
                b.appendChild(document.createTextNode("Remove"));
                b.setAttribute("onClick","removeCookie(this)");
                td.appendChild(b);

                tr.appendChild(td);

            }
            else if(j == 2) {
                //Price
                td.appendChild(document.createTextNode("$" + prices[index]));
                tr.appendChild(td);
            }
            else if(j == 3) {
                //Quantity
                td.appendChild(document.createTextNode(quantity[i]));
                tr.appendChild(td);
            }
            else if(j == 4) {
                //Total
                total += quantity[i] * prices[index];

                td.appendChild(document.createTextNode("$" + quantity[i] * prices[index]));
                tr.appendChild(td);
            }
            else
                break;
        }
    }
	var footer = document.createElement('TFOOT');
    table.appendChild(footer);

    footer.style.textAlign = "center"

    var footRow = document.createElement('TR');
    footer.appendChild(footRow);


    for(var i = 0; i<5; i++)
    {
        var footCell = document.createElement('TD');
        if(i == 0)
        {
            footCell.appendChild(document.createTextNode("Total"));
            footRow.appendChild(footCell);
        }
        if(i == 4)
        {

            footCell.appendChild(document.createTextNode("$" + total));
            footRow.appendChild(footCell);
        }
        else
        {
            footCell.appendChild(document.createTextNode(""));
            footRow.appendChild(footCell);
        }
    }
	document.body.appendChild(table);
}

function removeCookie(t) {
	if(window.confirm("Delete This From Shopping Cart?")) {
		document.cookie = i.id + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
		location.reload;
	}
}

function checkCC() {
	var cc = document.getElementById("creditCard").value;
    for (var i=0; i<cc.length; i++) {
		if (cc[i] %2 == 0) {
			sum = sum + (cc[i] * 2);
		}
		else
			sum = sum + cc[i];
	}
	if (sum%10 != 0) {
		window.alert("Invalid Credit Card Information");
	}
}
