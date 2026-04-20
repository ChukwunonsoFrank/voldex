<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4">
            <div class="my-3 sticky top-0 z-10 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Settings</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                @include('partials.settings-heading')

                <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
                    <form wire:submit="updatePassword" class="mt-6 space-y-6">
                        <flux:label class="text-white! mb-2!">Current password</flux:label>
                        <flux:input class:input="bg-transparent! text-white! border-[#26252a]! text-sm!"
                            wire:model="current_password"
                            type="password"
                            required
                            autocomplete="current-password"
                        />
            
                        <flux:label class="text-white! mb-2!">New password</flux:label>
                        <flux:input class:input="bg-transparent! text-white! border-[#26252a]! text-sm!"
                            wire:model="password"
                            type="password"
                            required
                            autocomplete="new-password"
                        />
            
                        <flux:label class="text-white! mb-2!">Confirm password</flux:label>
                        <flux:input class:input="bg-transparent! text-white! border-[#26252a]! text-sm!"
                            wire:model="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                        />
            
                        <div class="flex items-center gap-4">
                            <div class="flex items-center justify-end">
                                <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                            </div>
            
                            <x-action-message class="me-3 text-green-500" on="password-updated">
                                {{ __('Saved.') }}
                            </x-action-message>
                        </div>
                    </form>
                </x-settings.layout>
            </div>
        </div>
    </div>
</div>



