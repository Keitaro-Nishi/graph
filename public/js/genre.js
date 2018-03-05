var rowIds = [];
var rowcitycode = [];
var rowgid1 = [];
var rowgid2 = [];
var meishoOld = "";
var uiKbn = 0;
var gid2 = 0;

$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		rowSelect : true,
		columnSelection : false,
	    keepSelection: true
	}).on("selected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++)
	    {
	        rowIds.push(rows[i].no);
	        rowcitycode.push(rows[i].citycode);
	        rowgid1.push(rows[i].gid1);
	        rowgid2.push(rows[i].gid2);
	        alert("rowIds:" + rows[i].no + "rowcitycode:" + rows[i].citycode + "rowgid1:" + rows[i].gid1 + " rowgid2:" + rows[i].gid2);
	    }
	}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++)
	    {
	    	for (var ii = 0; ii < rowIds.length; ii++){
		    	if(rowIds[ii] == rows[i].no){
		    		rowIds.splice(ii,1);
		    		rowcitycode.splice(ii,1);
		    		rowgid1.splice(ii,1);
		    		rowgid2.splice(ii,1);
		    		break;
		    	}
	    	}
	    }
	});
});