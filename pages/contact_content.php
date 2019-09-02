<div id="main_content" class="dfs">
	<h1 id="page_title">Contact Us</h1>
	<p>Please use the below form to contact us. If the form is broken, you can also email us at thechroniclerbot@gmail.com</p>
	<p>Anything marked with an asterisk (*) is required.</p>
	<form name="contactform" method="post" action="send_email_form.php">
		<table>
		<tr>
			<td>
				<label for="first_name">Name</label>
			</td>
			<td>
				<input  type="text" name="name" maxlength="50" size="30">
			</td>
		</tr>
		<tr>
			<td>
				<label for="email">Email Address *</label>
			</td>
			<td>
				<input  type="text" name="email" maxlength="80" size="30">
			</td>
		</tr>
		<tr>
			<td>
				<label for="category">Category *</label>
			</td>
			<td>
				<select name="category">
					<option value="issue">Issue</option>
					<option value="suggestion">Suggestion</option>
					<option value="comment">Comment</option>
					<option value="misc">Miscellaneous</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="subject">Subject</label>
			</td>
			<td>
				<input type="text" name="subject" maxlength="100" size="30">
			</td>
		</tr>
		<tr>
			<td>
				<label for="message">Message *</label>
			</td>
			<td>
				<textarea  name="message" maxlength="50" cols="50" rows="6"></textarea>
			</td>
		</tr>
		</table>
		<input style="margin-top:5px" type="submit" value="Send Message">
		</form>
</div>