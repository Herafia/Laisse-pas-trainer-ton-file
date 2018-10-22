<?php
	//récupère le nom de la photo a effacer avec la fonction GET
	if ($_GET) {
		$name = "upload/" . $_GET['var1'];
		if (file_exists($name)) {
			unlink($name);
		}
	}
	//Vérifie si le dossier upload existe, sinon le crée
	if (is_dir('upload')) {
	}else{
		mkdir('upload');
	}
	$files = []; 	// instancie le tableau $files
	if (isset($_POST['submit'])) {	//vérifie si l'utilisateur a cliqué sur le bouton  d'envoi des fichiers
		if (count($_FILES['upload']['name']) > 0) // compte le nombre de fichiers envoyés
			for ($i = 0; $i < count($_FILES['upload']['name']); $i++) { //Fait une boucle pour traiter chaque fichier séparement
				$tmpFilePath = $_FILES['upload']['tmp_name'][$i]; //trouve le chemin vers le fichier temporaire
				if (filesize($tmpFilePath) < 1000000) {	// teste la taille du fichier pour qu'il ne dépasse pas 1Mo (1000000)'
					if(empty($tmpFilePath)){ // Vérifie si un fichier a bien sélectionné un fichier avant de l'envoyer, sinon retourne un message d'erreur
						
						echo "Aucun fichier envoyé" . '<br>' . '<br>';
					}else {
						// Vérifie si le format du fichier est le bon
						if ((mime_content_type($tmpFilePath) == 'image/jpeg') or (mime_content_type($tmpFilePath) == 'image/gif') or (mime_content_type($tmpFilePath) == 'image/png')) {
							//cherche le type d'extension pour pouvoir construire le nom final du fichier
							$extension = pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);
							$filePath = "upload/" . "image-" . uniqid() . "." . $extension;
							//enregistre le fichier dans le dossier upload
							move_uploaded_file($tmpFilePath, $filePath);
							//affiche un message d'erreur si le format n'est pas correct
						} else {
							echo 'Le fichier ne correspond pas au bon format (jpeg, png ou gif)' . '<br>' . '<br>';
						}
					}
					// affiche un message d'erreur si le fichier est trop volumineux
				} else {

					echo "Le fichier est trop volumineux" . '<br>' . '<br>';
				}
			}
			//Si on a au moins un fichier, affiche "Uploaded :" pour faire la liste des fichiers chargés
			if ($files != null) {
				echo "<h1>Uploaded:</h1>";
			}
			//Fait la liste des fichiers chargés
			if (is_array($files)) {
				echo "<ul>";
				foreach ($files as $file) {
					echo "<li>$file</li>";
				}
				echo "</ul>";
			}
		
	}
?>
