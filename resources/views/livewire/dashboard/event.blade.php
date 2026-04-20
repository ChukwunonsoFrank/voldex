<div>
    <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Events -->
        <div class="section mt-2">
            <div class="section-title fw-bold">Latest Events</div>

            @forelse ($events as $event)
                <div wire:key="event-{{ $event->id }}" style="margin-bottom: 4px;">
                    <img
                        src="{{ route('storage.file', $event->poster_image_path) }}"
                        alt="Event flyer"
                        class="imaged w-100"
                        style="border-radius: 8px; display: block;"
                    >
                </div>
            @empty
                <div class="text-center py-4">
                    <ion-icon name="calendar-outline" style="font-size: 48px; color: #ccc;"></ion-icon>
                    <p class="mt-1" style="color: #999;">No events available at the moment.</p>
                </div>
            @endforelse
        </div>
        <!-- * Events -->
    </div>
    <!-- * App Capsule -->
</div>
