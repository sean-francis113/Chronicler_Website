<div id="main_content" class="dfs">
	<h1 id="page_title">Contact Us</h1>
	<p>Please use the below form to contact us. We accept and appreciate all forms of criticism, complaint, suggestion and comment.</p>
	<p>Anything marked with an asterisk (*) is required.</p>
	<form name="contactform" method="post" action="send_email_form.php">
		<table>
		<tr>
			<td valign="top">
				<label for="first_name">Name</label>
			</td>
			<td valign="top">
				<input  type="text" name="name" maxlength="50" size="30">
			</td>
		</tr>
		<tr>
			<td valign="top">
				<label for="email">Email Address *</label>
			</td>
			<td valign="top">
				<input  type="text" name="email" maxlength="80" size="30">
			</td>
		</tr>
		<tr>
			<td valign="top">
				<label for="category">Category *</label>
			</td>
			<td valign="top">
				<select name="category">
					<option value="issue">Issue</option>
					<option value="suggestion">Suggestion</option>
					<option value="comment">Comment</option>
					<option value="misc">Miscellaneous</option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<label for="subject">Subject *</label>
			</td>
			<td valign="top">
				<input type="text" name="subject" maxlength="100" size="30">
			</td>
		</tr>
		<tr>
			<td valign="top">
				<label for="message">Message (Max 1000 Characters)*</label>
			</td>
			<td valign="top">
				<textarea  name="message" maxlength="1000" cols="25" rows="6"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center">
				<input type="submit" value="Send Message">
			</td>
		</tr>
		</table>
		</form>
</div>