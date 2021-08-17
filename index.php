<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Image resize</title>
</head>
<body>

	<h3>Поместите фотографии в папку "in"</h3>
	<input type="text" id = "imgwidth" value = 640>
	<input type="text" id = "imgheight" value = 480>
	<button type="submit">Изменить размер</button>

	<div>
		<span class="points">[</span><span>]</span>
	</div>
	<div class="result"></div>
	<script>
		
		let btn = document.querySelector('button');
		btn.addEventListener('click', resizeImg);


		let arrData = [];
		function resizeImg(){
			// вывод точек на страницу
			let interval = setInterval(fPoint, 1000);

			img_width = imgwidth.value;
			img_height = imgheight.value;			


			fetch('img_handler.php', {
			method:'POST', // *GET, POST, PUT, DELETE, etc.
   			headers: {
      		//'Content-Type': 'application/json'
      		'Content-Type': 'application/x-www-form-urlencoded',
    		},
   			
   			 //body: JSON.stringify(arrData),
   			 body: "imgwidth=" + img_width+"&"+"imgheight=" + img_height,
   			  

		})
		.then(function(response){
			//console.log(response);
			return response.text();
			//return response.json();
		})
		.then(function(response){
			//console.log(response);		
			
			// это вывод ответа(избранных товаров из обработчика на страницу favorites)	
			document.querySelector('.result').innerHTML = 'Обработано '+ response + ' файлов';
			clearInterval(interval);
			
		})		
		}

		
		function fPoint(){
			document.querySelector('.points').innerHTML += '. ';
		}
		
	</script>
	
</body>
</html>