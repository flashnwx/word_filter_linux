
<!DOCTYPE html>
<html>
<body>

<form action="/wordfilter/word_filter" id="myform" method="post">
    标题:<br>
<input type="text" name="title" value="title" >
<br><br>

 文章内容:<br>
 <textarea rows="10" cols="100" name="content" >
请在此处输入文本...</textarea>
<br><br>
<input type="submit" value="Submit">
</form>

<p >如果您点击提交，内容含有敏感词将不会审核通过。</p>

</body>
</html>

