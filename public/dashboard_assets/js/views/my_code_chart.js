

  $(function (){
    'use strict';
  

  

  
   

  
  
    var pieData = {
      labels: [
        'TI',
        'DSI',
        'SEM',
        'RSI',
        'MDW',
      ],
      datasets: [{
        data: [300, 220, 100, 130, 70],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56',
          '#EE6352',
          '#8ACB88'
        ],
        hoverBackgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56',
          '#EE6352',
          '#8ACB88'
        ]
      }]
    };
    var ctx = document.getElementById('canvas-5');
    var chart = new Chart(ctx, {
      type: 'pie',
      data: pieData,
      options: {
        responsive: true
      }
    });
  
  
    













});