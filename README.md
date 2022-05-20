
<h1>This Code Summary(概要)</h1>

<img src="https://github.com/sugakenn/simple-web-file-transfer/blob/images/summary.png" alt="summary"/>

<p>日本語の解説は<a href="https://nanbu.marune205.net/2021/12/php-web-pic-transfer.html?m=1" target="_blank" rel="noopener">なんぶ電子ブログ:「スマホとPC間でファイル転送」</a>に掲載しています。</p>

<h3>Require</h3>
<ol>
  <li>PHP
  <li>Apache Server(or other web server with PHP)
</ol>
<h3>Install</h3>
<p>Copy all from root dir to htdocs or htdocs's child folder.(if use Apache Server)</p>

<h3>Settings</h3>
<ol>
  <li> httpd.conf
    <p># for security reason<br>
      Listen 0.0.0.0:80<br><br>
      # top page<br>
      DirectoryIndex index.php index.html<br><br>
      #PHP setting (example 8.1 therad-safe)<br>
      LoadModule php_module "C:/php-811/php8apache2_4.dll"<br>
      PHPIniDir "C:/php-811"</br>
    </p>
  <li>php.ini(Optional)
  <p>upload_max_filesize = 100M<br>
  post_max_size = 100M<br>
  memory_limit = 128M<br>
  max_execution_time = 300</p>
  <li>language.php
    <p> $lang="en";//or ja </p>
 </ol>
   
<h3>Usage</h3>
<ol>
<li>Show page http://localhost/index.php on Web Server PC.
<li>Scan the QR Code with client.(Tablet, iPhone, Android...)
<li>Select Files from "select" button.
<li>click the "upload" button.
</ol>

<p>
  On default setting upload files saved to Server's "uploads" folder.
</p>


  


