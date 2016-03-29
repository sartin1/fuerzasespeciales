<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>

<?php if( $fsc->cerrado!=true ){ ?>
	<script type="text/javascript">
		function fs_marcar_todo()
		{
			$('#f_enable_backup input:checkbox').prop('checked', true);
		}
		function fs_marcar_nada()
		{
			$('#f_enable_backup input:checkbox').prop('checked', false);
		}
	</script>

	<div class="panel panel-info" style="margin: 5px;">
		<div class="panel-heading">
			<h3 class="panel-title">Backup de la Base de Datos MySQL</h3>
		</div>

		<form name="f_enable_backup" id="f_enable_backup" action="<?php echo $fsc->url();?>" method="post" class="form">
		   <div class="container-fluid" style="margin-top: 25px; margin-bottom: 25px;">
			  <div class="row">
				 <div class="col-lg-2 col-md-2 col-sm-2">
					<div class="btn-group">
					   <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_todo()" title="Marcar todo">
						  <span class="glyphicon glyphicon-check"></span>
					   </button>				   
					   <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_nada()" title="Desmarcar todo">
						  <span class="glyphicon glyphicon-unchecked"></span>
					   </button>
					</div>
				 </div>
				 <div class="col-lg-4 col-md-4 col-sm-4 text-center">
					<div class="btn-group">				 
					  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='<?php echo $fsc->url();?>&tipo_backup=selestructura';this.form.submit();">
						 <span class="glyphicon glyphicon-floppy-disk"></span>
						 &nbsp; Respaldar Estructura de las Tablas Seleccionadas
					  </button>
					</div>
				 </div>					  
				 <div class="col-lg-4 col-md-4 col-sm-4 text-center">
					<div class="btn-group">						  
					  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='<?php echo $fsc->url();?>&tipo_backup=seltodo';this.form.submit();">
						 <span class="glyphicon glyphicon-floppy-disk"></span>
						 &nbsp; Respaldar Estructura + Datos de las Tablas Seleccionadas
					  </button>
					</div>
				 </div>
			  </div>
		   </div>

		   <div class="table-responsive">
			  <table class="table table-hover">
				 <thead>
					<tr>
					   <th class="text-left">Tablas</th>
					   <th class="text-left">Columnas / Campos</th>
					</tr>
				 </thead>
				 <?php $loop_var1=$fsc->tabla; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>
				 <tr>
					<td style="width:15%;">
					   <input class="checkbox-inline" type="checkbox" name="enabled[]" value="<?php echo $key1;?>"/>
					   &nbsp;<?php echo $key1;?>
					</td>
					<td><?php echo $value1;?></td>
				 </tr>
				 <?php } ?>
			  </table>
		   </div>
		   
		   <div class="container-fluid" style="margin-bottom: 30px;">
			  <div class="row">
				 <div class="col-lg-2 col-md-2 col-sm-2">
					<div class="btn-group">
					   <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_todo()" title="Marcar todo">
						  <span class="glyphicon glyphicon-check"></span>
					   </button>
					   <button class="btn btn-sm btn-default" type="button" onclick="fs_marcar_nada()" title="Desmarcar todo">
						  <span class="glyphicon glyphicon-unchecked"></span>
					   </button>
					</div>
				 </div>
				 <div class="col-lg-4 col-md-4 col-sm-4 text-center">
					<div class="btn-group">				 
					  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='<?php echo $fsc->url();?>&tipo_backup=selestructura';this.form.submit();">
						 <span class="glyphicon glyphicon-floppy-disk"></span>
						 &nbsp; Respaldar Estructura de las Tablas Seleccionadas
					  </button>
					</div>
				 </div>					  
				 <div class="col-lg-4 col-md-4 col-sm-4 text-center">
					<div class="btn-group">						  
					  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.action='<?php echo $fsc->url();?>&tipo_backup=seltodo';this.form.submit();">
						 <span class="glyphicon glyphicon-floppy-disk"></span>
						 &nbsp; Respaldar Estructura + Datos de las Tablas Seleccionadas
					  </button>
					</div>
				 </div>
			  </div>
		   </div>

		</form>
	</div>
<?php } ?>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>