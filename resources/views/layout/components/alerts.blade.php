@if(Session::has('success'))
<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><span class="glyphicon glyphicon-ok-sign"></span> Sucesso!</strong> {{Session::pull('success')}}
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><span class="glyphicon glyphicon-remove-sign"></span> Erro!</strong> {{Session::pull('error')}}.
</div>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><span class="glyphicon glyphicon-remove-sign"></span> Erro!</strong> 
    Os seguintes erros de validação foram encontrados:
    <ul>
        @foreach($errors->all() as $erro)
            <li>{{ $erro }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(Session::has('info'))
<div class="alert alert-info fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><span class="glyphicon glyphicon-info-sign"></span> Informação!</strong> {{Session::pull('info')}}.
</div>
@endif
