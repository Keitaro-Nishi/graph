<!DOCTYPE html>
<html>
<meta name="description" content="ユーザー登録">
<title>ユーザー登録</title>
<link href="css/common.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/jquery.bootgrid.css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.bootgrid.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action＝'Custinfoadd'>
                        {{ csrf_field() }}

                        <div>
                            <label for="custid" class="col-md-4 control-label">ユーザーID</label>

                            <div class="col-md-6">
                                <input id="custid" type="text" class="form-control" name="custid"  required autofocus>
                            </div>
                        </div>

                        <div>
                            <label for="custname" class="col-md-4 control-label">ユーザー名</label>

                            <div class="col-md-6">
                                <input id="custname" type="text" class="form-control" name="custname" required>
                            </div>
                        </div>

                        <div>
                            <label for="orgname" class="col-md-4 control-label">組織名</label>

                            <div class="col-md-6">
                                <input id="orgname" type="text" class="form-control" name="orgname" required>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>
						<br>

                        <div>
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    登録
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</html>
