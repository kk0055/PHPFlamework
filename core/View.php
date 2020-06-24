<?php
 class View
 {
   protected $base_dir;
   protected $defaults;
   protected $layout_variables = array();

   //$base_dir...ビューファイルを格納しているviewディレクトリへの絶対パスを指定
   //$defaults...ビューファイルに変数を渡す際、デフォルトで渡す変数を設定できるようにするため
   public function __construct($base_dir, $defaults = array())
   {
     $this->base_dir = $base_dir;
     $this->defaults = $defaults;
   }

   public function setLayoutVar($name,$value)
   {
     $this->layout_variable[$name] = $value;
   }
   //render()...ビューファイルの読み込み。第一引数はファイルへのパスを指定。第二引数はビューファイルに渡す変数を指定。連想配列で指定
      //第三引数はレイアウトファイル名を指定
   public function render($_path, $variables = array(),$_layout = false)
   {
     $_file = $this->base_dir . '/'. $_path. '.php';

     extract(array_merge($this->defaults,$_variables));

     
     //ob_start　アウトプットバッファリングを開始。バッファリング中にechoされた文字列は画面に表示されず内部のバッファにため込まれる
     //バッファに格納された文字列はob_get_cleanなどで取得可能
     ob_start();
     ob_implicit_flush(0);

     require $_file;
     
     $content = ob_get_clean();

     //$layoutにレイアウトファイルが指定されている場合再度render()を実行してレイアウトファイルの読み込みを行う
     if($_layout) {

      
       $content = $this->render($_layout,
       array_merge($this->layout_variables,
       array('_content' => $content,
       )
       ));

     }

     return $content;
   }
   public function escape($string)
   {
     return htmlspecialchars($string,ENT_QUOTES,'UTF-8');
   }
 }