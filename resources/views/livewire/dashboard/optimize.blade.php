<div>
    <!-- App Capsule -->
    <div id="appCapsule">
        @if ($task)
            <div class="section mt-2">
                <div class="card">
                    <img src="{{ asset('storage/' . $task->task_image_path) }}" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title text-black text-center font-bold mb-3">{{ $task->title }}</h5>

                        <div class="flex items-center space-x-2 py-2 border-b border-gray-200 mb-2">
                            <div class="flex-1">
                                <p class="text-gray-600 text-xs mb-0">Total Amount</p>
                            </div>
                            <div class="flex-none text-end text-black font-medium text-sm">{{ number_format($task->cost, 2) }} USDT</div>
                        </div>

                        <div class="flex items-center space-x-2 py-2 border-b border-gray-200 mb-2">
                            <div class="flex-1">
                                <p class="text-gray-600 text-xs mb-0">Commission</p>
                            </div>
                            <div class="flex-none text-end text-black font-medium text-sm">{{ number_format($commission, 2) }} USDT</div>
                        </div>

                        <div class="flex items-center space-x-2 py-2 border-b border-gray-200 mb-2">
                            <div class="flex-1">
                                <p class="text-gray-600 text-xs mb-0">Creation Time</p>
                            </div>
                            <div class="flex-none text-end text-black font-medium text-sm">{{ $task->created_at->format('Y-m-d h:i A') }}</div>
                        </div>

                        <div class="mt-4">
                            <button type="button" class="btn btn-primary btn-lg btn-block" wire:click="submitTask">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- * App Capsule -->
</div>
