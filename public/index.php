<?php
	require '../src/functions.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Laisse pas trainer ton file</title>
</head>

<body style="text-align: center">

<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for='upload'>Ajouter un ou plusieurs fichiers :</label>
        <input id='upload' name="upload[]" type="file" multiple="multiple" />
    </div>

    <p><input type="submit" name="submit" value="Envoyer"></p></form>


<h2>Fichiers téléchargés :</h2>



<div class="container">';
    <div class="row">';
    
    <?php
    
	//création de chaque "card" qui contiendra l'image, le nom et le bouton pour l'effacer
	//crée un objet $it qui contiendra sous forme de tableau toutes les informations sur les photos qui se trouvent dans le fichier upload
	$it = new FilesystemIterator(dirname('upload/upload'));  // dirname : renvoit le chemin du dossier parent
	//crée une card pour chaque image trouvée
	foreach ($it as $fileinfo) {  // chaque nom d'image trouvé dans le tableau $i est stockée dans $fileinfo
		echo '<div class="col-6">';
		echo '<div class="card" style="width: 18rem; margin-top: 10px; margin-left: 10px">';
		echo '<img class="card-img-top img-thumbnail" src="' . $fileinfo . '" alt="Card image cap">';  //crée l'url où trouver l'image dont le nom est stocké dans $fileinfo pour pouvoir afficher la vignette
		echo '<div class="card-body">';
		echo '<h5 class="card-title">' . $fileinfo->getFilename() . '</h5>'; // utilise la méthode getFilename pour récupérer le nom du fichier pour pouvoir l'afficher
		// construit l'adresse url qui place dans la variable 'var1' le nom du fichier qu'il faudra effacer grâce à la méthode GET qu'on a créé au début
		// exemple d'url avec une image photo.jpg : index.php?var1=photo.jpg
		// la méthode get récupérera la variable var1, et saura donc que la photo a effacer est photo.jpg
		echo '<a href="index.php?var1=' . $fileinfo->getFilename() . '" class="btn btn-primary">Effacer cette image</a>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
?>
    </div>
</div>


</body>
</html>


