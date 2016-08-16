<?php 
//  See comments below (right above the form). 

	if ($mode == "submit") { 
		if ($enable_html != "on") { 
			/* 
			The user does not want to send the e-mail in HTML format, so we must get 
			rid of the HTML in the message. 
			*/ 
			$mail_body = htmlspecialchars ($mail_body); 
		} 

		//  Now we set the headers for our e-mail message. 

		$headers .= "MIME-Version: 1.0 \n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1 \n"; 
		$headers .= "from:$mail_from\r\nCc:$mail_cc\r\nBcc:$mail_bcc"; 

		/* 
		Now it's time to send the message, we'll use the mail () function. 
		The function will return TRUE on success, FALSE on failure. 
		We can use that to make sure the e-mail was sent without 
		any problems. 
		The "@" in front of the function is optional.  In PHP, whenever 
		there is an @ in front of ANY function, the script will not show 
		any errors.  As we will let the user know if anything goes wrong 
		ourselves, we don't need PHP to give the errors for us and we can 
		show the error however we want (not with Warning: ... on line ...). 
		*/ 

		if (@mail ($mail_to, $mail_subject, $mail_body, $headers)) { 
			print ("<h1><font color=\"#004000\">The e-mail was sent successfully!</font></h1>"); 
		} else { 
			print ("<h1><font color=\"#880000\">An error occurred while sending the e-mail!</font></h1>"); 
		} 

		//  We don't need to show the form again. 

		exit;
	} 
?> 

<html> 

<head> 
<title>Send e-mail</title> 
<script language="javascript"> 
	function DoSubmit () 
	{ 
	/* 
	This javascript will check if the important fields have been filled in. 
	The control is pretty basic (if the user types " " it will see it as full, 
	but it is enough to alert a person who forgot to fill out a form, without 
	him / her having to wait until the form refreshes (good for slow modems). 

	The return ""; command will exit the function, so that the form is only 
	submitted when it is valid. 
	*/ 

	if (document.form.mail_from.value == "") { 
		alert ("You forgot to enter the 'from' field."); 
		document.form.mail_from.focus (); 
		return ""; 
	} 

	if (document.form.mail_to.value == "") { 
		alert ("You forgot to enter the 'to' field."); 
		document.form.mail_to.focus (); 
		return ""; 
	} 

	if (document.form.mail_subject.value == "") { 
		alert ("You forgot to enter the 'subject' field."); 
		document.form.mail_subject.focus (); 
		return ""; 
	} 

	if (document.form.mail_body.value == "") { 
		alert ("You forgot to enter the 'body' field."); 
		document.form.mail_body.focus (); 
		return ""; 
	} 

	document.form.submit (); 
	} 
</script> 
</head> 

<body> 
<!-- 
	By setting the form's action to $PHP_SELF, this code will work even 
	when you change the name from email.php into whatever you want (.php). 

	The included (hidden) field, mode, will be used to see if the user has 
	submitted the form or if the page is loading for the first time.  If the 
	user has submitted the page, the variable $mode will have the string 
	"submit" as its value, otherwise the variable will be empty. 
--> 
<form action="<?php print ($PHP_SELF); ?>" method="post" name="form"> 
  <table> 
	<tr> 
		<td>From:</td> 
		<td><input type="text" name="mail_from" size="40"></td> 
	</tr> 
	<tr> 
		<td>To:</td> 
		<td><input type="text" name="mail_to" size="40"></td> 
	</tr> 
	<tr> 
		<td>Cc:</td> 
		<td><input type="text" name="mail_cc" size="40"></td> 
	</tr> 
	<tr> 
		<td>Bcc:</td> 
		<td><input type="text" name="mail_bcc" size="40"></td> 
	</tr> 
	<tr> 
		<td>Subject:</td> 
		<td><input type="text" name="mail_subject" size="40"></td> 
	</tr> 
	<tr> 
		<td valign="top">Body:</td> 
		<td><textarea name="mail_body" cols="40" rows="10"></textarea></td> 
	</tr> 
	<tr> 
		<td></td> 
		<td><input type="checkbox" name="enable_html"> enable HTML in this message.</td> 
	</tr> 
	<tr> 
		<td><input type="hidden" name="mode" value="submit"></td> 
		<td><input type="button" onclick="DoSubmit ()" value="Send e-mail"></td> 
	</tr> 
  </table> 
</form> 

</body> 
</html> 