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
			.wait::after {
				font-size: 150%;
				content:'\0262F';
				display: inline-block;
				animation: rotate-anime 3s linear infinite;
			}		
			@keyframes rotate-anime {
				0%  {transform: rotate(0);}
				100%  {transform: rotate(360deg);}
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
		<span id="wait">&nbsp;</span>
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
		function setLoading(bln){
			let el = document.getElementById('wait');
			let buttons = document.getElementsByTagName('button');

			el.classList.remove('wait');
			if(bln){
				el.classList.add('wait');
			}

			for(let i = 0; i < buttons.length; i++){
				buttons[i].disabled = bln;
			}
		}
		async function sendFiles() {
  			let formData = new FormData();
			setLoading(true);

			for (let i = 0; i < targetFiles.length; i++) {
  				formData.append("uploadfiles[]", targetFiles[i]);
			}

			await fetch('./ajax-upload.php', { 
				method: "POST", 
				body: formData
			})
			.then(response=> {setLoading(false); return response.json();})
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
