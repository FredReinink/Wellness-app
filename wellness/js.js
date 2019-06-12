
		  window.onload = function () {
			var cardioChart = new CanvasJS.Chart("cardioChart",
			{

			  title:{
				text: "Your Cardio Progression"
			  },
			  axisX:{  
			  },

			  axisY: {
				  	title: "HeartRate * Minutes",
					valueFormatString: "0.0#"
			  },
			  
			  data: [
			  {        
				type: "line",
				lineThickness: 2,
				dataPoints: [{ x: new Date(2019,06,14), y: 144},{ x: new Date(2019,06,29), y: 14545452},]
			  }    
			  ]
			});

			
			var weightChart = new CanvasJS.Chart("weightChart",
			{

			  title:{
				text: "Your Weight Progression"
			  },
			  axisX:{  
			  },

			  axisY: {
				  title: "weight (lbs)",
				  valueFormatString: "0.0#"
			  },
			  
			  data: [
			  {        
				type: "line",
				lineThickness: 2,
				dataPoints: [{ x: new Date(2019,06,01), y: 130},{ x: new Date(2019,06,02), y: 135},{ x: new Date(2019,06,03), y: 140},{ x: new Date(2019,06,05), y: 145},{ x: new Date(2019,06,08), y: 150},{ x: new Date(2019,06,15), y: 12323},]
			  }    
			  ]
			});
			
			
			var weightLiftingChart = new CanvasJS.Chart("weightTrainingChart", {
				title: {
					text: "Weight Training Progression by Volume"
				},
				axisX: {
				},
				axisY2: {
					title: "weight * reps",
				},
				toolTip: {
					shared: true
				},
				legend: {
					cursor: "pointer",
					verticalAlign: "top",
					horizontalAlign: "center",
					dockInsidePlotArea: true,
					itemclick: toogleDataSeries
				},data: [{		
						type:"line",
						axisYType: "secondary",
						name: "Squat",
						showInLegend: true,
						markerSize: 0,
						dataPoints: [{ x: new Date(2019,06,14), y: 144},{ x: new Date(2019,06,29), y: 144},]
								},{		
						type:"line",
						axisYType: "secondary",
						name: "Bench",
						showInLegend: true,
						markerSize: 0,
						dataPoints: [{ x: new Date(2019,06,14), y: 144},{ x: new Date(2019,06,29), y: 144},]
								}]});
		weightChart.render();
		cardioChart.render();
		weightLiftingChart.render();
		}
		