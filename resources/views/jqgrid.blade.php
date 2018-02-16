<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
    <link type="text/css" media="screen" href="css/jquery-ui.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="css/ui.jqgrid.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.11.0.min.js" ></script>
    <script type="text/javascript" src="js/jquery-ui.min.js" ></script>
    <script type="text/javascript" src="js/jquery.jqGrid.min.js" ></script>
    <script type="text/javascript" src="js/grid.locale-ja.js" ></script>

    <script type="text/javascript">
    jQuery(document).ready(function()
    {

    	jQuery("#list").jqGrid
    	({
                     url: "jqgridController.php",
                     datatype: "json",
                     type: "POST",
                     //colNames:['ID', '名前', '価格'],
                     colNames:['価格'],
                     colModel:[ //{name:"id"},
                                //{name:"name"},
                                {name:"price"}
                     ]
				    multiselect: true,
				    caption: 'テスト',
				    'loadError' : function (xhr, status, error){
				    alert(error);
				    }

        });
     });
        </script>
    </head>
<body>
  <table id="list">
  </table>
</body>
</html>
