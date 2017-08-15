<?php
//session_start();
//include_once( '/login/sina/config.php' );
//include_once( '/login/sina/saetv2.ex.class.php' );
//$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
//$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
?>
        <script type="text/javascript">
            var childWindow;
            function toQzoneLogin()
            {
                childWindow = window.open("/login/qq/example/oauth/index.php","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
            } 
            
            function closeChildWindow()
            {
                childWindow.close();
            }
        </script>

    <a href="<?=$code_url?>"><img src="http://www.azzsh.com/sina/weibo_login.png" title="点击进入授权页面" alt="点击进入授权页面" border="0" /></a>
    <a href="#" onclick='toQzoneLogin()'><img src="http://www.azzsh.com/qq_connect/example/img/qq_login.png"></a>

