@extends('layouts.main')

@section('content')

<div class="  d-flex align-items-center ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 offset-xl-3" style="margin-top: 200px; border-style:solid; border-width: 1px; padding:20px">
                <div class="property_wrap">
                    <div class="slider_text text-center justify-content-center">
        
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <h2>Добавить объявление</h2>
                            <div class="mt-10">            
                                <input type="text" name="address" placeholder="Адрес" value="{{ $advert?->name }}"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Адрес'" required
                                    class="single-input">
                            </div>
                            <div class="input-group-icon mt-10">
								<div class="form-select" id="default-select-1">
                                    <select name="type">
                                        <option>Тип объявления</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->name }}" {{ $advert?->type == $type->name ? "selected" : "" }}>{{ $type->ru() }}</option>
                                        @endforeach
									</select>
								</div>
							</div>
                            <div class="input-group-icon mt-10">
								<div class="form-select" id="default-select-2">
                                    <select name="placement_type">
                                        <option>Тип помещения</option>
                                        @foreach ($placementTypes as $placementType)
                                            <option value="{{ $placementType->name }}" {{ $advert?->placement_type == $placementType->name ? "selected" : "" }}>{{ $placementType->ru() }}</option>
                                        @endforeach
									</select>
								</div>
							</div>
                            <div class="mt-10">            
                                <input type="text" name="square" placeholder="Площадь" required
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Площадь'"
                                    class="single-input">
                            </div>
                            <div class="mt-10">            
                                <input type="text" name="payment" placeholder="Цена" required
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Цена'"
                                    class="single-input">
                            </div>
                            <div class="mt-10">            
                                <input type="text" name="description" placeholder="Описание"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Описание'"
                                    class="single-input">
                            </div>
                            <div class="mt-10">            
                                <input type="file" multiple name="images[]" placeholder="Файлы"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Файлы'"
                                    class="single-input">
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="genric-btn success-border circle">Создать</button>
                            </div>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
        
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
@endsection