<div class="">
    @include('flash-message')
    <form wire:submit="{{ $showForgotPassword ? 'sendResetLink' : 'submit' }}"
        method="{{ $showForgotPassword ? 'GET' : 'POST' }}" action="{{ route('login') }}" class="space-y-4">
        @csrf
        @if (!$showForgotPassword)


            {{-- Welcome Message --}}
            <div class="mt-[52px]  ml-[50px] mb-6">
                <h2 class="font-bold text-[24px] leading-[29px] text-[#232323] opacity-100">Benvenuto!</h2>
                <p class="font-semibold text-[20px] leading-[24px] text-[#6B6B6B] opacity-100 mt-[9px]">Accedi al tuo
                    account</p>
            </div>
            {{-- Email Input --}}
            <div class="ml-[50px] mt-[52px]">

                <label for="email" class=" font-light text-lg leading-[21px] text-[#A0A0A0] opacity-100">
                    E-mail
                    @if ($messageEmail)
                        <p
                            class="flex float-right mr-[50px] italic font-light text-[16px] leading-[20px] tracking-[0px] text-[#E67E22] opacity-100">
                            {{ $messageEmail }}</p>
                    @endif
                    @if ($messageEmailValid)
                        <p
                            class="flex float-right mr-[50px] italic font-light text-[16px] leading-[20px] tracking-[0px] text-[#28A745] opacity-100">
                            <flux:icon.check-circle /> {{ $messageEmailValid }}</p>
                    @endif
                </label>
                <div class="relative mb-12">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none">
                        <flux:icon.at-symbol class="w-[20px] h-[20px] ml-[11px] mt-[11px] text-[#10BDD4]" />
                    </div>

                    <input type="email" id="email" name="email" wire:model="email" wire:model.live="email"
                        class="mt-[12px] w-[433px] h-[40px] border text-sm  ps-12 p-2.5 placeholder:italic placeholder:font-thin placeholder:text-[16px] placeholder:leading-[20px] placeholder:ml-[20px] placeholder:text-[#BEBBBB] placeholder:tracking-[0px] placeholder:opacity-80 autofill:shadow-[inset_0_0_0px_1000px_white] focus:bg-white"
                        placeholder="esempio@istemi.com">
                </div>


                <label for="password" class="font-light text-lg leading-[21px] text-[#A0A0A0] opacity-100">
                    Password
                    @if ($messagePassword)
                        <p
                            class="flex float-right mr-[50px] italic font-light text-[16px] leading-[20px] tracking-[0px] text-[#E67E22] opacity-100">
                            <flux:icon.exclamation-circle /> {{ $messagePassword }}
                        </p>
                    @endif
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none">
                        <flux:icon.key class="w-[20px] h-[20px] ml-[11px] mt-[6px] text-[#10BDD4]" />
                    </div>


                    <input type="{{ $showPassword ? 'text' : 'password' }}" wire:model="password"
                        wire:model.live="password" name="password" id="password" required
                        class="border pl-[50px] bg-white text-gray-900 text-sm block w-[433px] h-[40px]  mt-[8px]  autofill:shadow-[inset_0_0_0px_1000px_white] focus:bg-white ">
                    <button type="button" class="absolute inset-y-0 right-2 w-20 flex items-center text-gray-500"
                        wire:click="togglePassword">
                        @if ($showPassword)
                            <flux:icon.eye class="w-[20px] h-[20px] ml-[10px] text-[#10BDD4]" />
                        @else
                            <flux:icon.eye-slash class="w-[20px] h-[20px] ml-[10px] text-[#10BDD4]" />
                        @endif
                    </button>

                </div>
                <div class="text-left mb-[40px] mt-[8px]">
                    <button type="button" wire:click="toggleForgotPassword"
                        class="font-semi-bold text-[15px] leading-[19px] text-[#BEBBBB] opacity-100">
                        Password dimenticata?
                    </button>
                </div>


                {{-- Login Button --}}
                <div class="mb-[24px]  mt-[48px] ">
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-[200px] h-[50px]  transition-colors duration-300 ease-in-out {{ !$this->email || !$this->password
                            ? ' text-[#10BDD44D] font-semibold text-[20px] leading-[24px] tracking-[0px] opacity-100  cursor-not-allowed'
                            : ' text-white  bg-[#10BDD4] font-semibold text-[20px] leading-[24px] tracking-[0px] opacity-100 cursor-pointer' }}"
                        @disabled(!$this->email || !$this->password)>
                        Accedi
                    </button>
                </div>
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-[18px] h-[18px] bg-white border border-[#B0B0B0] rounded-[1px] opacity-20 focus:ring-0 focus:outline-none checked:bg-[#B0B0B0] checked:border-[#B0B0B0]">
                        <label for="remember"
                            class="font-normal text-[16px] leading-[20px] text-[#BEBBBB] opacity-100 ml-[8px]">
                            Resta connesso
                        </label>
                    </div>
                </div>

        @endif

        @if ($showForgotPassword)
            <div class="ml-[50px] mt-[52px]">
                <h2 class="font-bold text-[24px] leading-[29px] text-[#232323] opacity-100">Password dimenticata</h2>
                <h6 class="font-semibold text-[20px] leading-[24px] text-[#6B6B6B] opacity-100 mt-[9px] mb-[52px]">
                    Recupera l'accesso al tuo account</h6>

                <label for="email" class="font-light text-lg leading-[21px] text-[#A0A0A0] opacity-100 ">
                    E-mail
                    @if ($messageEmail)
                        <p
                            class="flex float-right mr-[50px] italic font-light text-[16px] leading-[20px] tracking-[0px] text-[#E67E22] opacity-100">
                            {{ $messageEmail }}</p>
                    @endif
                    @if ($messageEmailValid)
                        <p
                            class="flex float-right mr-[50px] italic font-light text-[16px] leading-[20px] tracking-[0px] text-[#28A745] opacity-100">
                            <flux:icon.check-circle /> {{ $messageEmailValid }}</p>
                    @endif
                </label>
                <div class="relative mb-12">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none">
                        <flux:icon.at-symbol class="w-[20px] h-[20px] ml-[11px] mt-[11px] text-[#10BDD4]" />
                    </div>

                    <input type="email" id="email" name="email" wire:model="email"
                        wire:model.live="forgotPasswordEmail"
                        class="mt-[12px] w-[433px] h-[40px] border text-sm  ps-12 p-2.5 placeholder:italic placeholder:font-thin placeholder:text-[16px] placeholder:leading-[20px] placeholder:ml-[20px] placeholder:text-[#BEBBBB] placeholder:tracking-[0px] placeholder:opacity-80 autofill:shadow-[inset_0_0_0px_1000px_white] focus:bg-white"
                        placeholder="esempio@istemi.com">
                </div>

                <div class=" mt-12 flex space-x-2 font-inter">
                    <button type="button" wire:click="toggleForgotPassword"
                        class=" w-28 h-12 bg-[#FAFAFA] text-[#6F6F6F] font-medium text-[20px] cursor-pointer">
                        Annulla
                    </button>

                    <button type="submit"
                        class="w-[301px] h-[50px] ml-[20px] {{ !$this->forgotPasswordEmail
                            ? ' text-[#10BDD44D] bg-[#F5FCFD] font-medium text-[21px] leading-[24px] tracking-[0px] opacity-100  cursor-not-allowed'
                            : ' text-white  bg-[#10BDD4] font-medium text-[21px] leading-[24px] tracking-[0px] opacity-100 cursor-pointer' }}"
                        @disabled(!$this->forgotPasswordEmail)>
                        Invia e-mail di recupero
                    </button>
                </div>
            </div>
        @endif
    </form>
</div>
