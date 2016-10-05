<div class="banner">
    <img src="img/IMG_1709.jpg" class="banner" alt="Programas de preincubación">
    <div class="hero_pro">
        <hgroup>
            <h1>Curso Leader</h1>        
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse harum molestias explicabo dolore illo accusamus amet, cupiditate ullam. Quaerat expedita minus consequuntur veritatis. Eos, qui. A quam dolorum illo quisquam?</p>
            <h3>Inicia domingo 02 de octubre de 2016 <h2>$/.400</h2></h3>
        </hgroup>
    </div>
</div>
<div class="container">
    <div class="formulario">
        <h1 class="text-center">
            COMPLETA TU REGISTRO DESDE AQUI
        </h1>
        <form action="" class="form-horizontal">
            <div class="form-group col-md-12">
                <label for="Nombres" class="col-md-3 control-label pos-lab">Nombres:</label>
                <div class="col-md-6">
                    <input type="text" id="Nombres" class="form-control">    
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="Apellidos" class="col-md-3 control-label pos-lab">Apellidos:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="Apellidos">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="DNI" class="col-md-3 pos-lab control-label">DNI:</label>
                <div class="col-md-6">
                    <input type="number" class="form-control" id="DNI">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="Distrito" class="col-md-3 pos-lab control-label">Distrito:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="Distrito">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="centro" class="col-md-3 pos-lab control-label">Centro de estudios:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="centro">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="" class="col-md-3 pos-lab control-label">Selecciona tu programa:</label>
                <div class="col-md-6">
                    <table class="table table-responsive">
                        <thead>
                          <tr>
                              <th>Programa</th>
                              <th>Lugar</th>
                              <th>Fecha inicio</th>
                          </tr>
                        </thead>
                        <tbody class="opc-program">
                            <tr class="opc_p" onclick="color_sel(this)">
                                <td>Proin</td>
                                <td>CETIC UNI</td>
                                <td>05/10/2016</td>
                            </tr>
                            <tr class="opc_p" onclick="color_sel(this)">
                                <td>Incuba</td>
                                <td>San Marcos</td>
                                <td>29/09/2016</td>
                            </tr>
                            <tr class="opc_p" onclick="color_sel(this)">
                                <td>Aceleracion</td>
                                <td>UNI</td>
                                <td>02/10/2016</td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
        </form>
    </div>
    <div class="baucher">
        <h1 class="text-center">
            Vía BOUCHER DE PAGO
        </h1>
        <div class="col-md-3"></div>
        <div class="rule1 col-md-7">
            <p>1. Hacer el pago a cuenta corriente: En moneda nacional (S/.) BCP: <strong>191-2279261-0-37 </strong></p>
            <p>Código de Cuenta intercambio: <strong>00219100227926503754</strong></p>
        </div> 
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <p>Titular: Nedaca S.A.C</p>
            <p>2. Sube la imagén del boucher de pago.</p>
            <span class="btn btn-default btn-file">
                <input type="file" id="carg">    
            </span>
             <br>
        </div>
       <!--  <div class="col-md-3"></div>
        <div class="file col-md-6">
            Drag and Drop
        </div> -->
    </div>
    <div class="col-md-12 btn-insc"> <br>
       <div class="col-xs-6"></div>
        <button class="text-center btn" id="enviar-ins">
            Inscribirme
        </button>
    </div>
</div>