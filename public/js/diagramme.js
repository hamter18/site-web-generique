google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['Work',     11],
    ['Eat',      20],
    ['Commute',  30],

  ]);

  var options = {
    title: 'Articles les plus vendus',
    pieHole: 0.3,
  };

  var chart = new google.visualization.PieChart(document.getElementById('diagrammeGroupe'));
  chart.draw(data, options);
}

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChartAerasChart);

function drawChartAerasChart() {
    var data = google.visualization.arrayToDataTable([
    ['Year', 'Sales', 'Expenses'],
    ['2013',  1000,      400],
    ['2014',  1170,      460],
    ['2015',  660,       1120],
    ['2016',  1030,      540]
    ]);

    var options = {
    title: 'Fréquence de visite du site :',
    hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('Aeraschart_div'));
    chart.draw(data, options);
}

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['Work',     11],
    ['Eat',      20],
    ['Commute',  30],

  ]);

  var options = {
    title: 'Articles les plus vendus',
    pieHole: 0.3,
  };

  var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
  chart.draw(data, options);
}

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawColumnChart);

function drawColumnChart() {
  var data = google.visualization.arrayToDataTable([
    ['Year', 'Sales', 'Expenses', 'Profit'],
    ['2014', 1000, 400, 200],
    ['2015', 1170, 460, 250],
    ['2016', 660, 1120, 300],
    ['2017', 1030, 540, 350]
  ]);

  var options = {
    chart: {
      title: 'Performance de la compagnie',
      subtitle: 'Ventes, Dépenses, Profit: 2014-2017',
    }
  };

  var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}










google.charts.load('current', {
    'packages':['geochart'],
    // Note: you will need to get a mapsApiKey for your project.
    // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
    'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
  });
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable([
      ['Pays',   'Nombre de vente'],
      ['France', 1015], ['Austria', 6], ['Belgium', 865], ['Switzerland', 987],
      ['Germany', 455], ['German Democratic Republic', 100], ['Liechtenstein', 302],
      ['Luxembourg', 28], ['Monaco', 15],
      ['Netherlands', 40],
    ]);

    var options = {
      region: '155',
      colorAxis: {colors: ['#ffcccc', 'ff8080', '#cc0000']},
      backgroundColor: '#81d4fa',
      datalessRegionColor: '#fff',
      defaultColor: '#fff',
    };

    var chart = new google.visualization.GeoChart(document.getElementById('geochart-colors'));
    chart.draw(data, options);
  };
