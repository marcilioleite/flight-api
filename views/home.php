<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>App</title>
		<meta name="description" content="" />
		<meta name="author" content="Marcilio Leite" />

		<meta name="viewport" content="width=device-width; initial-scale=1.0" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	</head>

	<body>
		<input type="text" id="user" />
		<input type="text" id="play" />
		<button id="send">Enviar</button>
		<button id="reset">Reset</button>
		<script>
			$(function(){
				$('#send').click(function(){
					$.ajax({
						url: 'plays/',
						type: 'post',
						data: {user: $('#user').val(), play: $('#play').val()}
					})
				})
				
				$('#reset').click(function(){$.get('plays/reset/'+$('#user').val());})
				
				setInterval(function() {
					$.getJSON('plays/'+$('#user').val(), function(data){
						if(data)console.log(data)
					})
				}, 5000)
			})
		</script>
	</body>
</html>
