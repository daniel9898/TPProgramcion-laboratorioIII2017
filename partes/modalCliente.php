<div class="container">
  <div class="modal fade" id="ModalClientes" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Vehiculos :</h4>
        </div>
        <div id="bModalClient" class="modal-body">
           <table id ="tabVehic" class="table table-hover table-responsive">
                <thead>
                  <tr>
                    <th> Color   </th>       
                    <th> Marca   </th>
                    <th> Patente </th>
                  </tr>
                </thead>
                <tbody id="filas"> 

                <tr>
                  <td><input type="text"/></td>
                  <td><input type="text"/></td>
                  <td><input type="text"/></td>
                  <td><a class='btn btn-sm btn-success btn-block'>Estacionar</a></td>
                </tr>
                </tbody> 
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
        </div>
      </div>
    </div>
  </div>
</div>
