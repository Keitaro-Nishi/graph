$(function() {
	$('#date_from').datepicker({
		dateFormat: 'yy/mm/dd',//年月日の並びを変更
	});
	$('#date_to').datepicker({
		dateFormat: 'yy/mm/dd',//年月日の並びを変更
	});
	var ctx = document.getElementById("myChart1").getContext('2d');
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
	var ctx = document.getElementById("myChart2").getContext('2d');
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
});
/*
function open(){
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
*/