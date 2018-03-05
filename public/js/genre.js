var rowIds = [];
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
	})
});