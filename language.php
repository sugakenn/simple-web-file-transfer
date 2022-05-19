<?php

//language setting
$GLOBALS['lang']='ja';//en,ja

selectLang();

function selectLang() {
    switch($GLOBALS['lang']) {
    case 'ja':
        lang_jp();
        break;
    case 'en':
    default:
        lang_en();
        break;
    }
}

function lang_jp() {
    $GLOBALS['messages']['link-page-title']='ファイル転送サーバへのリンクページ';
    $GLOBALS['messages']['link-h1-title']='ファイル転送サーバ';
    $GLOBALS['messages']['link-ip']='URL:';
    $GLOBALS['messages']['upload-end']='件アップロードしました';
    $GLOBALS['messages']['upload-page-title']='ファイル転送サーバ';
    $GLOBALS['messages']['upload-page-send']='送信';
    $GLOBALS['messages']['upload-page-select']='ファイル選択';
    $GLOBALS['messages']['upload-page-no-select']='ファイル選択されていません';
    $GLOBALS['messages']['upload-page-cancel']='中止';
    
    $GLOBALS['messages']['ajax-ok']=' 成功';
    $GLOBALS['messages']['ajax-ng']=' 失敗';
    $GLOBALS['messages']['ajax-no-file']=' ファイルがありませんでした';
    $GLOBALS['messages']['ajax-ng-dir']=' アップロードフォルダ作成に失敗しました';
}

function lang_en() {
    $GLOBALS['messages']['link-page-title']='simple file transfer entrance';
    $GLOBALS['messages']['link-h1-title']='scan qr code, and go to link page';
    $GLOBALS['messages']['link-ip']='URL:';
    $GLOBALS['messages']['upload-end']=' files uploaded.';
    $GLOBALS['messages']['upload-page-title']='simple file transfer';
    $GLOBALS['messages']['upload-page-send']='send';
    $GLOBALS['messages']['upload-page-select']='select files';
    $GLOBALS['messages']['upload-page-no-select']='no file selected';
    $GLOBALS['messages']['upload-page-cancel']='cancel';
    
    $GLOBALS['messages']['ajax-ok']=' succeed';
    $GLOBALS['messages']['ajax-ng']=' failed !';
    $GLOBALS['messages']['ajax-no-file']='file does not exist';
    $GLOBALS['messages']['ajax-ng-dir']=' fail to make upload dir';

}


?>
