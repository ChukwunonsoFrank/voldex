<div>
    <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Transactions -->
        <div class="section mt-2">
            <div class="section-title fw-bold">Completed Tasks</div>
            <div class="transactions">
                @forelse ($completedTasks as $task)
                    <div wire:key="task-{{ $task->id }}" class="item">
                        <div class="detail">
                            <img src="{{ route('storage.file', $task->task_image_path) }}" alt="img" class="image-block imaged w64">
                            <div>
                                <strong>{{ $task->title }}</strong>
                                <p>Amount: {{ number_format((float) $task->cost, 2) }} USDT</p>
                                <p>Commission:
                                    {{ number_format((float) $task->cost * ($commissionPercentage / 100), 2) }} USDT</p>
                                <p>Date: {{ $task->created_at->format('Y-m-d h:i A') }}</p>
                                @if ($task->status === 'pending')
                                    <button type="button" class="btn btn-primary btn-sm mt-1"
                                        wire:click="submitTask({{ $task->id }})">
                                        Submit
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="right">
                            <div>
                                <span class="badge badge-{{ $task->status === 'approved' ? 'success' : 'warning' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="item">
                        <div class="detail">
                            <div>
                                <strong>No records found.</strong>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-3 px-2">
                {{ $completedTasks->links() }}
            </div>
        </div>
        <!-- * Transactions -->
    </div>
    <!-- * App Capsule -->
</div>

<script>
    let lastToast = null;

    function toast(message) {
        if (lastToast) {
            lastToast.hideToast();
        }

        const copiedToastMarkup = `
            <div class="flex items-center p-2">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6236ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                </div>
                <div class="ms-1 flex-1">
                    <p class="text-xs font-semibold text-black" style="margin-bottom: 0 !important;">${message}</p>
                </div>
            </div>
        `;

        lastToast = Toastify({
            text: copiedToastMarkup,
            className: "fixed top-1 start-1/2 -translate-x-1/2 z-[1000] w-4/5 md:w-1/2 lg:w-1/4 bg-white text-sm text-black rounded-xl shadow-lg [&>.toast-close]:hidden",
            duration: 4000,
            close: false,
            escapeMarkup: false
        });

        lastToast.showToast();
    }
</script>

@script
    <script>
        $wire.on('pending-task', (event) => {
            toast(event.message)
        });
    </script>
@endscript
