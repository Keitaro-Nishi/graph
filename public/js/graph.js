function init() {
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
			labels: ["男性", "女性", "未設定"],
			datasets: [{
				backgroundColor: [
					"#3498db",
					"#e74c3c",
					"#95a5a6",
					],
					data: [38, 36, 26]
			}]
		},
		options: {
			legend: {
				display: false
			}
		}
	});
	var ctx = document.getElementById("myChart2").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ["男性", "女性", "未設定"],
			datasets: [{
				backgroundColor: [
					"#3498db",
					"#e74c3c",
					"#95a5a6",
					],
					data: [48, 42, 10]
			}]
		},
		options: {
			legend: {
				display: false
			}
		}
	});
}
function open(){
	date_from = document.getElementById('date_from').value;
	console.log(date_from);
}
