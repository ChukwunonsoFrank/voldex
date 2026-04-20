<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4">
            <div class="my-3 sticky top-0 z-10 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Settings</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                @include('partials.settings-heading')

                <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
                    <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
                        <flux:label class="text-white! mb-2!">Name</flux:label>
                        <flux:input class:input="bg-transparent! text-white! border-[#26252a]! text-sm!" wire:model="name" type="text" required autofocus
                            autocomplete="name" />

                        <div>
                            <flux:label class="text-white! mb-2!">Email</flux:label>
                            <flux:input class:input="bg-transparent! text-white! border-[#26252a]! text-sm!" wire:model="email" type="email" required
                                autocomplete="email" />

                            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                                <div>
                                    <flux:text class="mt-4">
                                        {{ __('Your email address is unverified.') }}

                                        <flux:link class="text-sm cursor-pointer"
                                            wire:click.prevent="resendVerificationNotification">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </flux:link>
                                    </flux:text>

                                    @if (session('status') === 'verification-link-sent')
                                        <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </flux:text>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="flex items-center justify-end">
                                <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}
                                </flux:button>
                            </div>

                            <x-action-message class="me-3 text-green-500" on="profile-updated">
                                {{ __('Saved.') }}
                            </x-action-message>
                        </div>
                    </form>

                    {{-- <livewire:settings.delete-user-form /> --}}
                </x-settings.layout>
            </div>
        </div>
    </div>
</div>
