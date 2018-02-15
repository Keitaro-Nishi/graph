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
        var mydata = [
            {comp_code:"CD1", comp_name:"株式会社シー", comp_kana:"カブシキカイシャシー"},
            {comp_code:"CD2", comp_name:"ビー株式会社", comp_kana:"ビーカブシキカイシャ"},
            {comp_code:"CD3", comp_name:"有限会社エー", comp_kana:"ユウゲンガイシャエー"},
        ];

        jQuery("#list").jqGrid({
                        data: mydata,
            datatype: "local",
            colNames:['NO', 'ユーザーID', '分類'],
            colModel:[
                {name:'comp_code'},
                {name:'comp_name'},
                {name:'comp_kana'},
            ],
            multiselect: true,
            caption: 'ログイン時間'
        });
    });
    </script>
</head>
<body>
  <table id="list">
  </table>
</body>
</html>
