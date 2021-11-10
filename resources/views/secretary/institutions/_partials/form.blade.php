@csrf
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="name">Nome</label>
            <input
                type="text"
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                id="name"
                name="institution[name]"
                value="{{ old('name', isset($institution) ? $institution->name : '') }}"
            >
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="meal_morning_demand">Demanda da manhã</label>
            <input
                type="text"
                class="form-control {{ $errors->has('meal_morning_demand') ? 'is-invalid' : '' }}"
                id="meal_morning_demand"
                name="institution[meal_morning_demand]"
                value="{{ old('meal_morning_demand', isset($institution) ? $institution->meal_morning_demand : '') }}"
            >
            <div class="invalid-feedback">{{ $errors->first('meal_morning_demand') }}</div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="meal_afternoon_demand">Demanda da tarde</label>
            <input
                type="text"
                class="form-control {{ $errors->has('meal_afternoon_demand') ? 'is-invalid' : '' }}"
                id="meal_afternoon_demand"
                name="institution[meal_afternoon_demand]"
                value="{{ old('meal_afternoon_demand', isset($institution) ? $institution->meal_afternoon_demand : '') }}"
            >
            <div class="invalid-feedback">{{ $errors->first('meal_afternoon_demand') }}</div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="meal_night_demand">Demanda da noite</label>
            <input
                type="text"
                class="form-control {{ $errors->has('meal_night_demand') ? 'is-invalid' : '' }}"
                id="meal_night_demand"
                name="institution[meal_night_demand]"
                value="{{ old('meal_night_demand', isset($institution) ? $institution->meal_night_demand : '') }}"
            >
            <div class="invalid-feedback">{{ $errors->first('meal_night_demand') }}</div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input
                type="text"
                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                id="phone"
                name="institution[phone]"
                value="{{ old('phone', isset($institution) ? $institution->phone : '') }}"
            >
            <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
        </div>
    </div>

    <hr>

    <!-- Address -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="form-group">
                <label for="zipcode">CEP</label>
                <input
                    type="text"
                    name="address[zipcode]"
                    id="zipcode"
                    class="form-control zipcode {{$errors->has('address.zipcode') ? 'is-invalid' : '' }}"
                    value="{{ old('address.zipcode') }}"
                >
                <div class="invalid-feedback">{{$errors->first('address.zipcode')}}</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
            <label for="state">UF</label>
                <input
                    type="text"
                    name="address[state]"
                    id="state"
                    class="form-control state {{$errors->has('address.state') ? 'is-invalid' : '' }}"
                    value="{{ old('address.state') }}"
                >
                <div class="invalid-feedback">{{$errors->first('address.state')}}</div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
            <label for="city">Cidade</label>
                <input
                    type="text"
                    name="address[city]"
                    id="city"
                    class="form-control {{$errors->has('address.city') ? 'is-invalid' : '' }}"
                    value="{{ old('address.city') }}"
                >
                <div class="invalid-feedback">{{$errors->first('address.city')}}</div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="street">Logradouro</label>
                <input
                    type="text"
                    name="address[street]"
                    id="street"
                    class="form-control {{$errors->has('address.street') ? 'is-invalid' : '' }}"
                    value="{{ old('address.street') }}"
                >
                <div class="invalid-feedback">{{$errors->first('address.street')}}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="number">Número</label>
                <input
                    type="text"
                    name="address[number]"
                    id="number"
                    class="form-control {{$errors->has('address.number') ? 'is-invalid' : '' }}"                    
                    value="{{ old('address.number') }}"
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
                    value="{{ old('address.district') }}"
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
                    value="{{ old('address.complement') }}"
                >
                <div class="invalid-feedback">{{$errors->first('address.complement')}}</div>
            </div>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success mt-2">Salvar</button>