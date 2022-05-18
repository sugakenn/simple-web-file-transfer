<?php

	require_once('./language.php');

	//アップロードフォルダ指定
	define('UPLOAD_DIR','./uploads');
	
	$strMsg="";
	$strFiles="";
	$intCnt=0;
	//ファイルの確認
	if(isset($_FILES["uploadfiles"])){
		for ($i=0; $i < count($_FILES["uploadfiles"]["name"]); $i++){
			if(is_uploaded_file($_FILES["uploadfiles"]["tmp_name"][$i])){
				if (move_uploaded_file($_FILES["uploadfiles"]["tmp_name"][$i], UPLOAD_DIR."/". $_FILES["uploadfiles"]["name"][$i])) {
					$strFiles.="<br>";
					$strFiles.=htmlspecialchars($_FILES["uploadfiles"]["name"][$i]).' '.$GLOBALS['messages']['ajax-ok'];
					$intCnt++;
				} else {
					$strFiles.="<br>";
					$strFiles.=htmlspecialchars($_FILES["uploadfiles"]["name"][$i]).' <strong>'.$GLOBALS['messages']['ajax-ng'].'</strong>';
					$intCnt++;
				}	
			}
		}
	}
	
	if (0 < $intCnt) {
		$strMsg = (string)$intCnt.$GLOBALS['messages']['upload-end'].$strFiles ;
	} else {
		$strMsg =$GLOBALS['messages']['ajax-no-file'];
	}

	$ret=array();
	$ret['result']=true;
	$ret['message']=$strMsg;

	echo json_encode($ret);
	
?>