<!DOCTYPE html>
<html>
<head>
	<title>Weather</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

</head>
<body>
<div class="weather-container d-flex align-items-end container-fluid">
	<p class="region-text mb-0">Sud</p>
	<div class="weather-bar ml-0">
		<p>jan</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>

	<div class="weather-bar">
		<p>fév</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>

	<div class="weather-bar">
		<p>mar</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>

	<div class="weather-bar">
		<p>avr</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>

	<div class="weather-bar">
		<p>mai</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="weather-bar">
		<p>jui</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="weather-bar">
		<p>juil</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="weather-bar">
		<p>aoû</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="weather-bar">
		<p>sep</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="weather-bar">
		<p>oct</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="weather-bar">
		<p>nov</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="weather-bar">
		<p>déc</p>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
</div>
<div class="weather-note">
	<div class="weather-bar note-bar">
		<span>Très favorable</span>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="weather-bar note-bar">
		<span>Favorable</span>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="weather-bar note-bar">
		<span>Peu favorable</span>
		<div class="progress">
		  <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
</div>
</body>
</html>
<style>
.weather-bar{
	display: inline-block;
	margin: 0 10px;
}
.weather-bar > p{
	font: 15.5px "Lato", sans-serif;
	font-weight: 600;
	margin-bottom: 10px;
	text-align: center;
}
.weather-bar .progress{
	width: 32px;
	height: 10px;
	border-radius: 2px;
	display: inline-block;
}
.weather-bar .progress-bar{
	background-color: #e65824 !important;
	height: 10px;
}
.region-text{
	font: 15.5px "Lato", sans-serif;
	margin-right: 30px;
	line-height: 12px;
}
.weather-note{
	margin-top: 25px;
}
.weather-note .note-bar > span{
	font: 13px Lato, sans-serif;
	font-weight: 600;
}
</style>