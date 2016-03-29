<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->cliente ){ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript">
   function comprobar_url()
   {
      if(window.location.hash.substring(1) == 'cuentasb')
      {
         mostrar_seccion('cuentasb');
      }
      else if(window.location.hash.substring(1) == 'direcciones')
      {
         mostrar_seccion('direcciones');
      }
      else if(window.location.hash.substring(1) == 'subcuentas')
      {
         mostrar_seccion('subcuentas');
      }
      else if(window.location.hash.substring(1) == 'stats')
      {
         mostrar_seccion('stats');
      }
      else
      {
         mostrar_seccion('');
      }
   }
   function mostrar_seccion(id)
   {
      $(".pseudotab_cli").hide();
      $("#lista_botones_cli a").removeClass('active');
      
      if(id == 'cuentasb')
      {
         $("#panel_cuentasb").show();
         $("#b_cuentasb").addClass('active');
      }
      else if(id == 'direcciones')
      {
         $("#panel_direcciones").show();
         $("#b_direcciones").addClass('active');
      }
      else if(id == 'subcuentas')
      {
         $("#div_subcuentas").show();
         $("#b_subcuentas").addClass('active');
      }
      else if(id == 'stats')
      {
         $("#panel_stats").show();
         $("#b_stats").addClass('active');
      }
      else
      {
         $("#panel_generales").show();
         $("#b_generales").addClass('active');
         document.f_cliente.nombre.focus();
      }
   }
   function mostrar_tab(name)
   {
      $(".pseudotab_cli").hide();
      $("#lista_botones_cli a").removeClass('active');
      
      $("#ext_"+name).show();
      $("#b_ext_"+name).addClass('active');
      
      return false;
   }
   function delete_cuenta(id)
   {
      if( confirm('¿Realmente desea eliminar la cuenta bancaria #'+id+'?') )
      {
         window.location.href = '<?php echo $fsc->url();?>&delete_cuenta='+id+'#cuentasb';
      }
   }
   $(document).ready(function() {
      comprobar_url();
      window.onpopstate = function() {
         comprobar_url();
      }
      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         if( confirm("¿Realmente desea eliminar este OBJETIVO?") )
            window.location.href = '<?php echo $fsc->ppage->url();?>&delete=<?php echo $fsc->cliente->codcliente;?>';
      });
      $("#b_nueva_cuenta").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_cuenta").modal('show');
         document.f_nueva_cuenta.descripcion.focus();
      });
      $("#b_nueva_direccion").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_direccion").modal('show');
         document.f_nueva_direccion.provincia.focus();
      });
   });
</script>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
   <div class="row">
      <div class="col-sm-3 col-xs-3">
         <a href="<?php echo $fsc->url();?>" class="btn btn-sm btn-default" title="Recarga la página">
            <span class="glyphicon glyphicon-refresh"></span>
         </a>
         <a href="<?php echo $fsc->ppage->url();?>" class="btn btn-sm btn-default">
            <span class="glyphicon glyphicon-arrow-left"></span>
            <span class="hidden-xs">&nbsp; OBJETIVOS</span>
         </a>
      </div>
      <div class="col-sm-7 col-xs-7 text-center">
         <h2 style="margin-top: 0px;">Editar OBJETIVO <?php echo $fsc->cliente->codcliente;?></h2>
      </div>
      <div class="col-sm-2 col-xs-2 text-right">
         <a class="btn btn-sm btn-success" href="index.php?page=ventas_clientes#nuevo" title="Nuevo cliente">
            <span class="glyphicon glyphicon-plus"></span>
         </a>
         <?php if( $fsc->allow_delete ){ ?>

            <?php if( $fsc->cliente->debaja ){ ?>

            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_debaja">
               <span class="glyphicon glyphicon-lock"></span>
               <span class="hidden-xs">&nbsp; De baja</span>
            </a>
            <?php }elseif( $fsc->tiene_facturas() ){ ?>

            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal_debaja">
               <span class="glyphicon glyphicon-lock"></span>
               <span class="hidden-xs">&nbsp; Dar de baja</span>
            </a>
            <?php }else{ ?>

            <a href="#" id="b_eliminar" class="btn btn-sm btn-danger">
               <span class="glyphicon glyphicon-trash"></span>
               <span class="hidden-xs">&nbsp; Eliminar</span>
            </a>
            <?php } ?>

         <?php } ?>

      </div>
   </div>
</div>

<?php if( isset($_GET['stats']) ){ ?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
   // Load the Visualization API and the piechart package.
   google.load('visualization', '1.0', {'packages':['corechart']});
   
   // Set a callback to run when the Google Visualization API is loaded.
   google.setOnLoadCallback(drawChart);
   
   // Callback that creates and populates a data table,
   // instantiates the pie chart, passes in the data and
   // draws it.
   function drawChart()
   {
      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'mes');
      data.addColumn('number', '<?php  echo FS_ALBARANES;?>');
      data.addColumn('number', 'facturas');
      data.addRows([
      <?php $loop_var1=$fsc->stats_from_cli(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

         ['<?php echo $value1['mes'];?>', <?php echo $value1['albaranes'];?>, <?php echo $value1['facturas'];?>],
      <?php } ?>

      ]);
      
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.AreaChart(document.getElementById('chart_albaranes_month'));
      chart.draw(data);
   }
</script>
<?php } ?>


<div class="container-fluid">
   <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-3">
         <div id="lista_botones_cli" class="list-group">
            <a id="b_generales" href="#" class="list-group-item active" onclick="mostrar_seccion('')">
               <span class="glyphicon glyphicon-dashboard"></span> &nbsp; Datos generales
            </a>
            <a id="b_direcciones" href="#direcciones" class="list-group-item" onclick="mostrar_seccion('direcciones')">
               <span class="glyphicon glyphicon-road"></span> &nbsp; Direcciones
            </a>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&codcliente=<?php echo $fsc->cliente->codcliente;?>" class="list-group-item">
                  <?php echo $value1->text;?>

               </a>
               <?php }elseif( $value1->type=='tab' ){ ?>

               <a href="#" id="b_ext_<?php echo $key1;?>" class="list-group-item" onclick="return mostrar_tab('<?php echo $key1;?>');">
                  <?php echo $value1->text;?>

               </a>
               <?php } ?>

            <?php } ?>


         </div>
      </div>
      
      <div class="col-lg-10 col-md-10 col-sm-9">
         <form name="f_cliente" action="<?php echo $fsc->url();?>" method="post" class="form">
            <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
            <div class='panel <?php if( $fsc->cliente->debaja ){ ?>panel-danger<?php }else{ ?>panel-primary<?php } ?> pseudotab_cli' id='panel_generales'>
               <div class="panel-heading">
                  <h3 class="panel-title">Datos generales</h3>
               </div>
               <div class="panel-body">
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              Nombre:
                              <input class="form-control" type="text" name="nombre" value="<?php echo $fsc->cliente->nombre;?>" autocomplete="off"/>
                              <p class="help-block">Nombre por el que se conoce al OBJETIVO. Para uso interno.</p>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              Razón social:
                              <input class="form-control" type="text" name="razonsocial" value="<?php echo $fsc->cliente->razonsocial;?>" autocomplete="off"/>
                              <p class="help-block">Nombre oficial del OBJETIVO, para documentos.</p>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group">
                              <br/>
                              <select name="tipoidfiscal" class="form-control">
                              <?php $tiposids=$this->var['tiposids']=fs_tipos_id_fiscal();?>

                              <?php $loop_var1=$tiposids; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <?php if( $value1==$fsc->cliente->tipoidfiscal ){ ?>

                                 <option value="<?php echo $value1;?>" selected=""><?php echo $value1;?></option>
                                 <?php }else{ ?>

                                 <option value="<?php echo $value1;?>"><?php echo $value1;?></option>
                                 <?php } ?>

                              <?php } ?>

                              </select>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group">
                              <?php  echo FS_CIFNIF;?>:
                              <input class="form-control" type="text" name="cifnif" value="<?php echo $fsc->cliente->cifnif;?>" autocomplete="off"/>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="checkbox">
                              <label>
                                 <input type="checkbox" name="personafisica" value="TRUE"<?php if( $fsc->cliente->personafisica ){ ?> checked=""<?php } ?>/>
                                 Es una persona física (no una empresa)
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-2">
                           <div class="form-group">
                              Teléfono 1:
                              <input class="form-control" type="text" name="telefono1" value="<?php echo $fsc->cliente->telefono1;?>" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group">
                              Teléfono 2:
                              <input class="form-control" type="text" name="telefono2" value="<?php echo $fsc->cliente->telefono2;?>" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group">
                              CAMPO EXTRA:
                              <input class="form-control" type="text" name="fax" value="<?php echo $fsc->cliente->fax;?>" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              CAMPO EXTRA 2:
                              <input class="form-control" type="text" name="email" value="<?php echo $fsc->cliente->email;?>" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              campo 3:
                              <input class="form-control" type="text" name="web" value="<?php echo $fsc->cliente->web;?>" autocomplete="off"/>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              <a href="index.php?page=ventas_clientes#grupos">Grupo de OBJETIVOS
                              </a>:
                              <select class="form-control" name="codgrupo">
                                 <option value="">Ninguno</option>
                                 <option value="">-----</option>
                                 <?php $loop_var1=$fsc->grupo->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <option value="<?php echo $value1->codgrupo;?>"<?php if( $value1->codgrupo==$fsc->cliente->codgrupo ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                                 <?php } ?>

                              </select>
                           </div>
                        </div>
                        <div class="col-sm-2" style="display: none">
                           <div class="form-group">
                              <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
                              <select class="form-control" name="codserie">
                                 <option value="">Predeterminada</option>
                                 <option value="">------</option>
                                 <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                    <?php if( $value1->codserie==$fsc->cliente->codserie ){ ?>

                                    <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                                    <?php }else{ ?>

                                    <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                                    <?php } ?>

                                 <?php } ?>

                              </select>
                           </div>
                        </div>
                        <div class="col-sm-2" style="display: none">
                           <div class="form-group">
                              <a href="<?php echo $fsc->divisa->url();?>">Divisa</a>:
                              <select class="form-control" name="coddivisa">
                              <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <?php if( $value1->coddivisa==$fsc->cliente->coddivisa ){ ?>

                                 <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
                                 <?php }else{ ?>

                                 <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
                                 <?php } ?>

                              <?php } ?>

                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4" style="display: none">
                           <div class="form-group" >
                              <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                              <select class="form-control" name="codpago">
                                 <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <option value="<?php echo $value1->codpago;?>"<?php if( $value1->codpago==$fsc->cliente->codpago ){ ?> selected=""<?php } ?>><?php echo $value1->descripcion;?></option>
                                 <?php } ?>

                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-4" style="display: none">
                           <div class="form-group" >
                              Régimen <?php  echo FS_IVA;?>:
                              <select class="form-control" name="regimeniva">
                                 <?php $loop_var1=$fsc->cliente->regimenes_iva(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <option value="<?php echo $value1;?>"<?php if( $value1==$fsc->cliente->regimeniva ){ ?> selected=""<?php } ?>><?php echo $value1;?></option>
                                 <?php } ?>

                              </select>
                              <label>
                                 <input type="checkbox" name="recargo" value="TRUE"<?php if( $fsc->cliente->recargo ){ ?> checked=""<?php } ?>/>
                                 Aplicar recargo de equivalencia
                              </label>
                           </div>
                        </div>
                        <div class="col-sm-4" style="display: none">
                           <div class="form-group">
                              <a href="<?php echo $fsc->agente->url();?>">Empleado asignado</a>:
                              <select class="form-control" name="codagente">
                                 <option value="">Ninguno</option>
                                 <option value="">-----</option>
                                 <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <option value="<?php echo $value1->codagente;?>"<?php if( $value1->codagente==$fsc->cliente->codagente ){ ?> selected=""<?php } ?>><?php echo $value1->get_fullname();?></option>
                                 <?php } ?>

                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              Observaciones:
                              <textarea class="form-control" name="observaciones" rows="3"><?php echo $fsc->cliente->observaciones;?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="panel-footer text-right">
                  <small class="pull-left">Fecha de alta: <?php echo $fsc->cliente->fechaalta;?></small>
                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
                  </button>
               </div>
            </div>
            
            <div class="modal fade" id="modal_debaja" tabindex="-1" role="dialog">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <?php if( $fsc->cliente->debaja ){ ?>

                        <h4 class="modal-title">
                           <span class="glyphicon glyphicon-lock"></span>
                           &nbsp; Este OBJETIVO ha sido dado de baja
                        </h4>
                        <p class="help-block">Concretamente el día <?php echo $fsc->cliente->fechabaja;?></p>
                        <?php }else{ ?>

                        <h4 class="modal-title">
                           <span class="glyphicon glyphicon-lock"></span>
                           &nbsp; ¿Deseas dar de baja al OBJETIVO?
                        </h4>
                        <p class="help-block">
                           Este OBJETIVO ya tiene facturas o <?php  echo FS_ALBARANES;?> relacionados,
                           por lo que no es recomendable eliminarlo.
                        </p>
                        <?php } ?>

                     </div>
                     <div class="modal-body">
                        <div class="checkbox">
                           <label>
                              <?php if( $fsc->cliente->debaja ){ ?>

                              <input type="checkbox" name="debaja" value="TRUE" checked=""/>
                              <?php }else{ ?>

                              <input type="checkbox" name="debaja" value="TRUE"/>
                              <?php } ?>

                              Dar de baja al OBJETIVO.
                           </label>
                           <p class="help-block">
                              Desaparecerá de las búsquedas,
                              Pero seguirá en el listado de OBJETIVOS por si cambias de idea.
                           </p>
                        </div>
                        <div class="text-right">
                           <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                              <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
         
         <div id="panel_cuentasb" class="pseudotab_cli">
            <?php $loop_var1=$fsc->cuenta_banco->all_from_cliente($fsc->cliente->codcliente); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <form action="<?php echo $fsc->url();?>#cuentasb" method="post" class="form">
               <input type="hidden" name="codcuenta" value="<?php echo $value1->codcuenta;?>"/>
               <input type="hidden" name="codcliente" value="<?php echo $value1->codcliente;?>"/>
               <div class="panel panel-info">
                  <div class="panel-heading">
                     <h3 class="panel-title">Cuenta bancaria #<?php echo $value1->codcuenta;?></h3>
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-sm-3">
                           <div class="form-group">
                              Descripción:
                              <input class="form-control" type="text" name="descripcion" value="<?php echo $value1->descripcion;?>" placeholder="Cuenta principal" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <a target="_blank" href="http://es.wikipedia.org/wiki/International_Bank_Account_Number">IBAN</a>:
                              <input class="form-control" type="text" name="iban" value="<?php echo $value1->iban;?>" maxlength="34" placeholder="ES12345678901234567890123456" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="form-group">
                              <a target="_blank" href="http://es.wikipedia.org/wiki/Society_for_Worldwide_Interbank_Financial_Telecommunication">SWIFT</a> o BIC:
                              <input class="form-control" type="text" name="swift" value="<?php echo $value1->swift;?>" maxlength="11" autocomplete="off"/>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-2">
                           <div class="form-group">
                              Fecha del mandato:
                              <input type="text" name="fmandato" value="<?php echo $value1->fmandato;?>" class="form-control datepicker" autocomplete="off"/>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <br/>
                           <p class="help-block">
                              Si el cliente ha autorizado la <b>domiciliación</b> de recibos, debes especificar
                              la fecha del mandato: la fecha en la que autorizó.
                           </p>
                        </div>
                        <div class="col-sm-2">
                           <br/>
                           <div class="checkbox">
                              <label>
                                 <?php if( $value1->principal ){ ?>

                                 <input type="checkbox" name="principal" value="TRUE" checked=""/>
                                 <?php }else{ ?>

                                 <input type="checkbox" name="principal" value="TRUE"/>
                                 <?php } ?>

                                 Esta es la cuenta principal del cliente
                              </label>
                           </div>
                        </div>
                        <div class="col-sm-4 text-right">
                           <br/>
                           <div class="btn-group">
                              <a class="btn btn-sm btn-danger" onclick="delete_cuenta('<?php echo $value1->codcuenta;?>');">
                                 <span class="glyphicon glyphicon-trash"></span>
                                 <span class="hidden-xs hidden-sm">&nbsp; Eliminar</span>
                              </a>
                              <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                                 <span class="glyphicon glyphicon-floppy-disk"></span>
                                 <span class="hidden-xs">&nbsp; Guardar</span>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
            <?php } ?>

            <div class="panel panel-success">
               <div class="panel-heading">
                  <h3 class="panel-title">
                     <a id="b_nueva_cuenta" href="#">
                        <span class="glyphicon glyphicon-plus-sign"></span>
                        &nbsp; Nueva cuenta bancaria...
                     </a>
                  </h3>
               </div>
            </div>
         </div>
         
         <div id="panel_direcciones" class="pseudotab_cli">
            <?php $loop_var1=$fsc->cliente->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <form action="<?php echo $fsc->url();?>#direcciones" method="post" class="form">
               <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
               <input type="hidden" name="coddir" value="<?php echo $value1->id;?>"/>
               <div class="panel panel-info">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="glyphicon glyphicon-road"></span> &nbsp; <?php echo $value1->descripcion;?>

                     </h3>
                  </div>
                  <div class="panel-body">
                     <div class="form-group col-sm-4">
                        <a href="<?php echo $fsc->pais->url();?>">País</a>
                        <select class="form-control" name="pais">
                        <?php $loop_var2=$fsc->pais->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                        <option value="<?php echo $value2->codpais;?>"<?php if( $value1->codpais==$value2->codpais ){ ?> selected=""<?php } ?>><?php echo $value2->nombre;?></option>
                        <?php } ?>

                        </select>
                     </div>
                     <div class="form-group col-sm-4">
                        <span class="text-capitalize"><?php  echo FS_PROVINCIA;?></span>:
                        <input class="form-control" type="text" name="provincia" id="ac_provincia" value="<?php echo $value1->provincia;?>"/>
                     </div>
                     <div class="form-group col-sm-4">
                        Ciudad:
                        <input class="form-control" type="text" name="ciudad" value="<?php echo $value1->ciudad;?>"/>
                     </div>
                     <div class="form-group col-sm-3">
                        Código Postal:
                        <input class="form-control" type="text" name="codpostal" value="<?php echo $value1->codpostal;?>"/>
                     </div>
                     <div class="form-group col-sm-9">
                        Dirección:
                        <input class="form-control" type="text" name="direccion" value="<?php echo $value1->direccion;?>" autocomplete="off"/>
                     </div>
                     <div class="form-group col-sm-3" style="display: none">
                        <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                        <input class="form-control" type="text" name="apartado" value="<?php echo $value1->apartado;?>" autocomplete="off"/>
                     </div>
                     <div class="form-group col-sm-3" style="display: none">
                        <div class="checkbox">
                        <label>
                           <input type="checkbox" name="direnvio" value="TRUE"<?php if( $value1->domenvio ){ ?> checked=""<?php } ?>/>
                           Dirección de envío
                        </label>
                        </div>
                        <div class="checkbox" style="display: none"> 
                        <label>
                           <input type="checkbox" name="dirfact" value="TRUE"<?php if( $value1->domfacturacion ){ ?> checked=""<?php } ?>/>
                           Dirección de facturación
                        </label>
                        </div>
                     </div>
                     <div class="form-group col-sm-6">
                        Descripción:
                        <input class="form-control" type="text" name="descripcion" value="<?php echo $value1->descripcion;?>" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="panel-footer text-right">
                     <a class="btn btn-sm btn-danger pull-left" href="<?php echo $fsc->url();?>&delete_dir=<?php echo $value1->id;?>#direcciones">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; Eliminar
                     </a>
                     <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                        <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
                     </button>
                  </div>
               </div>
            </form>
            <?php } ?>

            <div class="panel panel-success">
               <div class="panel-heading">
                  <h3 class="panel-title">
                     <a id="b_nueva_direccion" href="#">
                        <span class="glyphicon glyphicon-plus-sign"></span>
                        &nbsp; Nueva dirección...
                     </a>
                  </h3>
               </div>
            </div>
         </div>
         
         <div class="table-responsive pseudotab_cli" id="div_subcuentas">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">Ejercicio</th>
                     <th></th>
                     <th class="text-left">Subcuenta + Descripción</th>
                     <th class="text-right">Debe</th>
                     <th class="text-right">Haber</th>
                     <th class="text-right">Saldo</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->cliente->get_subcuentas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr>
                  <td><div class="form-control"><?php echo $value1->codejercicio;?></div></td>
                  <td class="text-right">
                     <a class="btn btn-sm btn-default" href="index.php?page=subcuenta_asociada&cli=<?php echo $fsc->cliente->codcliente;?>&idsc=<?php echo $value1->idsubcuenta;?>">
                        <span class="glyphicon glyphicon-wrench"></span>
                     </a>
                  </td>
                  <td>
                     <div class="form-control">
                        <a href="<?php echo $value1->url();?>"><?php echo $value1->codsubcuenta;?></a> <?php echo $value1->descripcion;?>

                     </div>
                  </td>
                  <td>
                     <div class="form-control text-right"><?php echo $fsc->show_precio($value1->debe, $value1->coddivisa);?></div>
                  </td>
                  <td>
                     <div class="form-control text-right"><?php echo $fsc->show_precio($value1->haber, $value1->coddivisa);?></div>
                  </td>
                  <td>
                     <div class="form-control text-right"><?php echo $fsc->show_precio($value1->saldo, $value1->coddivisa);?></div>
                  </td>
               </tr>
               <?php } ?>

               <tr>
                  <td colspan="6" class="text-center">
                     <a class="btn btn-sm btn-block btn-success" href="index.php?page=subcuenta_asociada&cli=<?php echo $fsc->cliente->codcliente;?>">
                        Asignar una nueva subcuenta...
                     </a>
                  </td>
               </tr>
            </table>
         </div>
         
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <div id="ext_<?php echo $key1;?>" class="pseudotab_cli">
               <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&cod=<?php echo $fsc->cliente->codcliente;?>" width="100%" height="600" frameborder="0"></iframe>
            </div>
            <?php } ?>

         <?php } ?>

         
         <div id="panel_stats" class="pseudotab_cli">
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <h3 class="panel-title">Estadísticas</h3>
               </div>
               <div class="panel-body">
                  <div id="chart_albaranes_month" style="height: 400px;"></div>
               </div>
               <div class="panel-footer">
                  <p class="help-block">
                     Estas son las estadísticas de <?php  echo FS_ALBARANES;?> y facturas del cliente
                     de los últimos años. Los valores son netos.
                  </p>
                  <p class="help-block">
                     Puedes consultar informes de ventas más detallados en <b>Informes &gt; Facturas</b>.
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<form name="f_nueva_cuenta" action="<?php echo $fsc->url();?>#cuentasb" method="post" class="form">
   <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
   <div class="modal" id="modal_nueva_cuenta">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-credit-card"></span>
                  &nbsp; Nueva cuenta bancaria
               </h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Descripción:
                  <input class="form-control" type="text" name="descripcion" placeholder="Banco XXX" autocomplete="off" required=""/>
                  <label>
                     <input type="checkbox" name="principal" value="TRUE" checked=""/>
                     Principal
                  </label>
               </div>
               <div class="form-group">
                  <a target="_blank" href="http://es.wikipedia.org/wiki/International_Bank_Account_Number">IBAN</a>:
                  <input class="form-control" type="text" name="iban" maxlength="34" placeholder="ES12345678901234567890123456" autocomplete="off"/>
               </div>
               <div class="form-group">
                  <a target="_blank" href="http://es.wikipedia.org/wiki/Society_for_Worldwide_Interbank_Financial_Telecommunication">SWIFT</a> o BIC:
                  <input class="form-control" type="text" name="swift" maxlength="11" autocomplete="off"/>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>

<form name="f_nueva_direccion" action="<?php echo $fsc->url();?>#direcciones" method="post" class="form">
   <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
   <input type="hidden" name="coddir" value=""/>
   <div class="modal" id="modal_nueva_direccion">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-road"></span>
                  &nbsp; Nueva dirección
               </h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <a href="<?php echo $fsc->pais->url();?>">País</a>:
                  <select name="pais" class="form-control">
                     <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <option value="<?php echo $value1->codpais;?>"<?php if( $value1->is_default() ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                     <?php } ?>

                  </select>
               </div>
               <div class="form-group">
                  <span class="text-capitalize"><?php  echo FS_PROVINCIA;?>:</span>
                  <input id="ac_provincia2" class="form-control" type="text" name="provincia" value="<?php echo $fsc->empresa->provincia;?>"/>
               </div>
               <div class="form-group">
                  Ciudad:
                  <input class="form-control" type="text" name="ciudad" value="<?php echo $fsc->empresa->ciudad;?>"/>
               </div>
               <div class="form-group">
                  Código Postal:
                  <input class="form-control" type="text" name="codpostal"/>
               </div>
               <div class="form-group">
                  Dirección:
                  <input class="form-control" type="text" name="direccion" autocomplete="off"/>
               </div>
               <div class="form-group" style="display: none">
                  <span class="text-capitalize"><?php  echo FS_APARTADO;?>:</span>
                  <input class="form-control" type="text" name="apartado" autocomplete="off"/>
               </div>
               <div class="form-group">
                  Descripción:
                  <input class="form-control" type="text" name="descripcion" value="Nueva dirección"/>
                  <label style="display: none">
                     <input type="checkbox" name="direnvio" id="ndirenvio" value="TRUE" checked=""/>
                     Dirección de envío
                  </label>
                  <label style="display: none">
                     <input type="checkbox" name="dirfact" id="ndirfact" value="TRUE" checked=""/>
                     Dirección de facturación
                  </label>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>
<?php }else{ ?>

<div class="thumbnail">
   <img src="view/img/fuuu_face.png" alt="fuuuuu"/>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>