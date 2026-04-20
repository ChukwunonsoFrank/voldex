import 'preline'

document.addEventListener('livewire:navigated', () => {
    // Re-initialize all Preline UI components
    if (window.HSStaticMethods) {
        window.HSStaticMethods.autoInit();
    }
});