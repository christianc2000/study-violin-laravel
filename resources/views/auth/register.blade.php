<x-authentication-layout>
    <h1 class="text-3xl flex text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Crea tu cuenta') }} <img
        src="{{ asset('logos/corchea.svg') }}" class="ml-2" alt="feliz" width="20" height="20"></h1>
    <!-- Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="ci">{{ __('CI') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="ci" type="text" name="ci" :value="old('ci')" required autofocus autocomplete="ci" />
            </div>
            <div>
                <x-label for="name">{{ __('Nombre') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <div>
                <x-label for="lastname">{{ __('Apellido') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="lastname" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
            </div>
            <div>
                <x-label for="gender">{{ __('Género') }} <span class="text-rose-500">*</span></x-label>
                <x-select-base id="gender" name="gender" :value="old('gender')" required autofocus autocomplete="gender" >
                    <option value="">Seleccione una opción</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </x-select>
            </div>
            <div>
                <x-label for="birth_date">{{ __('Fecha de nacimiento') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="birth_date" type="date" name="birth_date" :value="old('birth_date')" required autofocus autocomplete="birth_date" />
            </div>
            <div>
                <x-label for="address">{{ __('Dirección') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="address" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
            </div>
            <div>
                <x-label for="registro">{{ __('Tipo de usuario') }} <span class="text-rose-500">*</span></x-label>
                <x-select-base id="registro" name="registro" :value="old('registro')" required autofocus autocomplete="registro" >
                    <option value="">Seleccione una opción</option>
                    <option value=2>Registrar como Profesor</option>
                    <option value=1>Registrar como Tutor</option>
                </x-select>
            </div>
            <div>
                <x-label for="plan_id">{{ __('Plan') }} <span class="text-rose-500">*</span></x-label>
                <x-select-base id="plan_id" name="plan_id" :value="old('plan_id')" required autofocus autocomplete="plan_id" >
                    <option value="">Seleccione una opción</option>
                    <option value=1 {{$plan==1?'selected':''}}>Plan mensual</option>
                    <option value=2 {{$plan==2?'selected':''}}>Plan semestral</option>
                    <option value=3 {{$plan==3?'selected':''}}>Plan anual</option>
                </x-select>
            </div>
            <div>
                <x-label for="email">{{ __('Correo') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            <div class="mr-1">
                <label class="flex items-center" name="newsletter" id="newsletter">
                    {{-- <input type="checkbox" class="form-checkbox" />
                    <span class="text-sm ml-2">Email me about product news.</span> --}}
                </label>
            </div>
            <x-button>
                {{ __('Registrar') }}
            </x-button>                
        </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-6">
                    <label class="flex items-start">
                        <input type="checkbox" class="form-checkbox mt-1" name="terms" id="terms" />
                        <span class="text-sm ml-2">
                            {!! __('Estoy de acuerdo con los :terms_of_service y :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm underline hover:no-underline">'.__('Terminos de servicio').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm underline hover:no-underline">'.__('Políticas de privacidad').'</a>',
                            ]) !!}                        
                        </span>
                    </label>
                </div>
            @endif        
    </form>
    <x-validation-errors class="mt-4" />  
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-slate-200 dark:border-slate-700">
        <div class="text-sm">
            {{ __('Tienes una cuenta?') }} <a class="font-medium text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
        </div>
    </div>
</x-authentication-layout>
