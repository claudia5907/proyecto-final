<head>
    <script src="<?php echo base_url(); ?>resources/plugins/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/morris/raphael-min.js"></script>
   <script id="demo" type="text/javascript">
    $(document).ready(function() {
    	$("#accordion").accordion();
    });
function genera_grafica_existe(){
		$(document).ready(function(){
			$.getJSON("<?php echo base_url(); ?>inicio/mostrar_grafico", function(json){

			/*var donut = new Morris.Donut({
						element: 'line-chart-ventas',
						resize: true,
						colors: ["#3c8dbc", "#f56954", "#00a65a"],
						data: json,
						hideHover: 'auto'
					  });*/
			   var donut =  new Morris.Line({
				  // ID of the element in which to draw the chart.
				  element: 'line-chart-ventas',
				  // Chart data records -- each entry in this array corresponds to a point on
				  // the chart.
				  data: [
					{ year: '2008', value: 20 },
					{ year: '2009', value: 10 },
					{ year: '2010', value: 5 },
					{ year: '2011', value: 5 },
					{ year: '2012', value: 20 }
				  ],
				  // The name of the data record attribute that contains x-values.
				  xkey: 'year',
				  // A list of names of data record attributes that contain y-values.
				  ykeys: ['value'],
				  // Labels for the ykeys -- will be displayed when you hover over the
				  // chart.
				  labels: ['Value']
				});	  
			}); 
			 
		});
	}
    </script>
</head>
<body onload="genera_grafica_existe()">
<div style="width:97%; margin:auto">
 <div class='row'>
          <div id='pone_compras'>
			<div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3> --</h3>
                  <p>&nbsp;</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <div class="small-box-footer"><!--Proyeccion Nacional. --><i class="fa fa-arrow-circle-right"></i></div>
              </div>
            </div>
		  </div>
          <div id='pone_ventas'>
			<div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>---
				  </h3>
                  <p>&nbsp;</p>
                </div>
                <div class="icon">
                  <i class="ion ion-cash"></i>
                </div>
                <div class="small-box-footer"><!--Total Cobranza Nacional.--> <i class="fa fa-arrow-circle-right"></i></div>
              </div>
            </div>
		  </div>
          <div id='pone_gastos'>
			<div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>
				 --
					</h3>
                  <p>&nbsp;</p>
                </div>
                <div class="icon">
                  <i class="ion ion-calendar"></i>
                </div>
                <div class="small-box-footer"><!--Total Depositos Nacional. --><i class="fa fa-arrow-circle-right"></i></div>
              </div>
            </div>
		  </div>
           
           <!--<div class='col-md-12'>
           
              <div class="box box-solid">
                <div class="box-header">
                  <i class="fa fa-th"></i>
                  <h3 class="box-title">Grafica de cobranza ultimos 7 dias ($).</h3>
                  <div class="box-tools pull-right">
                    <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body border-radius-none">
                  <div class="chart" id="line-chart-ventas" style="height: 250px;"></div>
                </div> 
                <div class="box-footer no-border">

                </div> 
              </div>  
          </div> -->
          </div>
</div>
</body>