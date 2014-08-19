<!doctype html>
<html lang="en" class="a">
    <head>
    </head>
    <body>

		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>    
    	<script type="text/javascript">
    	
			$(document).ready(function() {
			
				var voice = JSON.parse('<?php echo $voice; ?>');
				console.log(voice.project.reads[0].urls.part001.default);
				document.getElementById('root').innerHTML = "Escuche la voz <a href=\"" + voice.project.reads[0].urls.part001.default + "\">aqui</a>";
			});
    	</script>
        <div id="root">
        	
		</div>
    </body>
</html>