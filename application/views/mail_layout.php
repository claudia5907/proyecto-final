<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>resources/css/styleresponsive.css">  
<style>
*{
  font-family:'trebuchet ms',verdana,arial!important;
}
</style>
<body id="mailALG"><!--style="font-family: Helvetica;"-->
		<!--
		<div id="cabecera" style="border-top:solid #DDF1FF 10px;color:#00418C; background-color: #F6FAFD; text-align:center;">
			<?php if($_SERVER['SERVER_NAME']=="localhost"){ ?> 
			<div style="color:red">
				<h2>--::PRUEBA DEL SERVIDOR::--</h2>
				<h5>Ojo: Los datos enviados en este correo son ficticios</h5>
				<h5>Gracias por colaborar, Atte. Area de Sistemas</h5>
			</div>
			<?php }else{ ?>
			<h1>SISTEMAS - ALG (INCUBACION)</h1>
			<?php } ?>
		</div>
		-->
		<!-----header----->
		<center>
		<div style="border:1px solid #4375B2;width: 98%;">
		<div style="padding: 2px 0;background:#dce4eb;color:#000;">			
			<div style="width: 100%; padding: 0; text-align: center;	">			
				<!--<a href="#" title="Inicio" style="display: inline-block;width: 112px;height: 66px;text-indent: -99999px;">-->
				  <img src="<?php echo base_url() ?>resources/imagenes/logosmall.png"/>
				<!--</a>-->
				<!--
				<br/>
				<span style="color:#000000;display:block;font-family:arial;letter-spacing: 3px;text-transform: uppercase; font-size: 8px; ">Grupo Avicola Navallo</span>-->
			</div>			
			<div style="font-weight:normal;text-align:center;color:#2E6E9E;text-shadow: 0 1px 2px #999;font-size:22px;width: 100%;"><span style="font-weight: bold;color: #D17703; ">ALG</span> SISTEMA DE COBRANZA</div>				
			<div id="user">
				 <!-----header----->				
			</div>			
		</div>
		<div id="cuerpo" style="color:#5B5B5B;">
			<div id='titulo' style="text-align:left">
			    <div style="font-size: 22px;font-weight: bold;text-align: center;"><?php echo isset($sub_titulo)?$sub_titulo:"";?></div>
				<div style="text-align:left;font-size: 14px;font-weight: bold;"><?php echo isset($titulo)?$titulo:"";?></div>
				<div style="text-align:left;font-size: 12px;"><?php echo isset($descripcion)?$descripcion:"";?></div>
                <div style="text-align:left;font-size: 12px;">Enviado el <?php echo isset($fecha_literal)?$fecha_literal:"";?></div>
			</div>
			<div style="padding:10px;" id='contenido'>
				<?php echo $content_for_layout; ?>
			</div>
		</div>
		<p style="font-size:11px; line-height:15px; color:#444; padding: 15px 0;text-align: left;">
                  Este es un mensaje generado de manera autom&aacute;tica. Por favor no responda a este mensaje.<br />
                  Si tiene alguna consulta cont&aacute;ctese con nosotros. Gracias.
        </p>
		<!-- Footer -->
		<footer id="footer" style="height:70px; background:#88A0B4;color:#003D82;font-size:11px;text-align:center;">		 		
			<div style="background:#88A0B4;color:#003D82;font-size:11px;text-align:center;font-weight:normal;padding: 10px 0;">Copyright &copy; <span>ALG - SOFT</span> 2013 | Todos los Derechos Reservados</div>	
            <div style="background:#88A0B4;color:#003D82;font-size:11px;text-align:center;">Calle Esteban Arze No. 576 - Galeria Los Angeles Piso 2, Tel&eacute;fono (591) 76993573,</label> <a style="color:#35659f; font-size:9px" href="mailto:sistemas@algsa.com.bo">sistemas@algsa.com.bo</a></div> 
            <div style="background:#88A0B4;color:#003D82;font-size:11px;text-align:center;">Cochabamba - Bolivia</div>   			
		</footer>
		<!--
		<div id="pie" style="color:green">
		<b>Nota: Por favor no responda a este correo</b>
		</div>-->
		</div>
		</center>
	</body>