$(function() {
	document.getElementById('graph1').style.display="none";
	$('#date_from').datepicker({
	    dateFormat: 'yy/mm/dd',//年月日の並びを変更
	});
	$('#date_to').datepicker({
	    dateFormat: 'yy/mm/dd',//年月日の並びを変更
	});
});

function open(){
	document.getElementById('graph1').style.display = 'block';
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
	  type: 'doughnut',
	  data: {
	    labels: ["M", "T", "W", "T", "F", "S", "S"],
	    datasets: [{
	      backgroundColor: [
	        "#2ecc71",
	        "#3498db",
	        "#95a5a6",
	        "#9b59b6",
	        "#f1c40f",
	        "#e74c3c",
	        "#34495e"
	      ],
	      data: [12, 19, 3, 17, 28, 24, 7]
	    }]
	  }
	});
}