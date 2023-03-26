<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Scan QR Code</title>
	<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<video id="preview" width="100%"></video>
			</div>
			<div class="col-md-6">
				<form action="update.php" method="post" class="form-horizontal">
					<label>Bottle Size</label>
					<input type="text" name="text" id="text" placeholder="scan qrcode" class="form-control">
				</form>
			</div>
		</div>
	</div>

		<script>
			let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
			Instascan.Camera.getCameras().then(function(cameras){
				if (cameras.length > 0 ){
					scanner.start(cameras[0]);
				}else{
					alert('No cameras found');
				}
			}).catch(function(e){
				console.error(e);
			});

			scanner.addListener('scan',function(c){
				document.getElementById('text').value=c;
				document.forms[0].submit();
			});
		</script>

</body>
</html>