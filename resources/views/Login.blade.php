<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>ログイン</title>
<link href="css/common.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/jquery.bootgrid.css" rel="stylesheet" />
<link href="css/Buttons.css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.js"></script>
</head>

<body>
	<div id="header"></div>


	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-push-3 col-md-6">
				<div class="form-wrap">
					<div class="text-center">
						<h1>Login</h1>
						<form class="center-block" method="POST" action＝'Login'>
							{{ csrf_field() }}
							<input type="text" id ="custid" name="custid" class="form-control"
								maxlength="20" placeholder="ユーザーID" required /><br>
							<input type="password" id =password name="password" class="form-control"
								maxlength="60" placeholder="パスワード" required /><br> <br>
							<button type="submit" id="btn-login"
								class="btn btn-primary btn-block">ログイン</button>
							<br> <br> <!--  <font size="4" color=#ff0000>--><b>
							 <?php //echo $errorMessage; ?></b></font>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>



	<script>
$(function(){
	$("#header").load("loginheader.html");
});
</script>

</body>
</html>
