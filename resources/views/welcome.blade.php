<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


</head>
<body>
    <div class="container mt-2 d-flex flex-column align-content-center justify-content-center">
        <div class="d-flex justify-content-around">
            <h2>Cadastro de Pacientes</h2>

            <div>
                <button class="btn btn-success" data-toggle="modal" data-target="#post-pacient-modal">Cadastrar Paciente</button>
            </div>
        </div>

        <table class="table" id="pacients-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Foto</th>
                    <th scope="col">#</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>


    <!-- Post Pacient Modal -->
    <div class="modal fade" id="post-pacient-modal" tabindex="-1" role="dialog" aria-labelledby="post-pacient-modal" aria-hidden="true">
        <form id='post-pacient-form' method="post" enctype="multipart/form-data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="post-pacient-modal-label">Cadastrar Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Data de Nascimento</label>
                            <input type="date" id="birth_date" name="birth_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" class="form-control" placeholder="000.000.000.00" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone_number">Telefone</label>
                            <input type="text" id="telephone_number" name="telephone_number" class="form-control" placeholder="(85) 9999-9999" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_photo">Foto <i class="far fa-question-circle" data-toggle="tooltip" data-placement="top" title="Utilize uma foto 3x4"></i></label>
                            <input type="file" id="profile_photo" name="profile_photo" class="form-control-file" accept="image/png, image/jpeg" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" id='post-pacient-submit' class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Put Pacient Modal -->
    <div class="modal fade" id="put-pacient-modal" tabindex="-1" role="dialog" aria-labelledby="put-pacient-modal" aria-hidden="true">
        <form id='put-pacient-form' enctype="multipart/form-data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="put-pacient-modal-label">Atualizar Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="put_id" name="id">
                        @method('put')

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" id="put_name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Data de Nascimento</label>
                            <input type="date" id="put_birth_date" name="birth_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" id="put_cpf" name="cpf" class="form-control" placeholder="000.000.000.00" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone_number">Telefone</label>
                            <input type="text" id="put_telephone_number" name="telephone_number" class="form-control" placeholder="(85) 9999-9999" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_photo">Foto <i class="far fa-question-circle" data-toggle="tooltip" data-placement="top" title="Utilize uma foto 3x4"></i></label>
                            <input type="file" id="put_profile_photo" name="profile_photo" class="form-control-file" accept="image/png, image/jpeg" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" id='put-pacient-submit' class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="toast" id="toast" style="position: absolute; top: 0; right: 0;" data-delay="1500">
        <div class="toast-header bg-primary">
            <strong class="mr-auto text-white" id="toast-title"></strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toast-body">

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://kit.fontawesome.com/cd3e3a237a.js" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            // anonymous original author, but here's a good source: http://www.tidbits.com.br/colecao-de-metodos-para-o-plugin-validate-do-jquery
            (function($) {
                $.validator.addMethod('cpf', function(value, element, param) {
                    $return = true;

                    // this is mostly not needed
                    var invalidos = [
                        '111.111.111-11'
                        , '222.222.222-22'
                        , '333.333.333-33'
                        , '444.444.444-44'
                        , '555.555.555-55'
                        , '666.666.666-66'
                        , '777.777.777-77'
                        , '888.888.888-88'
                        , '999.999.999-99'
                        , '000.000.000-00'
                    ];
                    for (i = 0; i < invalidos.length; i++) {
                        if (invalidos[i] == value) {
                            $return = false;
                        }
                    }

                    value = value.replace("-", "");
                    value = value.replace(/\./g, "");

                    //validando primeiro digito
                    add = 0;
                    for (i = 0; i < 9; i++) {
                        add += parseInt(value.charAt(i), 10) * (10 - i);
                    }
                    rev = 11 - (add % 11);
                    if (rev == 10 || rev == 11) {
                        rev = 0;
                    }
                    if (rev != parseInt(value.charAt(9), 10)) {
                        $return = false;
                    }

                    //validando segundo digito
                    add = 0;
                    for (i = 0; i < 10; i++) {
                        add += parseInt(value.charAt(i), 10) * (11 - i);
                    }
                    rev = 11 - (add % 11);
                    if (rev == 10 || rev == 11) {
                        rev = 0;
                    }
                    if (rev != parseInt(value.charAt(10), 10)) {
                        $return = false;
                    }

                    return $return;
                });
            })(jQuery);

            $.ajax({
                type: 'GET'
                , url: "{{route('get-pacients')}}"
                , mimeType: 'json'
                , headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
                , success: function(data) {
                    $.each(data, function(i, data) {
                        let body = '<tr id="row-' + data.id + '">';
                        body += "<td>" + data.id + "</td>";
                        body += "<td>" + data.name + "</td>";
                        body += "<td>" + data.birth_date + "</td>";
                        body += "<td>" + data.cpf + "</td>";
                        body += "<td>" + data.telephone_number + "</td>";
                        body += "<td>" + data.profile_photo + "</td>";
                        body += '<td><button class="btn btn-warning" onclick="return showUpdatePacientModal(' + data.id + ');""><i class="fas fa-pen"></i></button></td>'
                        body += '<td><button class="btn btn-danger" onclick="return deletePacient(' + data.id + ');""><i class="fas fa-times"></i></button></td>'
                        body += "</tr>";
                        $("#pacients-table tbody").append(body);
                    });

                    $("#pacients-table").DataTable({
                        order: [
                            [0, 'desc']
                        ]
                        , language: {
                            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
                        }
                    });
                }
                , error: function() {
                    alert('Falha ao obter dados!');
                }
            });


            $("#cpf").mask('000.000.000-00', {
                reverse: false
            });
            $("#telephone_number").mask('(00) 00000-0000', {
                reverse: false
            });

            $("#put_cpf").mask('000.000.000-00', {
                reverse: false
            });
            $("#put_telephone_number").mask('(00) 00000-0000', {
                reverse: false
            });

            $('#post-pacient-modal').on('hidden.bs.modal', function() {
                $('#name').val('');
                $('#cpf').val('');
                $('#birth_date').val('');
                $('#telephone_number').val('');
                $('#profile_photo').val('');
            })

            $('#put-pacient-modal').on('hidden.bs.modal', function() {
                $('#put_id').val('')
                $('#put_name').val('');
                $('#put_cpf').val('');
                $('#put_birth_date').val('');
                $('#put_telephone_number').val('');
                $('#put_profile_photo').val('');
            })

            $("#post-pacient-form").submit(function(e) {
                e.preventDefault();
            });
            $("#put-pacient-form").submit(function(e) {
                e.preventDefault();
            });
            var post_form_data;

            $('#profile_photo').change(function(event) {
                post_form_data = new FormData(document.querySelector('#post-pacient-form'));
                post_form_data.append('profile_photo', event.target.files[0]);
            });

            let $post_params = {
                submitHandler: function(form) {
                    $.ajax({
                        type: 'POST'
                        , url: "{{route('post-pacient')}}"
                        , data: post_form_data
                        , mimeType: 'json'
                        , contentType: false
                        , processData: false
                        , headers: {
                            'Accept': 'application/json'
                            , 'X-CSRF-TOKEN': '{{csrf_token()}}'
                        }
                        , success: function(response) {
                            let body = '<tr id="row-' + response.id + '">';
                            body += "<td>" + response.id + "</td>";
                            body += "<td>" + response.name + "</td>";
                            body += "<td>" + response.birth_date + "</td>";
                            body += "<td>" + response.cpf + "</td>";
                            body += "<td>" + response.telephone_number + "</td>";
                            body += "<td>" + response.profile_photo + "</td>";
                            body += '<td><button class="btn btn-warning" onclick="return showUpdatePacientModal(' + response.id + ');""><i class="fas fa-pen"></i></button></td>'
                            body += '<td><button class="btn btn-danger" onclick="return deletePacient(' + response.id + ');""><i class="fas fa-times"></i></button></td>'
                            body += "</tr>";

                            $('#pacients-table > tbody').prepend(body);
                            $('#post-pacient-modal').modal('hide');
                            $('#toast-title').html('Sucesso!');
                            $('#toast-body').html('Cadastro efetuado com sucesso!');
                            $('#toast').toast('show');
                        }
                        , error: function() {
                            $('#post-pacient-modal').modal('hide');
                            $('#toast-title').html('Falha!');
                            $('#toast-body').html('Falha ao cadastrar dados.');
                            $('#toast').toast('show');
                        }
                    });
                }
                , debug: false
                , rules: {
                    'cpf': {
                        required: true
                        , cpf: true
                    }
                }
                , messages: {
                    name: 'O nome completo é obrigatório'
                    , birth_date: {
                        required: 'A data de nascimento é obrigatória.'
                        , dateISO: 'O valor deve ser uma data.'
                    }
                    , 'cpf': {
                        required: 'O CPF é obrigatório.'
                        , cpf: 'O CPF informado é inválido.'
                    }
                    , telephone_number: 'O número de telefone é obrigatório'
                    , profile_photo: {
                        required: 'A foto de perfil é obrigatória.'
                    }
                }
            };
            $("#post-pacient-form").validate($post_params);



            var put_form_data;

            $('#put_profile_photo').change(function(event) {
                put_form_data = new FormData(document.querySelector('#put-pacient-form'));
                put_form_data.append('profile_photo', event.target.files[0]);
            });

            let $put_params = {
                submitHandler: function(form) {
                    let id = $('#put_id').val();
                    put_form_data.delete('id');

                    $.ajax({
                        type: 'POST'
                        , url: "{{route('put-pacient', ':id')}}".replace(':id', id)
                        , data: put_form_data 
                        , mimeType: 'json'
                        , contentType: false
                        , processData: false
                        , headers: {
                            'Accept': 'application/json'
                            , 'X-CSRF-TOKEN': '{{csrf_token()}}'
                        }
                        , success: (response) => {
                            let row =$('#row-' + id);

                            let children = row.children();

                            $(children[1]).html("<td>" + response.name + "</td>");
                            $(children[2]).html("<td>" + response.birth_date + "</td>");
                            $(children[3]).html("<td>" + response.cpf + "</td>");
                            $(children[4]).html("<td>" + response.telephone_number + "</td>");
                            $(children[5]).html("<td>" + response.profile_photo + "</td>");
                    
                            $('#post-pacient-modal').modal('hide');
                            $('#toast-title').html('Sucesso!');
                            $('#toast-body').html('Paciente editado com sucesso.');
                            $('#toast').toast('show');
                        }
                        , error: function(response) {
                            console.log(response);
                            $('#post-pacient-modal').modal('hide');
                            $('#toast-title').html('Falha!');
                            $('#toast-body').html('Falha ao cadastrar dados.');
                            $('#toast').toast('show');
                        }
                    });
                }
                , debug: false
                , rules: {
                    cpf: {
                        required: true
                        , cpf: true
                    }
                }
                , messages: {
                    name: 'O nome completo é obrigatório'
                    , birth_date: {
                        required: 'A data de nascimento é obrigatória.'
                        , dateISO: 'O valor deve ser uma data.'
                    }
                    , cpf: {
                        required: 'O CPF é obrigatório.'
                        , cpf: 'O CPF informado é inválido.'
                    }
                    , telephone_number: 'O número de telefone é obrigatório'
                    , profile_photo: {
                        required: 'A foto de perfil é obrigatória.'
                    }
                }
            };
            $("#put-pacient-form").validate($put_params);
        });

        function showUpdatePacientModal(id) {
            $.ajax({
                type: 'GET'
                , url: "{{route('get-pacient', ':id')}}".replace(':id', id)
                , headers: {
                    'Accept': 'application/json'
                    , 'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
                , success: (response) => {
                    console.log(response);
                    $('#put_id').val(response.id);
                    $('#put_name').val(response.name);
                    $('#put_cpf').val(response.cpf);
                    $('#put_birth_date').val(response.birth_date);
                    $('#put_telephone_number').val(response.telephone_number);
                    $('#put-pacient-modal').modal('show');
                }
                , error: function(response) {
                    console.log(response);
                    $('#put-pacient-modal').modal('hide');
                    $('#toast-title').html('Falha!');
                    $('#toast-body').html('Falha ao editar paciente.');
                    $('#toast').toast('show');
                }
            });
        }

        function deletePacient(id) {
            $.ajax({
                type: 'DELETE'
                , url: "{{route('delete-pacient', ':id')}}".replace(':id', id)
                , headers: {
                    'Accept': 'application/json'
                    , 'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
                , success: (response) => {
                    $('#row-' + id).remove();
                    $('#toast-title').html('Sucesso!');
                    $('#toast-body').html('Paciente deletado com sucesso.');
                    $('#toast').toast('show');
                }
                , error: function() {
                    $('#post-pacient-modal').modal('hide');
                    $('#toast-title').html('Falha!');
                    $('#toast-body').html('Falha ao deletar paciente.');
                    $('#toast').toast('show');
                }
            });
        }

    </script>
</body>
</html>
