<?php
    require_once('./language.php');
?>

<!DOCTYPE html>
    <html lang="<?php echo $GLOBALS['lang']; ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $GLOBALS['messages']['upload-page-title']; ?></title>
		<style>
			img {
				max-width: 300px;
				max-height: 300px;
			}
			input[type="file"] {
    			display: none;
			}
			ul {
				list-style: none;
			}
		</style>
	</head>
	<body>
		<div>
		<h1><?php echo $GLOBALS['messages']['upload-page-title']; ?></h1>
		</div>
		<div>
		<input id="hiddenfiles" type="file" onchange="changeFiles(event)" multiple/>
		<button style="width:10em;font-size:100%;" onclick="document.getElementById('hiddenfiles').click();"><?php echo $GLOBALS['messages']['upload-page-select']; ?></button>
		</div>
		<ul id="file-list">
			<li><?php echo $GLOBALS['messages']['upload-page-no-select']; ?>
		</ul>
		<div>
		<button style="width:10em;font-size:100%;" onclick="sendFiles()"><?php echo $GLOBALS['messages']['upload-page-send']; ?></button>
		</div>
		<div id="message">
		</div>
	<script>
		let targetFiles=[];
		let fileList = document.getElementById('file-list');
		let message = document.getElementById('message');

		function changeFiles(event) {
			
			targetFiles=[];
			
			while(fileList.firstChild){
				fileList.removeChild(fileList.firstChild);
			}

			if (event.target.files.length <= 0) {
				let li = document.createElement('li');
				li.innerText='<?php echo $GLOBALS['messages']['upload-page-no-select']; ?>';
				fileList.appendChild(li);
			} else {
				for(let i = 0, max =event.target.files.length; i < max; i++) {

					let li = document.createElement('li');
					li.innerText=event.target.files[i].name+' ';
					let button = document.createElement('button');
					button.innerText='<?php echo $GLOBALS['messages']['upload-page-cancel']; ?>';
					
					button.onclick=()=>{
						targetFiles = targetFiles.filter(v=>v!=event.target.files[i]);
						li.remove();
					}

					li.appendChild(button);

					let br = document.createElement('br');
					li.appendChild(br);

					if (preview(event.target.files[i].name)){
						let img = document.createElement('img');
						li.appendChild(img);

						let fileReader = new FileReader();
						fileReader.onload = function(_) {
							img.src = fileReader.result;
						};
						fileReader.readAsDataURL(event.target.files[i]);
					}
					fileList.appendChild(li);
					targetFiles.push(event.target.files[i]);
				}

			}
		}
		function preview(strFileName){
			let reg = new RegExp(/.*(\.jpg|\.jpeg|\.png|\.svg|\.gif)$/);

			return reg.test(strFileName.toLowerCase());
		}
		async function sendFiles() {
  			let formData = new FormData();

			for (let i = 0; i < targetFiles.length; i++) {
  				formData.append("uploadfiles[]", targetFiles[i]);
			}

			await fetch('./ajax-upload.php', { 
				method: "POST", 
				body: formData
			})
			.then(response=> {console.log(response); return response.json();})
			.then(data => {
				if (data.result==true) {
					message.innerHTML=data.message;
				} else {
					message.innerText='<?php echo $GLOBALS['messages']['ajax-ng']; ?>';
				}	
			});
		}
	</script>
	</body>
</html>
