<?php 

$dir_out = './out/';

$dir_in = './in/';

$newWidth = $_POST['imgwidth'];
$newHeight = $_POST['imgheight'];

$files = scandir($dir_in);

$out_to_site = "";

$count = 0;
for($i = 0; $i < count($files); $i++){
	if($files[$i] !== '.' && $files[$i] !== '..'){

		$type_file = mime_content_type($dir_in.$files[$i]);
		
		if($type_file === 'image/jpeg'){
			imgResize($dir_in.$files[$i], $newWidth, $newHeight, $dir_out.$files[$i]);
			$out_to_site .= '. ';
			$count++;
		}
		
	}
}
echo $count;


// imgResize($filename, $_POST['imgwidth'], $_POST['imgheight'], $dir_out);


function imgResize($filename, $newWidth, $newHeight, $dir_out){
	
	// изменение размера изображения

	// 1 создадим новое изображение из файла
	$scr = imagecreatefromjpeg($filename); // или $imagePath
	
	// 2 создадим новое полноцветное изображение нужного размера
	$newImg = imagecreatetruecolor($newWidth, $newHeight);

	// 3 определим размер исходного изображения для 4 пункта
	$size = getimagesize($filename);

	// 4 копирует прямоугольную часть одного изображения на другое изображение, интерполируя значения пикселов таким образом, чтобы уменьшение размера изображения не уменьшало его чёткости
	imagecopyresampled($newImg, $scr, 0, 0, 0, 0, $newWidth, $newHeight, $size[0], $size[1]);

	// 5 запишем изображение в файл по нужному пути
	imagejpeg($newImg, $dir_out);

	imagedestroy($scr);
	imagedestroy($newImg);		
	
}

?>