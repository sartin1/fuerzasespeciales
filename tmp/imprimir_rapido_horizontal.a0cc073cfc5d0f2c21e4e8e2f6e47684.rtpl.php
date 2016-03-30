<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header2") . ( substr("header2",-1,1) != "/" ? "/" : "" ) . basename("header2") );?>

<script type="text/javascript">window.print()</script>
<center> <img src="logo.png" align="right" style="margin-top: 40px;margin-right: 30px;">
Descripción punto de brecha - Solicitó <?php echo $fsc->servicio->solucion;?> - Lugar: <?php echo $fsc->servicio->direccion;?> (<?php echo $fsc->servicio->ciudad;?>) - Orden N°: <?php echo $fsc->servicio->idservicio;?>

<hr>
            <div class="container-fluid" >   
               <div class="row">
               <div class="col-sm-3 ">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Lado Blanco</div>
                               <?php echo $fsc->servicio->material;?>

                        </div>
                      </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Lado Negro</div>
                           <?php echo $fsc->servicio->material_estado;?>

                        </div>
                      </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Lado Rojo</div>
                           <?php echo $fsc->servicio->accesorios;?>

                        </div>
                      </div>
                  </div>
                   <div class="col-sm-3">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Lado Verde</div>
                           <?php echo $fsc->servicio->descripcion;?>

                        </div>
                      </div>
                  </div>
                  <div class="row"><br><br><br><br><br><br><br><br><br>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Brechero principal</div>
                           <?php echo $fsc->servicio->brprincipal;?>

                        </div>
                      </div>
                  </div>
                   <div class="col-sm-6">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Brechero Auxiliar</div>
                           <?php echo $fsc->servicio->braux;?>

                        </div>
                      </div>
                  </div>
                </div>
                 <center><h2>Tipos de Brecha</h2></center>
                  <hr>
             <div class="row">
                   <div class="col-sm-4" >
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Manual</div>
                           <?php echo $fsc->servicio->manual;?>

                        </div>
                      </div>
                  </div>
               
                <div class="col-sm-4">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Mecánica</div>
                           <?php echo $fsc->servicio->mecanica;?>

                        </div>
                      </div>
                  </div>
               
                <div class="col-sm-4">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Balística</div>
                           <?php echo $fsc->servicio->balistica;?>

                        </div>
                      </div>
                  </div>
               </div> </div>
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Explosiva</div>
                           <?php echo $fsc->servicio->explosiva;?>

                        </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Especial</div>
                           <?php echo $fsc->servicio->especial;?>

                        </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Combinada</div>

                           <?php echo $fsc->servicio->combinada;?>

                        </div>
                      </div>
                  </div>
               </div><br><br><br>
              <center><h2>Reporte de apertura</h2></center>
                    <hr>
                  <div class="row">
                   <div class="col-sm-4">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">¿Funcionó conforme a lo acordado?</div>
                         <div class="row" style="margin-left: 20px;margin-top: 20px;margin-bottom: 20px">
                           <?php echo $fsc->servicio->repconf;?>

                        </div></div>
                      </div>
                  </div>
                    <div class="col-sm-8">
                     <div class="form-group">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Reporte de apertura</div>
                           <div class="row" style="margin-left: 20px">
                           <div class="form-group" ><h4>Observaciones:</h4>
                              <?php echo $fsc->servicio->obsapertura;?>

                            </div></div> 
                            <div class="row">
                            <div class="col-sm-3" style="margin-left:20px;">
                             Cantidad de arietasos: <?php echo $fsc->servicio->arietasoscant;?>

                              </div>
                            
                            <div class="col-sm-3" style="margin-left:20px;">
                              Cantidad balísticas: <?php echo $fsc->servicio->balisiticascant;?>

                              </div>
                           </div>   
                        </div>
                      </div>
                  </div>
                  </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                   <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

           
               <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&id=<?php echo $fsc->servicio->idservicio;?>" width="100%" height="1000" frameborder="0"></iframe>
            
            <?php } ?>

         <?php } ?>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>