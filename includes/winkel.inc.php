<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
	<div class="row">
		<?php
			include 'includes/config.php';
			$stmt = $conn->prepare("SELECT * FROM artikel");
			$stmt->execute();
			$result = $stmt->get_result();
			while($row = $result->fetch_assoc());
		?>
		<div class="col-lg-3">
			<div class="card-deck">
				<div class="card p-2 border=secondary mb=2">
					<img src="<?= $row['plaatje'] ?>" class="card-img-top"
					height="250">
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>