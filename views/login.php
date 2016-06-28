<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
body{
	background-color:#f0f8eb;	
}
.kotak {
	color:#063;
	font-weight:bold;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	position: absolute;
	border:1px solid #4c8a33;
	width:300px;
	height: auto;
	left:50%;
	top:50%;
	margin-left:-171px;
    margin-top: -150px;
    border-radius: 2px;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	-webkit-box-shadow:  0px 0px 1px 1px rgba(0, 0, 0, 0.1);
	-moz-box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
    box-shadow:  0px 0px 1px 1px rgba(0, 0, 0, 0.1);
    background: #fefefe;
	background-image:-webkit-radial-gradient(top, #93ce7b, #ffffff);
    padding:0px 20px 0 20px;
}

.kotak:after,.kotak:before {
	background: #f9f9f9;
	background: -moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(249,249,249,1) 100%);
	background: -webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	background: -o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	background: -ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	background: linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);

	border: 1px solid #4c8a33;
	content: "";
	display: block;
	height: 100%;
	left: -1px;
	position: absolute;
	width: 100%;
}
.kotak:after {
	-webkit-transform: rotate(3deg);
	-moz-transform: rotate(3deg);
	-ms-transform: rotate(3deg);
	-o-transform: rotate(3deg);
	transform: rotate(3deg);
	top: 0;
	z-index: -1;
}
.kotak:before {
	-webkit-transform: rotate(-5deg);
	-moz-transform: rotate(-5deg);
	-ms-transform: rotate(-5deg);
	-o-transform: rotate(-5deg);
	transform: rotate(-5deg);
	top: 0;
	z-index: -2;
}

#logo{
	top: -65px;
	position: absolute;
	width: 290px;
	height: 56px;
}
/* form */
.navigasi-button{
	margin-top:10px;
	padding:5px;
	border-right:10px solid transparent;
	border-left: 10px solid transparent; 
	border-top:2px solid #69b05b;
	text-align:right; 
	
	
}
.content-form{
	-webkit-box-shadow: #26700f 0 1px 0 0 outset;
	-moz-box-shadow: #26700f 0 1px 0 0 outset;
	box-shadow: #26700f 0 1px 0 0 outset;
	border: 1px solid #358f19;
	box-sizing: border-box;
	-moz-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	border-bottom-left-radius: 5px;
	-moz-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	border-bottom-right-radius: 5px;
	padding:10px 20px;
	color:#000;
}
input[type='text'],input[type='password'],select,textarea{font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
color:#063;
width:220px;
	-webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    border:solid 1px #5bb738;
	padding:5px;
	background-image:-webkit-linear-gradient(top, #ffffff, #efffe9);
		background: -moz-linear-gradient(#ffffff,#efffe9);
	background: -o-linear-gradient(#ffffff,#efffe9);
	background: linear-gradient(#ffffff,#efffe9);	
}

input[type='text']:hover,input[type='password']:hover,select:hover,textarea:hover,input[type='text']:focus,select:focus,textarea:focus{
    border:solid 1px #379413;
	background-image:-webkit-linear-gradient(top, #d5efca, #ffffff);
	background: -moz-linear-gradient(#d5efca,#ffffff);
	background: -o-linear-gradient(#d5efca,#ffffff);
	background: linear-gradient(#d5efca,#ffffff);	
}
input[type='button'],input[type='reset'],input[type='submit']{
color: #ffffff;
text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.35);
background-color: #6b9b20;
background-image: -webkit-linear-gradient(top, #5f9f2a, #6b9b20);
	background: -moz-linear-gradient(#5f9f2a,#6b9b20);
	background: -o-linear-gradient(#5f9f2a,#6b9b20);
	background: linear-gradient(#5f9f2a,#6b9b20);	
background-repeat: repeat-x;
border-color: #338317 #338317 #01ae3a;
font-size: 14px;
font-weight: bold;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
display: inline-block;
padding: 7px 20px;
margin-bottom: 0;
cursor:pointer;
margin-left:5px;

}

input[type='submit']:hover,input[type='reset']:hover,input[type='button']:hover,.tombols:hover{
	color: #FFFFFF;
	
background-image: -webkit-linear-gradient(top, #91e64a, #6b9b20);
	background: -moz-linear-gradient(#91e64a,#6b9b20);
	background: -o-linear-gradient(#91e64a,#6b9b20);
	background: linear-gradient(#91e64a,#6b9b20);	
background-repeat:repeat;
text-decoration: none;
background-position: 0 30px;
-webkit-transition: background-position 0.1s linear;
-moz-transition: background-position 0.1s linear;
-o-transition: background-position 0.1s linear;
transition: background-position 0.1s linear;
	}
.navigasi-button1 {	margin-top:10px;
	padding:5px;
	border-right:10px solid transparent;
	border-left: 10px solid transparent; 
	border-top:2px solid #69b05b;
	text-align:right; 
	background-image:-webkit-linear-gradient(top, #f3fdef, #ffffff);
			background: -moz-linear-gradient(#f3fdef,#ffffff);
	background: -o-linear-gradient(#f3fdef,#ffffff);
	background: linear-gradient(#f3fdef,#ffffff);
}
</style>
</head>

<body>
 <div class="container-fluid">
<div class="kotak">
<div id="logo">
<img src="<?php echo X ?>public/images/werwer.png">
</div>
<form method="post" action="<?php echo X ?>login/logon">
	<table width="299" height="196" border="0">
		<tr>
		    <td width="69">&nbsp;</td>
		    <td width="178">&nbsp;</td>
		    <td width="38">&nbsp;</td>
		</tr>
		<tr>
		    <td>Username</td>
		    <td>:</td>
		    <td>&nbsp;</td>
		</tr>
		<tr>
		    <td colspan="3"><input type="text" name="username" /></td>
		</tr>
		<tr>
		    <td>Password</td>
		    <td>:</td>
		    <td>&nbsp;</td>
		</tr>
		<tr>
		    <td colspan="3"><input type="password" name="password" /></td>
		</tr>
		 <tr>
		    <td height="21" colspan="3">
		    	<div class="navigasi-button"><input type="submit" name="button" id="button" value="Login" /></div>
	    	</td>
	    </tr>
		<tr>
		    <td width="69">&nbsp;</td>
		    <td width="178">&nbsp;</td>
		    <td width="38">&nbsp;</td>
		</tr>
	</table>
</form>


</div></div>

</body>
</html>