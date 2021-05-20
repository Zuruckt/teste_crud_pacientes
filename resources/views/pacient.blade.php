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
    <div class="container mt-2">
    <div class="d-flex justify-content-between mx-1">
        <h1>Perfil do Paciente</h1>
        <a href="{{route('welcome')}}">Voltar</a>
    </div>
    

        <div class="row">
            <div class="col-md-8">
                <h2>Nome: {{$pacient->name}}</span></h2>
                <h2>Data de Nascimento: {{date('d/m/Y', strtotime($pacient->birth_date))}}</h2>
                <h2>CPF: {{$pacient->cpf}}</h2>
                <h2>Telefone: {{$pacient->telephone_number}}</h2>
                <h2>Status: {{$pacient->infection_status}}</h2>

            </div>
            <div class="col-md-4">
                <img class="border border-primary" src="{{ asset($pacient->profile_photo)}}" alt="Foto de perfil de {{$pacient->name}}" width=354 height=472>
            </div>
        </div>
        <div class="row">
            @php
            $hidden = ($pacient->symptoms()->count()) ? 'd-none' : '';
            @endphp

            <div id="symptoms-container" id="symptoms-container">
                @foreach ($pacient->symptoms as $symptom)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$symptom->id}}" checked disabled>
                    <label class="form-check-label" for="flexCheckDefault">
                        {{$symptom->name}}
                    </label>
                </div>
                @endforeach
                @if($pacient->symptoms()->count())
                <button class="btn btn-primary btn-block" onclick="return showSymptomsForm();">Editar sintomas</button>
                @endif
            </div>


            <div class="{{$hidden}}" id="form-container">
                <form action="#" class="my-2">
                    @foreach ($pacient->symptoms as $symptom)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="checkbox" value="{{$symptom->id}}" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{$symptom->name}}
                        </label>
                    </div>
                    @endforeach
                </form>
                <button class="btn btn-primary btn-block" onclick="return postSymptoms();">Cadastrar sintomas</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cd3e3a237a.js" crossorigin="anonymous"></script>


    <script>
        function fetchSymptoms() {
            
            $.ajax({
                type: 'GET'
                , url: "{{route('get-symptoms')}}"
                , mimeType: 'json'
                , headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
                , success: function(data) {
                    let form = $('form');
                    form.empty();
                    let checked = {{$pacient->symptoms->pluck('id')->toJson()}}
                    $.each(data, function(i, data) {
                        let check = checked.includes(data.id) ? 'checked' : '';
                        let checkbox = '<div class="form-check">';
                        checkbox += '<input class="form-check-input post"type="checkbox" name="checkbox" value="' + data.id + '" ' + check + ' >';
                        checkbox += '<label class="form-check-label" for="symptom-' + data.id + '">';
                        checkbox += data.name;
                        checkbox += '</label>';
                        checkbox += '</div>';
                        form.append(checkbox)
                    });
                }
                , error: function() {
                    alert('Falha ao obter dados!');
                }
            });
        }

        function postSymptoms() {
            let data = {
                symptoms: []
            }
            
            let checkboxes = document.querySelectorAll('input.post:checked')

            console.log(checkboxes);

            for (checkbox of checkboxes) {
                data.symptoms.push(checkbox.value);
            }
            if(data.length == 0) data = null;
            $.ajax({
                type: 'POST'
                , url: "{{route('post-pacient-symptoms', $pacient->id)}}"
                , mimeType: 'json'
                , data: data
                , headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
                , success: async function(response) {    
                    document.location.reload(true);
                }
                , error: function(response) {
                    console.log(response);
                    alert('Falha ao obter dados!');
                }
            });
        }

        function showSymptomsForm() {
            $('#symptoms-container').addClass('d-none');
            $('#form-container').removeClass('d-none');
        }

        $(document).ready(function() {
            fetchSymptoms();
        });

    </script>
</body>
</html>
