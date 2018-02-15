<!DOCTYPE html>
<html>
<head>
        <title>jqgridサンプル</title>
        <link type="text/css" media="screen" href="css/jquery-ui.css" rel="stylesheet" />
    	<link type="text/css" media="screen" href="css/ui.jqgrid.css" rel="stylesheet" />
    	<script type="text/javascript" src="js/jquery-1.11.0.min.js" ></script>
    	<script type="text/javascript" src="js/jquery-ui.min.js" ></script>
    	<script type="text/javascript" src="js/jquery.jqGrid.min.js" ></script>
    	<script type="text/javascript" src="js/grid.locale-ja.js" ></script>
        <script type="text/javascript">
            $(function(){
                $("#tbl1").jqGrid({
                     url: "jqgridController.php"
                    ,datatype: "json"
                    ,type: "POST"
                    ,colNames:["id", "名前", "価格"]
                    ,colModel:[ {name:"id"}
                               ,{name:"name"}
                               ,{name:"price"}
                     ]
                    ,width: "auto"
                    ,height: "auto"

                    }
                });
            });
        </script>
    </head>
<body>
  <table id="tbl1">
  </table>
</body>
</html>
