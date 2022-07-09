<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="theme-color" content="#c9190c" />
    <meta name="robots" content="index,follow" />
    <meta htttp-equiv="Cache-control" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="msapplication-TileColor" content="#c9190c" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Mercy College School Management System Software." /> 
    <link rel="icon" type="image/png" sizes="16x16" href="<?=ASSETS?>img/favicon-16x16.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?=ASSETS?>img/favicon-32x32.png" />
    <link rel="apple-touch-icon" href="<?=ASSETS?>img/icons/splash/launch-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" />
    <link rel="apple-touch-startup-image" href="<?=ASSETS?>img/icons/splash/launch-750x1294.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" />
    <link rel="apple-touch-startup-image" href="<?=ASSETS?>img/icons/splash/launch-1242x2148.png" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" />
    <link rel="apple-touch-startup-image" href="<?=ASSETS?>img/icons/splash/launch-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" />
    <link rel="apple-touch-startup-image" href="<?=ASSETS?>img/icons/splash/launch-1536x2048.png" media="(min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)" />
    <link rel="apple-touch-startup-image" href="<?=ASSETS?>img/icons/splash/launch-1668x2224.png" media="(min-device-width: 834px) and (max-device-width: 834px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)" />
    <link rel="apple-touch-startup-image" href="<?=ASSETS?>img/icons/splash/launch-2048x2732.png" media="(min-device-width: 1024px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)" />
    <title><?=$data['page_title'] . " | " . WEBSITE_TITLE;?></title>
    <link rel="shortcut icon" href="<?=ASSETS?>img/icons/favicon.ico" />
    <link rel="stylesheet" href="<?=ASSETS?>css/Bootstrap/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=ASSETS?>css/jquery.jgrowl.css" media="screen"/>
    <link rel="stylesheet" href="<?=ASSETS?>css/summernote.css" />
    <link rel="stylesheet" href="<?=ASSETS?>css/bootstrap/style.min.css" />
       <style>
        body {}
        .success-ico {padding-left: 60px;background: url(<?=ASSETS?>img/bullet_add.png) #E4FFDE no-repeat 30px center;}
        .statusMsg{background: #FAE8E8;border: 1px solid #DAB3B6;padding: 10px;border-radius: 5px;margin: 7px;width: auto;height: auto;color: #333;display: block;}
        .error-ico{padding-left:70px;background: url(<?=ASSETS?>img/bullet_error.png) #FAE8E8 no-repeat 30px center;}
        .form-control:focus{outline: none !important;border:1px solid red;box-shadow: 0 0 5px red;}
        .bold{text-transform: uppercase;font-size:11px; font-weight:bolder;color: #337ab7; text-align: center;display:flex;justify-content:center;}
        #imgs{margin-left: auto;margin-right: auto;max-width: 80%; max-height: 100%;object-fit: contain;height: fit-content; object-fit: contain;vertical-align: middle; display: flex;flex-direction: column;justify-content: space-evenly; top: 3px;}
    </style>
    <script type="text/javascript">
        let = base_url= '<?=ROOT?>';
    </script>
    </head>
    <body style="background: linear-gradient(rgba(0,0,0, 0.56), rgba(0,0,0, 0.56)), url(http://localhost/College/public/assets/img/login_bg.jpg) no-repeat;background-size: cover;">
        <div class="auth option2">
            <div class="auth_left">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <a class="header-brand" href="index-2.html"><i class="fa fa-graduation-cap brand-logo"></i></a>
                            <div class="card-title">Forgot password</div>
                        </div>
                        <form  method="POST" id="DDCForm" action="javascript:void(0)" >
                            <p class="text-muted" style="font-size:12px">
                            <?=$_SESSION['Fullname']?>
                            Welcome to Dashboard Controls Center, The School Admin has appointed you to different Department to handle.
                            Here is where you can select the Department you can to login into. Access has been given to also migrate into another Dashboard you wish to run or manage.
                            </p>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Select Department Dashboard</label>
                                 <p class="statusMsg error-ico" style="display:none"></p>
                                    <div class="row clearfix">  
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <select class="form-control input-height" name="DashboardList" id="DCCSelectvALUE">
                                                    <option value="" selected="Selected">--Select--</option>
                                                    <?php foreach ($data['base'] as $keyvalue):?>
                                                        <option value="<?=$keyvalue['Child_id']?>">Login to <?=$keyvalue['Child_name']?> Dashboard</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="SelectDH" class="btn btn-success btn-block">Manage Dashboard</button>
                                    <div class="text-muted mt-4">Forget it, <a href="login.html">Send me Back</a> to the Sign in screen.</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<script src="<?=ASSETS?>js/jquery.min.js"></script>
<script src="<?=ASSETS?>js/bundles/lib.vendor.bundle.js" type="e0f6cd12a9128368459fd9c3-text/javascript"></script>
<script src="<?=ASSETS?>js/core.js" type="e0f6cd12a9128368459fd9c3-text/javascript"></script>
<script src="<?=ASSETS?>js/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="e0f6cd12a9128368459fd9c3-|49" defer=""></script>
<script defer src="<?=ASSETS?>js/v64f9daad31f64f81be21cbef6184a5e31634941392597.js" integrity="sha512-gV/bogrUTVP2N3IzTDKzgP0Js1gg4fbwtYB6ftgLbKQu/V8yH2+lrKCfKHelh4SO3DPzKj4/glTO+tNJGDnb0A==" data-cf-beacon='{"rayId":"6b538d7aeed7e63c","version":"2021.11.0","r":1,"token":"f79813393a9345e8a59bb86abc14d67d","si":100}' crossorigin="anonymous"></script>
<script type="text/javascript" src="<?=ASSETS?>js/jquery2.js"></script>
<script src="<?=ASSETS?>js/jquery.jgrowl.js"></script>
    <script type="text/javascript">
    //hide messages
    $(document).ready(($)=>{
        //hide messages  
        $(".statusMsg").hide();
        //on submit
        $('#DDCForm').submit(function (e) {
            e.preventDefault();
            $(".statusMsg").hide();
            let selectedvALUE = $('#DCCSelectvALUE').val();
            if (selectedvALUE.trim() == "") {
                $(".statusMsg").fadeIn().html("<span>Please Select The Dashboard You Wish To Manage.</span> ");
                $("#DCCSelectvALUE").focus()
                return false;
            }else{
                let Data = {'ID':selectedvALUE}
                let stringifyData = JSON.stringify(Data);
                $.ajax({
				    type: 'POST',
                    dataType: 'JSON',
                    contentType: "application/json; charset=utf-8",
                    data: stringifyData,
                    url: base_url+"PagesController/ManagementDashboardLogin",
                    processData: false,
                    encode: true,
                    crossOrigin: true,
                    async: true,
                    crossDomain: true,
                    headers: {
                        'Access-Control-Allow-Methods': '*',
                        "Access-Control-Allow-Credentials": true,
                        "Access-Control-Allow-Headers": "Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type, Accept, Authorization",
                        "Access-Control-Allow-Origin": "*",
                        "Control-Allow-Origin": "*",
                        "cache-control": "no-cache",
                        'Content-Type': 'application/json'
                    }, 
                }).then((response) => {
                    if(response.status){
                        
                       $.jGrowl("Successfully Login.!", { header: 'Access Granted' });
                        let delay = 1000;
                        setTimeout(function () {
                             window.location.reload(true); 
                             }, 
                             delay
                        );
                    }else{
                        $("#error").fadeIn().text(response.message);
                    }
                }).fail((xhr, error) => {
                    $("#error").fadeIn().text('Oops...Server is down! error');
                });
            }
        });
    });
</script>
    </body>
    </html>