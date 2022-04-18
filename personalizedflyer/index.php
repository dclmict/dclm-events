<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL);

// include composer autoload
require 'vendor/autoload.php';
// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;
//use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic as Image;

// Clearing previously generated DPs when you visit
// https://site.org/dpmaker/?purge=yes
if(isset($_GET['purge'])){
    function delete_dir($src) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    delete_dir($src . '/' . $file);
                }
                else {
                    unlink($src . '/' . $file);
                }
            }
        }
        closedir($dir); rmdir($src);
    }

    if ($_GET['purge'] == "yes") {
        $files = glob(__DIR__ .'/cache/temp/*');
        foreach($files as $file){
            unlink($file);
            //delete_dir($file);
            print $file . ' <=> Delete Attempted..<br>';
        }
    }
    print '<a href="./"> <= Go back</a>';
    exit;
}


/*Colors
//http://www.workwithcolor.com/color-chart-full-01.htm
*/
$colors = [
    '#002E63' =>    'Cool Black',
    '#E32636' =>   'Alizarin',
    '#FFBF00'  =>   'Amber',
    '#8DB600'  =>   'Apple Green',
    '#000000' =>     'Black',
    '#C32148' =>    'Bright Maroon',
    '#00009C' =>    'Duke Blue',
];

if(isset($_POST['getmydp'])){

    $validType = array('IMAGETYPE_GIF','IMAGETYPE_JPEG','IMAGETYPE_PNG', 'IMAGETYPE_BMP');
    $check = getimagesize($_FILES['file']['tmp_name']);
    if($check == false) {
        //echo "File is an image - " . $check["mime"] . ".";
        print "Upload a Valid Image type: jpg, jpeg, png, gif, bmp"."<br>".'<a href="./"> <= Go back</a>';
        exit;
    }

    function get_image_type ( $filename ) {
        $img = getimagesize( $filename );
        if ( !empty( $img[2] ) ){
            return image_type_to_mime_type( $img[2] );
        }
        return false;
    }
    $fileType = get_image_type($_FILES['file']['tmp_name']);
    if(!in_array($fileType , array('image/jpeg' , 'image/x-citrix-jpeg' ,'image/png' , 'image/bmp'))){
        print "Upload a Valid Image type: jpg, jpeg, png, gif, bmp"."<br>";
        print '<a href="./"> <= Go back</a>';
        exit;
    }

    // $fileType = exif_imagetype($_FILES['file']['tmp_name']);
    // if(!in_array($fileType , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))){
    //     print "Upload a Valid Image type: jpg, jpeg, png, gif, bmp"."<br>";
    //     print '<a href="./"> <= Go back</a>';
    //     exit;
    // }
    @$user = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
    @$dist = filter_var($_POST['district'], FILTER_SANITIZE_STRING);
    @$color = filter_var($_POST['color'], FILTER_SANITIZE_STRING);
    @$quality = filter_var($_POST['quality'], FILTER_SANITIZE_STRING);

	/*****Doing image stuff******************/
	$image = $_FILES["file"]["tmp_name"];
	$image = Image::make($image);
	$image->orientate();
	$image->encode('jpg');
    $cachePath = 'cache/temp/'. time().'_my-dp.jpg';
	//$cachePath = 'cache/temp/_my-dp.jpg';

    $image->fit(320,320);

    // create empty canvas
    $width = $image->getWidth();
    $height = $image->getHeight();
    $mask = Image::canvas($width, $height);

    // draw a white circle
    $mask->circle($width, $width/2, $height/2, function ($draw) {
        $draw->background('fff');
    });

    $image->mask($mask, false);
    //$image->save($cachePath."circled.jpg");

	/***********************/

    $dpfont  = "fonts/Raleway-ExtraBold.ttf";
    $color      =  (isset($color)) ? $color : "#C32148";
    $userName   = (isset($user)) ? $user : "Wonderful Person";
    //circle($cx, $cy, $r, $color, $filled=false)
    $user = [
        'text'   => substr($userName, 0, 21),
        'x'      => 689,
        'y'      => 443,
        'size'   => 22,
        'angle'  => 0,
        'color'  => (isset($color)) ? $color : "#C32148",
        'pos'    => "center",
    ];

    $distName = (isset($dist)) ? $dist : "Deeper Life Bible Chuch - Close to you";
    $dist = [
        'text'   => "@ ".substr($distName, 0, 46),
        'x'      => 698,
        'y'      => 977,
        'size'   => 14,
        'angle'  => 0,
        'color'  => (isset($color)) ? $color : "#C32148",
        'pos'    => "center",
    ];
    $myDP = Image::make('img/easter_retreat_base.jpg');
    //Write Name
    $myDP->text($user['text'], $user['x'], $user['y'], function($font) use($color) {
        $font->file("fonts/Raleway-ExtraBold.ttf");
        $font->size(30);
        $font->color($color);
        $font->align('center');
        $font->valign('middle');
        $font->angle(0);
    });
    //Write Location
    $myDP->text($dist['text'], $dist['x'], $dist['y'], function($font) use($color) {
        $font->file("fonts/Raleway-ExtraBold.ttf");
        $font->size(25);
        $font->color($color);
        $font->align('center');
        $font->valign('middle');
        $font->angle(0);
    });

	//Add Image
	$myDP->insert($image, 'top-left', 517, 68);
	$quality  = (isset($quality)) ? $quality : 70;
    $myDP->save($cachePath, $quality, 'jpg');


}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Deeper Life Bible Chuch Global Crusade DP Maker">
<meta name="author" content="DCLM SMAT">
<meta name="generator" content="DCLM SMAT">
<title>Global Crusade DP Maker - DCLM</title>

<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Favicons -->
<link rel="apple-touch-icon" href="dclm-logo.png" sizes="120x120">
<link rel="icon" href="dclm-logo.png" sizes="120x120" type="image/png">
<meta name="theme-color" content="#7952b3">


<style>
html,body { height: 100%;}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}
body {background: #f5f5f5 url(./img/gs-bg.jpg) fixed no-repeat top right /cover;}

.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}
@media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
}

.form-getLetter {
    width: 100%;
    max-width: 720px;
    padding: 15px;
    margin: auto;
    background-color: rgb(121 94 149 / 45%);
    border-radius: 5px;
    position: relative;
}

.form-control {
    font-size: 1rem;
    font-weight: 600;
    color: #212529;
    background-color: #fff;
    border-radius: .1rem !important;
}
.form-getLetter .form-floating:focus-within {
  z-index: 2;
}

.form-getLetter input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-getLetter input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.toasts-top-right.fixed {
    position: fixed;
    font-size: 12px;
}
.toast {
    width: 350px;
    max-width: 100%;
    font-size: 12px !important;
}
.toast-header {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    padding: .25rem .75rem;
    color: #6c757d;
    background-color: rgba(255,255,255,.85);
    background-clip: padding-box;
    border-bottom: 1px solid rgba(0,0,0,.05);
    border-top-left-radius: calc(.25rem - 1px);
    border-top-right-radius: calc(.25rem - 1px);
}
.toasts-top-right {
    position: absolute;
    left: 0;
    top: 0;
    z-index: 1040;
}
.toast-header .btn-close {
    background: none;
    padding: 0;
    background-color: transparent;
    border: 0;
}
.letter-box img {
    object-fit: cover;
    width: auto;
    height: 380px;
}
.bg-fb{background-color:#6045B6}
.bg-tw{background-color:#46A5E7}
.bg-wa{background-color:#00BD29}
.btn{color: #fff !important}

.baseImg-wrap {
    position: relative;
}


div#myImage {
	position: absolute;
    /*background-color: #fff;*/
    background-color: transparent;
    top: 6.2%;
    left: 47.8%;
    height: 30%;
    width: 30%;
    z-index: 2;
    overflow: hidden;
    text-align: center;
    border-radius: 75%;
}

img#myImageTag {
/*	opacity: 0.5;*/
}

.myName {
	font-size: 12px;
    font-size: calc(12px + 50%);
    position: absolute;
    background-color: #f3efd2;
    top: 38%;
    left: 42%;
    height: 5%;
    width: 44%;
    z-index: 2;
    overflow: hidden;
    text-align: center;
    font-weight: 600;
    line-height: 1.6;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.myChurch {
	font-size: 12px;
    font-size: calc(12px + 27%);
    position: absolute;
    background-color: #f7f7f7;
    top: 88.5%;
    left: 36%;
    height: 4.3%;
    width: 57%;
    z-index: 2;
    text-align: center;
    font-weight: 600;
    line-height: 1.6;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
@media(max-width: 767px){
    .myName, .myChurch{
        font-size: 2.2vw;
        line-height: 2;
    }
}


</style>
</head>
  <body class="bodyWrap">

    <main class="form-getLetter">
        <div class="baseImg-wrap">
            <img src="img/easter_retreat_base.jpg" class="w-100">
            <div class="myImage" id="myImage">
                <img id="myImageTag" src="./img/plus.png" alt="myImageTag" height="105" class="w-auto h-100"/>
            </div>
            <div class="myName"></div>
            <div class="myChurch"></div>
        </div>
      <form action="" method="POST" enctype="multipart/form-data">

        <h1 class="h6 mt-3 mb-3 fw-bold text-light">Create Your Personalized DP</h1>

        <div class="form-floating mb-1">
          <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your name" required>
          <label for="fullname">Enter your name</label>
        </div>

        <div class="form-floating mb-1">
          <input type="text" class="form-control" id="district" name="district" placeholder="Your District Location" required>
          <label for="district">Your District Location</label>
        </div>

        <div class="custom-file d-block w-100 mb-2">
            <input type="file" name="file" class="custom-file-input form-control" id="fileDoc" placeholder="Select a Photo" required>
            <!--<label class="custom-file-label" for="file" style="justify-content: left;">Choose file</label>-->
        </div>

        <div class="advance-panel row">
            <div class="col-6">
                <div class="form-floating mb-1">
                  <select class="form-select" id="color" name="color">
                    <?php foreach($colors as $hex => $name){ ?>
                        <option value="<?php print $hex ?>"><?php print $name; ?></option>
                    <?php } ?>
                  </select>
                  <label for="color">Set Custom Color</label>
                </div>
            </div><!--//Color-->

            <div class="col-6">
                <div class="form-floating mb-1">
                  <select class="form-select" id="quality" name="quality">
                        <option value="100">100% [large Image size]</option>
						<option value="90">90%</option>
						<option value="80">80%</option>
						<option value="70" selected>70%</option>
						<option value="60">60%</option>
                  </select>
                  <label for="quality">Output Size Ratio</label>
                </div>
            </div><!--//Quality-->

        </div>

        <button name="getmydp" class="w-100 btn btn-lg btn-danger mt-3" type="submit">Make My DP</button>
      </form>
    </main>

<?php if(isset($_POST['getmydp'])){ ?>
<div id="toastsContainerTopRight" class="toasts-top-right fixed">

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
      <div class="toast-header">
        <img class="rounded me-2" rounded me-2 src="dclm-logo.png" alt="" width="20">
        <strong class="me-auto">Download Personalized DP</strong>
        <small>Subtitle</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="toast-body">
        <p class="mx-2">Click on the button below to Download your Personalized DP</p>
        <a href="./<?php print $cachePath; ?>" target="_blank" class="btn btn-success btn-sm mb-1 me-auto" download>Download DP</a>
        <span class="btn btn-danger btn-sm m-auto mb-1 closeToast" data-bs-dismiss="toast">Close</span>
        <div class="letter-box">
            <img src="./<?php print $cachePath; ?>" class="m-auto w-100 h-auto border rounded">
        </div>
      </div>
    </div>
</div><!--//#toastsContainerTopRight-->
<?php }  ?>

<script>
$(document).ready(function(){
    $('.toast').toast('show');
    $('.closeToast').click(function(){
        $(".toast").toast("hide");
    });

    // Change Input holder
    $("#fullname").on("keyup change", function(e) {
        $(".myName").text( $(this).val())
    });
    $("#district").on("keyup change", function(e) {
        $(".myChurch").text( $(this).val())
    });
    // Lets open the file with custom event
    $("#myImage").click(function () {
        $("#fileDoc").click();
    });

    // Custom colors
    $('#color').on('change', function(){
        var color = $(this).find('option:selected').val();
        color  = color.replace('0x', '#');
        console.log(color);
        $('.myName, .myChurch').css('color', color);
        $('#color').css({'background-color':color, 'color':'#fff'});
    });

    // Open image preveiw
    fileDoc.onchange = evt => {
        const [file] = fileDoc.files
        if (file) {
         myImageTag.src = URL.createObjectURL(file);
        }
    }
});
</script>

<!-- Measureing Usage with Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3Y3WM2L61S"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3Y3WM2L61S');
</script>
<!--// -->
</body>
</html>
