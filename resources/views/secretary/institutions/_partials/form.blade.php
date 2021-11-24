@csrf
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="name">Nome</label>
            <input
                type="text"
                class="form-control {{ $errors->has('institution.name') ? 'is-invalid' : '' }}"
                id="name"
                name="institution[name]"
                value="{{ old('name', isset($institution) ? $institution->name : '') }}"
            >
            <div class="invalid-feedback">{{ $errors->first('institution.name') }}</div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="meal_morning_demand">Demanda da manhã</label>
            <input
                type="text"
                class="form-control {{ $errors->has('institution.meal_morning_demand') ? 'is-invalid' : '' }}"
                id="meal_morning_demand"
                name="institution[meal_morning_demand]"
                value="{{ old('meal_morning_demand', isset($institution) ? $institution->meal_morning_demand : '') }}"
            >
            <div class="invalid-feedback">{{ $errors->first('institution.meal_morning_demand') }}</div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="meal_afternoon_demand">Demanda da tarde</label>
            <input
                type="text"
                class="form-control {{ $errors->has('institution.meal_afternoon_demand') ? 'is-invalid' : '' }}"
                id="meal_afternoon_demand"
                name="institution[meal_afternoon_demand]"
                value="{{ old('meal_afternoon_demand', isset($institution) ? $institution->meal_afternoon_demand : '') }}"
            >
            <div class="invalid-feedback">{{ $errors->first('institution.meal_afternoon_demand') }}</div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="meal_night_demand">Demanda da noite</label>
            <input
                type="text"
                class="form-control {{ $errors->has('institution.meal_night_demand') ? 'is-invalid' : '' }}"
                id="meal_night_demand"
                name="institution[meal_night_demand]"
                value="{{ old('meal_night_demand', isset($institution) ? $institution->meal_night_demand : '') }}"
            >
            <div class="invalid-feedback">{{ $errors->first('institution.meal_night_demand') }}</div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input
                type="text"
                class="form-control phone {{ $errors->has('institution.phone') ? 'is-invalid' : '' }}"
                id="phone"
                name="institution[phone]"
                value="{{ old('phone', isset($institution) ? $institution->phone : '') }}"
            >
            <div class="invalid-feedback">{{$errors->first('institution.phone')}}</div>
        </div>
    </div>
</div>
<hr>

<!-- Address -->
<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label for="zipcode">CEP</label>
            <input
                type="text"
                name="address[zipcode]"
                id="zipcode"
                class="form-control zipcode {{$errors->has('address.zipcode') ? 'is-invalid' : '' }}"
                value="{{ old('zipcode', isset($address) ? $address->zipcode : '') }}"]
            >
            <div class="invalid-feedback">{{$errors->first('address.zipcode')}}</div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
        <label for="state">UF</label>
            <select
                type="text"
                name="address[state]"
                id="state"
                class="form-control state {{$errors->has('address.state') ? 'is-invalid' : '' }}">
                <option value="{{ old('state', isset($address) ? $address->state : '') }}">{{ old('state', isset($address) ? $address->state : 'Selecione o estado') }}</option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MT">MT</option>
                <option value="MS">MS</option>
                <option value="MG">MG</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PR">PR</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RS</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SP">SP</option>
                <option value="SE">SE</option>
                <option value="TO">TO</option>
            
            </select>
            <!--<input
                type="text"
                name="address[state]"
                id="state"
                class="form-control state {{$errors->has('address.state') ? 'is-invalid' : '' }}"
                value="{{ old('state', isset($address) ? $address->state : '') }}"]
            >
            <div class="invalid-feedback">{{$errors->first('address.state')}}</div>
            -->
        </div>
    </div>
    <div class="col-lg-7">
        <div class="form-group">
        <label for="city">Cidade</label>
            <input
                type="text"
                name="address[city]"
                id="city"
                class="form-control {{$errors->has('address.city') ? 'is-invalid' : '' }}"
                value="{{ old('city', isset($address) ? $address->city : '') }}"]
            >
            <div class="invalid-feedback">{{$errors->first('address.city')}}</div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="form-group">
            <label for="street">Logradouro</label>
            <input
                type="text"
                name="address[street]"
                id="street"
                class="form-control {{$errors->has('address.street') ? 'is-invalid' : '' }}"
                value="{{ old('street', isset($address) ? $address->street : '') }}"]
            >
            <div class="invalid-feedback">{{$errors->first('address.street')}}</div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="number">Número</label>
            <input
                type="text"
                name="address[number]"
                id="number"
                class="form-control {{$errors->has('address.number') ? 'is-invalid' : '' }}"                    
                value="{{ old('number', isset($address) ? $address->number : '') }}"]
            >
            <div class="invalid-feedback">{{$errors->first('address.number')}}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="district">Bairro</label>
            <input
                type="text"
                name="address[district]"
                id="district"
                class="form-control {{$errors->has('address.district') ? 'is-invalid' : '' }}"
                value="{{ old('district', isset($address) ? $address->district : '') }}"]
            >
            <div class="invalid-feedback">{{$errors->first('address.district')}}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="complement">Complemento</label>
            <input
                type="text"
                name="address[complement]"
                class="form-control {{$errors->has('address.complement') ? 'is-invalid' : '' }}"
                value="{{ old('complement', isset($address) ? $address->complement : '') }}"]
            >
            <div class="invalid-feedback">{{$errors->first('address.complement')}}</div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-success mt-2">Salvar</button>
<a href="{{ url('/secretaria/instituicao') }}" class="btn btn-success mt-2 ml-3">Voltar</a>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
<script>
    $('.zipcode').mask('00000-000');
    $('.phone').mask('(00) 0000-00009');
    $('.phone').blur(function(event) {
        if($(this).val().length == 11){
            $('.phone').mask('(00) 00000-0009');
        } else {
            $('.phone').mask('(00) 0000-00009');
        }
    });
    
    $(document).on('blur', '#zipcode', function(){
        const cep = $(this).val();
    
        $.ajax({
        url: 'https://viacep.com.br/ws/'+cep+'/json/',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if(data.erro){
                alert('Endereço não encontrado!');
            }            
            $('#state').val(data.uf);
            $('#city').val(data.localidade);
            $('#street').val(data.logradouro);
            $('#district').val(data.bairro);
        }
    });
});
</script>