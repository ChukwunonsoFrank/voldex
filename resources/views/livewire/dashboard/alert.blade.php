<div>
    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section full">

            <ul class="listview image-listview flush">
                @forelse ($alerts as $alert)
                    <li wire:key="alert-{{ $alert->id }}">
                        <a href="#" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>
                                    <div class="mb-05"><strong>{{ $alert->title }}</strong></div>
                                    <div class="text-small mb-05">{{ $alert->body }}</div>
                                    <div class="text-xsmall">{{ $alert->created_at->format('n/j/Y g:i A') }}</div>
                                </div>
                            </div>
                        </a>
                    </li>
                @empty
                    <li>
                        <div class="item">
                            <div class="in">
                                <div class="text-center w-100">
                                    <p>No alerts yet.</p>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforelse
            </ul>

        </div>

    </div>
    <!-- * App Capsule -->
</div>
