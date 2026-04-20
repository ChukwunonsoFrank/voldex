<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item @class(['bg-[#26252a]!' => request()->is('settings/profile'), 'text-white!' => true]) :href="route('settings.profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
            <flux:navlist.item @class(['bg-[#26252a]!' => request()->is('settings/password'), 'text-white!' => true]) :href="route('settings.password')" wire:navigate>{{ __('Password') }}</flux:navlist.item>
        </flux:navlist>
    </div>

    <flux:separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading class="text-white!">{{ $heading ?? '' }}</flux:heading>
        <flux:subheading class="text-xs! text-zinc-300!">{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
