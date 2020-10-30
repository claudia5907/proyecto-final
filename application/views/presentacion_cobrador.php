
<?php
$id_cobrador=$this->session->userdata("id_cobrador");
$fecha=date("Y-m-d");
?>
<head>
   <script id="demo" type="text/javascript">
    $(document).ready(function() {
    	$("#accordion").accordion();
    });
    </script>
</head>
<body>
<div style="width:97%; margin:auto">
 <div class='row'>
          <div id='pone_compras'>
			<div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php 
						  $fecha=date("Y-m-d");	
						  $res_monto_proyeccion_dia = $this->agenda_model->getSumaProyeccionDia($fecha);
						  $monto_proyeccion_dia = isset($res_monto_proyeccion_dia)? $res_monto_proyeccion_dia:0; 
						  echo number_format($monto_proyeccion_dia,2); 
						  ?></h3>
                  <h3>&nbsp;</h3>
                </div>
                <div class="icon">
                  <i class="ion ion-cash"></i>
                </div>
				<div class="small-box-footer">Proyeccion Nacional</div>
                <!--<a href="rev_entrada.php" class="small-box-footer">Ver otras proyecciones <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div>
		  </div>
          <div id='pone_ventas'>
			<div class="col-lg-4 col-xs-6"><!--col-xs-6-->
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner"> 
				  <h3>
				  <?php 
				  $proyeccion = $this->cobranza_model->get_proy_actual($id_cobrador,$fecha);
				  $proy=isset($proyeccion->PROYECCION_DIA_H)? $proyeccion->PROYECCION_DIA_H:"0";
				  if($monto_proyeccion_dia>0){
					  $porcentaje=($proy*100)/$monto_proyeccion_dia;
				  }else{
					  $porcentaje=0; 
				  }	
				  
				  echo number_format($porcentaje,2)." %";
				  ?></h3> 
                  <h3> 
				    <?php 
						echo number_format($proy,2);	
					?> </h3>
                </div>
                <div class="icon">
                  <i class="ion ion-cash"></i>
                </div>
				<div class="small-box-footer">Proyeccion Cobrador</div>
                <!--<a href="rep_ventas_s.php" class="small-box-footer">Consultar otra fecha <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div>
		  </div>
		  <div id='pone_gastos'>
			<div class="col-lg-4 col-xs-6"><!--col-xs-6-->
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner"> 
				  <h3>
				  <?php 
				  $respCobrado = $this->cobranza_model->get_total_cobrado($id_cobrador,$fecha);
				  if($proy>0){
					  $porcentaje1=($respCobrado*100)/$proy;
				  }else{
					  $porcentaje1=0;
				  }
                 
                  echo number_format($porcentaje1,2)." %";				  
				  ?>
				  </h3> 
                  <h3>
				  <?php 
				    
					echo number_format($respCobrado,2);
				  ?></h3>
                </div>
                <div class="icon">
                  <i class="ion ion-cash"></i>
                </div>
				<div class="small-box-footer">Cobranza dia</div>
                <!--<a href="rep_ventas_s.php" class="small-box-footer">Consultar otra fecha <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div>
		  </div>
		   
          <div id='pone_users'>
			<div class="col-lg-4 col-xs-6">
               
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>&nbsp;</h3>
                  <h3><?php $respAsig=$this->deposito_model->getcob_deposito($id_cobrador,$fecha);
							echo number_format($respAsig['DEPOSITADO_TOTALES'],2) ?></h3>
                </div>
                <div class="icon">
                  <i class="ion ion-cash"></i>
                </div>
				<div class="small-box-footer">Asignacion dia</div>
                <!--<a href="util_usr.php" class="small-box-footer">Detalle de asignacion <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div>
		  </div>  
		  <div id='pone_users'>
			<div class="col-lg-4 col-xs-6">
               
              <div class="small-box bg-orange">
                <div class="inner">
                  <h3>&nbsp;</h3>
                  <h3><?php $respDepo = $this->deposito_model->get_monto_depositado_cobrador($id_cobrador,$fecha); 
							 
							echo number_format($respDepo['totalDepo'],2); ?></h3>
                </div>
                <div class="icon">
                  <i class="ion ion-cash"></i>
                </div>
				<div class="small-box-footer">Deposito dia</div>
                <!--<a href="util_usr.php" class="small-box-footer">Detalle de asignacion <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div>
		  </div> 
          
		  <!--
          <div class='col-md-6'> 
              <div class="box box-solid">
                <div class="box-header">
                  <i class="fa fa-th"></i>
                  <h3 class="box-title">Grafica de existencias por lineas ($).</h3>
                  <div class="box-tools pull-right">
                    <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body border-radius-none">
                  <div class="chart" id="line-chart-existe" style="height: 250px;"></div>
                </div> 
                <div class="box-footer no-border">

                </div> 
              </div> 
          </div>-->

          </div>
</div>
</body>