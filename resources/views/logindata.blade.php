<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン情報</title>
<link type="text/css" media="screen" href="css/jquery-ui.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="css/ui.jqgrid.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.11.0.min.js" ></script>
    <script type="text/javascript" src="js/jquery-ui.min.js" ></script>
    <script type="text/javascript" src="js/jquery.jqGrid.min.js" ></script>
    <script type="text/javascript" src="js/grid.locale-ja.js" ></script>

    <script type="text/javascript">
    jQuery(document).ready(function()
    {

        jQuery("#list").jqGrid({
        	colNames:['NO', 'ユーザーID', '分類','時間'],
        	colModel:[
        		{{$infomation->id}}
    			{{$infomation->userid}}
    			{{$infomation->classification}}
    			{{$infomation->time}}
            ],
        });
    });
    </script>

</head>
<body>
<table id="list">
</table>
</body>
</html>
