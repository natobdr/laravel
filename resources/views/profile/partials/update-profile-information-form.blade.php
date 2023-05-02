<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informações de Perfil') }}
        </h2>
    </header
    <div x-data>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->pes_nome)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="Telefone" :value="__('Telefone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" x-mask="(99) 9 9999-9999" :value="old('phone', $user->telefone->tel_cd_ddd.$user->telefone->tel_nu_telefone)"  required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="CPF" :value="__('CPF')" />
            <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full" x-mask="999.999.999-99" :value="old('cpf', $user->pes_nu_cpf)" required autofocus readonly autocomplete="cpf" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Seu endereço de e-mail não foi verificado.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Um novo link de verificação foi enviado para o seu endereço de e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="name" :value="__('Endereço')" />
            <x-text-input id="cep" name="cep" style="width: 20%" type="text" class="mt-2 w-min" placeholder="Cep" x-mask="99999-999" :value="old('name',$user->endereco->end_nu_cep)" required autofocus autocomplete="cep" />
            <x-text-input id="logradouro" name="logradouro" style="width: 79%" type="text" class="mt-1 " placeholder="Ex: Rua, Av" :value="old('name',$user->endereco->end_nm_logradouro)" required autofocus autocomplete="logradouro" />
            <x-text-input id="numero" name="numero" style="width: 10%" type="text" class="mt-2 w-min" placeholder="Nº" :value="old('name',$user->endereco->end_nu_imovel )" required autofocus autocomplete="numero" />
            <x-text-input id="bairro" name="bairro" style="width: 44.3%" type="text" class="mt-2 w-1" placeholder="Bairro" :value="old('name',$user->endereco->end_nm_bairro)" required autofocus autocomplete="bairro" />
            <x-text-input id="complemento" name="complemento" style="width: 44%" type="text" class="mt-2 w-1" placeholder="complemento" :value="old('name',$user->endereco->end_ds_complemento)" required autofocus autocomplete="complemento" />
            <x-text-input id="estado" name="estado" style="width: 20%" type="text" class="mt-2 w-1" placeholder="Estado" :value="old('name',$user->endereco->end_ds_estado)" required autofocus autocomplete="estado" />
            <x-text-input id="cidade" name="cidade" style="width: 79%" type="text" class="mt-1 " placeholder="Cidade" :value="old('name',$user->endereco->end_ds_cidade)" required autofocus autocomplete="cidade" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
    </form>
{{--        <script>--}}
{{--            $(document).on('blur', '#cep', function (){--}}
{{--                const cep = $(this).val();--}}
{{--                $.ajax({--}}
{{--                    url: 'https://viacep.com.br/ws/'+cep+'/json/',--}}
{{--                    method: 'GET',--}}
{{--                    dataType: 'json',--}}
{{--                    success: function (data){--}}
{{--                        $('#logradouro').val(data.logradouro);--}}
{{--                        $('#bairro').val(data.bairro);--}}
{{--                        $('#cidade').val(data.localidade);--}}
{{--                        $('#estado').val(data.uf);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
    </div>
</section>
