<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        
        <meta charset="iso-8859">
        <title>Lista de clientes</title>

        
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.3.min.js"> </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.jqueryui.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    </head>
    <body>
        <div align="center">
            <h3>Lista de Clientes</h3>

            <br>
            
        </div>

        <div class="row">
            <div id="divButtonBot" class="pull-left" >
                <button onclick="ChamarModalCad('0', 'save')" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#cadBot">
                    <i class="fas fa-plus-circle"></i> Cadastrar Cliente
                </button>
            </div>
            <br>
            <br>
            <br>
            <br />
            <div class="modal fade" id="cadClient" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-center text-primary"><i class="fa fa-user-plus"></i> Cadastro de Cliente</h4>
                            <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input name="id" type="text" class="form-control" id="idClient" style="visibility: hidden;" placeholder="Nome do cliente" />
                            </div>
                            <div class="form-group">
                                <label for="Name" class="control-label"><strong>Nome Cliente:</strong></label>
                                <input name="Name" type="text" class="form-control" id="Name" placeholder="Nome do cliente" />
                            </div>
                            <div class="form-group">
                                <label for="DateNasc" class="control-label"><strong>Data Nascimento:</strong></label>
                                <input name="DateNasc" type="date" class="form-control" id="DateNasc" placeholder="Data Nascimento do cliente" />
                            </div>
                            <div class="form-group">
                                <label for="CPF" class="control-label"><strong>CPF:</strong></label>
                                <input name="CPF" type="text" class="form-control" id="CPF" placeholder="CPF do Cliente" />
                            </div>
                            <div class="form-group">
                                <label for="RG" class="control-label"><strong>RG:</strong></label>
                                <input name="RG" type="text" class="form-control" id="RG" placeholder="RG do Cliente" />
                            </div>
                            <div class="form-group">
                                <label for="Tel" class="control-label"><strong>Telefone:</strong></label>
                                <input name="Tel" type="text" class="form-control" id="Tel" placeholder="Telefone do Cliente" />
                            </div>
                            <div class="modal-footer">
                                <button id="saveClient" class="btn btn-success" data-dismiss="modal" style="visibility: hidden;"><i class="fas fa-check-circle"></i> Salvar</button>
                                <button id="updateClient" class="btn btn-success" data-dismiss="modal" style="visibility: hidden;"><i class="fas fa-check-circle"></i> Alterar</button>
                                <button id="Retornar" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-close"></i> Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                    <!-- page-content" -->
        <div id="tableData" align="center">
            <table id="tableDataTD" style="width: 100%;"></table>
        </div>
    </body>
</html>

<script type="text/javascript"> 
    $(document).ready(function () {
        GetClient();
        //GetClientForID();
    });

    $('#close').click(function (){
        $("#saveClient").css("visibility", "hidden");
        $("#updateClient").css("visibility", "hidden");
    });

    $('#Retornar').click(function (){

        $("#saveClient").css("visibility", "hidden");
        $("#updateClient").css("visibility", "hidden");
    });

    $('#saveClient').click(function (){
        InserirCliente("0");
        $("#saveClient").css("visibility", "hidden");
        $("#updateClient").css("visibility", "hidden");
    });

    $('#updateClient').click(function (){
        AlterarCliente($("#idClient").val());
        $("#saveClient").css("visibility", "hidden");
        $("#updateClient").css("visibility", "hidden");
    });

    function ChamarModalCad(id, action){
        $("#cadClient").modal("show");
        $("#idClient").val(id);

        if (action == 'save'){
            $("#saveClient").css("visibility", "visible");
        }
        else if (action == 'update'){
            GetClientForID(id); 
            $("#updateClient").css("visibility", "visible");
        }
    }

    function CleanFields(){
        $("#Name").val('');
        $("#DateNasc").val('');
        $("#CPF").val('');
        $("#RG").val('');
        $("#Tel").val('');
    }

    function InserirCliente(id){        
        $.ajax({
            url: 'http://localhost/php_KABUM/DAO/ClientDB.php',
            cache: true,
            bsort: false,
            data: {saveClient : '1',idCliente: id, name: $("#Name").val(), dtbirth: $("#DateNasc").val(), CPF: $("#CPF").val(), RG: $("#RG").val(),Telefone: $("#Tel").val()},
            type: 'POST',
            success: function (dataSet) {
                var result = JSON.parse(dataSet);
                alert(result.msg);
                CleanFields();
                GetClient();
            },
            error: function (data, textStatus) {
                alert(textStatus);
            }
        }).fail(function (jqXHR, textStatus) {
            alert(textStatus);
        });

        $("#idClient").val('');
    };

    function AlterarCliente(id){
        $.ajax({
            url: 'http://localhost/php_KABUM/DAO/ClientDB.php',
            cache: true,
            bsort: false,
            data: {updateClient : '1',idCliente: id, name: $("#Name").val(), dtbirth: $("#DateNasc").val(), CPF: $("#CPF").val(), RG: $("#RG").val(),Telefone: $("#Tel").val()},
            type: 'POST',
            success: function (dataSet) {
                var result = JSON.parse(dataSet);
                alert(result.msg);
                CleanFields();
                GetClient();
            },
            error: function (data, textStatus) {
                alert(textStatus);
            }
        }).fail(function (jqXHR, textStatus) {
            alert(textStatus);
        });

        $("#idClient").val('');
    };

    function ExcluirCliente(id){
        var apagar = confirm('Deseja realmente excluir este registro?');
        if (apagar){
            $.ajax({
            url: 'http://localhost/php_KABUM/DAO/ClientDB.php',
            cache: true,
            bsort: false,
            data: {deleteClient : '1',idCliente: id},
            type: 'POST',
            success: function (dataSet) {
                var result = JSON.parse(dataSet);
                alert(result.msg);

                GetClient();
            },
            error: function (data, textStatus) {
                alert(textStatus);
            }
            }).fail(function (jqXHR, textStatus) {
                alert(textStatus);
            });
        }        
    };

    function GetClientForID(idClient) {
        $.ajax({
            url: 'http://localhost/php_KABUM/DAO/ClientDB.php',
            data: {getClientForID : '1', id : idClient},
            type: 'GET',
            success: function (dataSet) {
                var result = JSON.parse(dataSet);
                
                $.each(result, function (index, value) {
                    
                    $.each(value, function (index, value2) { 
                        $("#Name").val(value2.name);
                        $("#DateNasc").val(value2.dtbirth);
                        $("#CPF").val(value2.CPF);
                        $("#RG").val(value2.RG);
                        $("#Tel").val(value2.telephone);                  
                    });
                });
            },
            error: function (data, textStatus) {
                alert(textStatus);
            }
        }).fail(function (jqXHR, textStatus) {
            alert(textStatus);
        });
    };

    function GetClient() {
        $.ajax({
            url: 'http://localhost/php_KABUM/DAO/ClientDB.php',
            cache: true,
            bsort: false,
            data: {getClient : '1'},
            type: 'GET',
            success: function (dataSet) {
                var result = JSON.parse(dataSet);
                
                var table = $('table').DataTable({
                    columns: [
                        { title: ""},
                        { title: ""},
                        { title: "ID"},
                        { title: "Nome Cliente" },
                        { title: "Data Nascimento" },
                        { title: "CPF" },
                        { title: "RG" },
                        { title: "Telefone" },
                    ],
                    retrieve: true
                });

                table.clear().draw();
                table.columns.adjust().draw();
                $.each(result, function (index, value) {
                    console.log(value);
                    $.each(value, function (index, value2) {
                    table.row.add([
                        '<a onclick=ChamarModalCad('+ value2.id+',"update") href="#" data-html="true" data-placement="top" data-trigger="hover" data-toggle="popover"> Alterar</a>',
                        '<a onclick=ExcluirCliente('+ value2.id+') href="#" data-html="true" data-placement="top" data-trigger="hover" data-toggle="popover"> Excluir</a>',
                        value2.id,
                        value2.name,
                        value2.dtbirth,
                        value2.CPF,
                        value2.RG,
                        value2.telephone
                    ]).draw();
                    });
                });
            },
            error: function (data, textStatus) {
                alert(textStatus);
            }
        }).fail(function (jqXHR, textStatus) {
            alert(textStatus);
        });
    };
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-message-box@3.2.1/dist/messagebox.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-message-box@3.2.1/dist/messagebox.min.js"></script>