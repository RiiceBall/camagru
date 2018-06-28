<?php
	if (!isset($_SESSION))
		session_start();
	if (!isset($_SESSION['user'])) {
		echo '<script> alert("Vous devez vous connectez pour accéder à cette page.");
		window.location.href="../index.php";</script>';
		exit(0);
	}
?>
<html>
<body onunload="window.location.reload()">
	<div id="webcam_section">
		<section>
			<div id="img_sup">
				<input id="zombie" type="radio" name="img_cam" value="zombie" onclick="draw_img_video('zombie.png', 'zombie')"><label for="zombie"><img src="public/filtre/zombie.png" alt="zombie"></label>
				<input id="radio_wave" type="radio" name="img_cam" value="radio_wave" onclick="draw_img_video('radio_wave.png', 'radio_wave')"><label for="radio_wave"><img src="public/filtre/radio_wave.png" alt="radio_wave"></label>
				<input id="question" type="radio" name="img_cam" value="question" onclick="draw_img_video('question.png', 'question')"><label for="question"><img src="public/filtre/question.png" alt="question"></label>
				<input id="prohibition" type="radio" name="img_cam" value="prohibition" onclick="draw_img_video('prohibition.png', 'prohibition')"><label for="prohibition"><img src="public/filtre/prohibition.png" alt="prohibition"></label>
				<input id="broken" type="radio" name="img_cam" value="broken" onclick="draw_img_video('broken.png', 'broken')"><label for="broken"><img src="public/filtre/broken.png" alt="broken"></label>
				<input id="mirror" type="radio" name="img_cam" value="mirror" onclick="draw_img_video('mirror.png', 'mirror')"><label for="mirror"><img src="public/filtre/mirror.png" alt="mirror"></label>
				<input id="xmas" type="radio" name="img_cam" value="xmas" onclick="draw_img_video('xmas.png', 'xmas')"><label for="xmas"><img src="public/filtre/xmas.png" alt="xmas"></label>
			</div>
			<p id="message_to_user"><br/></p>
			<div id="div_video">
				<img id="img_video">
				<video id="video" width="400" height="300"></video>
				<img id="no_video">
			</div>
		    <button id="tack" clear="both">snap shot</button>
			<input type="file" id="upload" name="upload" onchange="upload_image(<?= $_SESSION['id']; ?>)" clear="both" accept=".jpg, .jpeg, .png">
		    <canvas id="canvas" width="400" height="300"></canvas>
		</section>
		<aside>
			<p id="side_title">Cliquez sur la photo pour partager!</p>
			<div id="side"></div>
		</aside>
		<div id="old_picture">
			<?php
				require("view/show_picture.php")
			?>
		</div>
	</div>
	<script type="text/javascript" src="public/js/webcam.js"></script>
</body>
</html>
