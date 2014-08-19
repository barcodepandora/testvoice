<!doctype html>
<html lang="en" class="a">
    <head>
    </head>
    <body>

		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>    
    	<script type="text/javascript">
    	
			$(document).ready(function() {
			
				var atrendy = JSON.parse('{"title":"A good article about Ferrari", "text":"Ferrari is almost a brand new excellence in car engineering"}');
				console.log( atrendy.title );
				document.getElementById('go').href = 'http://98.130.200.83/index.php/bunny_test/read_trendy/' + atrendy.title + "/" + atrendy.text;
				document.getElementById('root').innerHTML = atrendy.title + "<br/>" + atrendy.text;
			});
    	</script>
        <div id="root">
        	
		</div>
		<br/>Deseas que lo lea una gran voz? Dale <a id="go" href="">aqui</a>
    </body>
</html>