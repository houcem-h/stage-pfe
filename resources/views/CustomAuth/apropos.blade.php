@extends("../layouts/customApp")


@section("assets")
<style>
        @import url(https://fonts.googleapis.com/css?family=Quicksand:400,300);
        body{
            font-family: 'Quicksand', sans-serif;
        }
        .team{
            padding:30px 0;
        }
        h6.description{
            font-weight: bold;
            letter-spacing: 2px;
            color: #999;
            border-bottom: 1px solid rgba(0, 0, 0,0.1);
            padding-bottom: 5px;
        }
        .profile{
            margin-top: 25px;
        }
        .profile h1{
            font-weight: normal;
            font-size: 20px;
            margin:10px 0 0 0;
        }
        .profile h2{
            font-size: 14px;
            font-weight: lighter;
            margin-top: 5px;
        }
        .profile .img-box{
            opacity: 1;
            display: block;
            position: relative;
        }
        .profile .img-box:after{
            content:"";
            opacity: 0;
            background-color: rgba(0, 0, 0, 0.75);
            position: absolute;
            right: 0;
            left: 0;
            top: 0;
            bottom: 0;
        }
        .img-box ul{
            position: absolute;
            z-index: 2;
            bottom: 50px;
            text-align: center;
            width: 100%;
            padding-left: 0px;
            height: 0px;
            margin:0px;
            opacity: 0;
        }
        .profile .img-box:after, .img-box ul, .img-box ul li{
            -webkit-transition: all 0.5s ease-in-out 0s;
            -moz-transition: all 0.5s ease-in-out 0s;
            transition: all 0.5s ease-in-out 0s;
        }
        .img-box ul i{
            font-size: 20px;
            letter-spacing: 10px;
        }
        .img-box ul li{
            width: 30px;
            height: 30px;
            text-align: center;
            border: 1px solid #88C425;
            margin: 2px;
            padding: 5px;
            display: inline-block;
        }
        .img-box a{
            color:#fff;
        }
        .img-box:hover:after{
            opacity: 1;
        }
        .img-box:hover ul{
            opacity: 1;
        }
        .img-box ul a{
            -webkit-transition: all 0.3s ease-in-out 0s;
            -moz-transition: all 0.3s ease-in-out 0s;
            transition: all 0.3s ease-in-out 0s;
        }
        .img-box a:hover li{
            border-color: #fff;
            color: #88C425;
        }
        a{
            color:#88C425;
        }
        a:hover{
            text-decoration:none;
            color:#519548;
        }
        i.red{
            color:#BC0213;
        }  

        .image{
            position:relative;
            overflow:hidden;
            padding-bottom:100%;
        }
        .image img{
              position: absolute;
              max-width: 100%;
              max-height: 100%;
              top: 50%;
              left: 50%;
              transform: translateX(-50%) translateY(-50%);
        }
     
</style>
@endsection



@section("content")
<!--nav for login-->
@include("../CustomAuth/homenav")

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<section class="team">
  <div class="container">
      <div class="row">
          <div class="col-12"><h1 style="font-family: Poppins-Regular" class="text-center">A Propos :</h1></div>
          <p>
                <br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
          </p>
      </div>
      <br>
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="col-lg-12">
          <h6 class="description" style="font-family: Poppins-Regular" class="text-center">Stage & PFE Created By :</h6>
          <div class="row pt-md">
           
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 profile">
                        <div class="img-box image">
                          <img src="https://i.imgur.com/hqQqwCY.jpg" class="img-responsive" height="100px">
                          <ul class="text-center">
                            <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                            <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                            <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                          </ul>
                        </div>
                        <h1 style="font-family: Poppins-Regular" class="text-center">Houcem Hedhli</h1>
                        <h2 style="font-family: Poppins-Regular" class="text-center">Founder</h2>
                        
                      </div>


                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 profile">
                            <div class="img-box image">
                              <img src="https://i.imgur.com/Ri6Ijo3.jpg" class="img-responsive" height="100px">
                              <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                              </ul>
                            </div>
                            <h1 style="font-family: Poppins-Regular" class="text-center">Amine Béjaoui</h1>
                            <h2 style="font-family: Poppins-Regular" class="text-center">Student</h2>
                            
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 profile">
                            <div class="img-box image">
                              <img src="https://i.imgur.com/wGXZIVd.png" class="img-responsive" height="100px">
                              <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                              </ul>
                            </div>
                            <h1 style="font-family: Poppins-Regular" class="text-center">Oussama Jawher Abdelwahed</h1>
                            <h2 style="font-family: Poppins-Regular" class="text-center">Student</h2>
                            
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 profile">
                            <div class="img-box image">
                              <img src="https://i.imgur.com/7vm37xl.jpg" class="img-responsive" height="100px">
                              <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                              </ul>
                            </div>
                            <h1 style="font-family: Poppins-Regular" class="text-center">Hazem Kalifa</h1>
                            <h2 style="font-family: Poppins-Regular" class="text-center">Student</h2>
                            
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 profile">
                            <div class="img-box image">
                              <img src="https://i.imgur.com/lMVeTfi.jpg" class="img-responsive" height="100px">
                              <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                              </ul>
                            </div>
                            <h1 style="font-family: Poppins-Regular" class="text-center">Ahmed Jannedi</h1>
                            <h2 style="font-family: Poppins-Regular" class="text-center">Student</h2>
                            
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 profile">
                            <div class="img-box image">
                              <img src="https://i.imgur.com/GVMs681.jpg" class="img-responsive" height="100px">
                              <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                              </ul>
                            </div>
                            <h1 style="font-family: Poppins-Regular" class="text-center">Adem Kouki</h1>
                            <h2 style="font-family: Poppins-Regular" class="text-center">Student</h2>
                            
                    </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer>
    
</footer>



<script src="{{ asset('LoginTemplate/js/scriptLogin.js') }}"></script>
@endsection