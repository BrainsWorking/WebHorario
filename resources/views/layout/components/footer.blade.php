<footer class="text-center">
    <div class="container">
        @if(isset($dadosInst))
            <p>
                
                {{ $dadosInst->nome }}
            </p>
            <p>
                {{ $dadosInst->endereco or 'Endereço da instituicao' }} - 
                CEP: {{ $dadosInst->cep  or 'CEP da instituicao'}} - 
                Telefone: +55 {{ $dadosInst->telefone or 'Telefone da instituicao' }}
            </p>
        @else
            <a href="{{ route('instituicao') }}">Cadastrar Instituição</a>
        @endif
        <p class="text-center">
            Desenvolvimento ACME & Brains Working
        </p>
    </div>
</footer>

<script type="text/javascript"> var ROOT = '{{ url('/') }}' </script>
<script type="text/javascript" src="{{ asset('/js/jquery-3.2.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/footer.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.multi-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/tooltip.js') }}"></script>
<script>
    $('.mascara-data').mask('00/00/0000');
    $('.mascara-rg').mask('00.000.000-0');
    $('.mascara-cpf').mask('000.000.000-00');
    
    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 0-0000-0000' : '(00) 0000-00009';
    }

    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.mascara-telefone').mask(SPMaskBehavior, spOptions);
</script>
@yield('scripts')