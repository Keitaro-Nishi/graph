@extends('layouts.app')

@section('content')
<div class="container">
	<div class="center-block">
		<input type="button" class="btn btn-default" onclick="location.href='botlog.php'" value="ログ参照" />
		<input type="button" class="btn btn-default" onclick="location.href='imagelog.php'" value="画像ログ参照" />
		<input type="button" class="btn btn-default" onclick="location.href='shisetsu.php'" value="施設情報" />
		<input type="button" class="btn btn-default" onclick="location.href='genre.php'" value="施設ジャンル" />
		<input type="button" class="btn btn-default" onclick="location.href='opinion.php'" value="市政へのご意見" />
		<input type="button" class="btn btn-default" onclick="location.href='test.php'" value="ボットテスト" />
		<input type="button" class="btn btn-default" onclick="location.href='Custinfo'" value="ユーザー情報" />
	</div>
</div>
<script>
$(function() {
	$("#header").load("header.html");

});
</script>
</body>
</html>

@endsection