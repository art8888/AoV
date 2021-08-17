<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$Title}</title>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
   <link rel="stylesheet" type="text/css" href="index2.css">
   <script type="text/javascript" src="jquery.js"></script>
   <script type="text/javascript">
   	$('#button').click(function() {
    var val1 = $('#text1').val();
    var val2 = $('#text2').val();
    $.ajax({
        type: 'POST',
        url: 'process.php',
        data: { text1: val1, text2: val2 },
        success: function(response) {
            $('#result').html(response);
        }
    });
});
   </script>
</head>
<body>

	<div class="message-box"></div>
	<input type="text" id="text1"> +
<input type="text" id="text2">
<button id="button"> = </button>
<div id="result"></div>	
	       			
</div>
</body>
</html>