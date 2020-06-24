<?php
class Request
{
  public function isPost()
  {
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      return true;
    
    }
    return false;
  }

  public function getGet($name,$default = null)
  {
    if(isset($_GET['name'])){
      return $_GET['name'];
    }
    return $default;
  }
  public function getPost($name,$default = null)
  {
    if(isset($_POST['name'])){
      return $_POST['name'];
    }
    return $default;
  }
public function getHost()
{
  if(!empty($_SERVER['HTTP_HOST'])){
    return $_SERVER['HTTP_HOST'];
  }
   return $_SERVER['SERVER_NAME']; 
}
public function isSsl()
{
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    return true;
  }
    return false;
}
public function getRequestUri()
{
  return $_SERVER['REQUEST_URI'];
}

public function getBaseUrl()
{
  $script_name = $_SERVER['SCRIPT_NAME'];
  $request_uri = $this->getRequestUri();

  //strpos第一引数に指定した文字列の中から凱2引数に指定した文字列が最初に出現する位置を調べる。
  //フロントコントローラがURLに含まれる場合　フロントコントローラindex.php
  if(0 === strpos($request_uri,$script_name)) {
    return $script_name;
      //フロントコントローラが省略されているばあい　
      //dirname　ファイルのパスからディレクトリ部分を抜き出す関数。フロントコントローラを省略した値の取得
  }else if(0 === strpos($request_uri,dirname($script_name))) {
    return rtrim(dirname($script_name), '/');
  }
  return '';
}

public function getPathInfo()
{
  $base_url = $this->getRequestUri();
  $request_uri = substr($request_uri,0,$pos);

  if(false !==($pos = strpos( $request_uri, '?'))){
    $request_uri = substr($request_uri,0,$pos);
  }
  $path_info = (string)substr($request_uri,strlen($base_url));

 return  $path_info;
}

}