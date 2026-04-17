<div id="toast-container" class="pointer-events-none fixed bottom-5 right-5 z-50 flex max-w-[360px] flex-col gap-2">
</div>

<script>
    (function () {
        if (window.showToast) {
            return;
        }

        window.showToast = function (message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container || !message) {
                return;
            }

            const id = 'toast-' + Math.random().toString(36).slice(2, 11);
            const isSuccess = type === 'success';

            const toastHtml = `
				<div id="${id}" class="pointer-events-auto flex items-start gap-3 rounded-lg border-l-4 bg-white p-4 shadow-lg transition-all duration-300 ${isSuccess ? 'border-green-500' : 'border-red-500'}" role="alert" aria-live="polite">
					<div class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg ${isSuccess ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500'}">
						${isSuccess
                    ? '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                    : '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'}
					</div>
					<div class="flex-1 text-sm font-medium text-gray-800">${message}</div>
					<button type="button" class="-mr-1 inline-flex h-7 w-7 items-center justify-center rounded text-gray-400 hover:bg-gray-100 hover:text-gray-700" aria-label="Close toast">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
					</button>
				</div>
			`;

            const wrapper = document.createElement('div');
            wrapper.innerHTML = toastHtml.trim();
            const toast = wrapper.firstChild;
            container.appendChild(toast);

            const closeButton = toast.querySelector('button');
            closeButton.addEventListener('click', () => removeToast(toast));

            setTimeout(() => removeToast(toast), 3500);
        };

        function removeToast(toast) {
            if (!toast || !toast.parentNode) {
                return;
            }
            toast.classList.add('opacity-0', 'translate-x-6');
            setTimeout(() => toast.remove(), 250);
        }
    })();

    window.addEventListener('DOMContentLoaded', () => {
        @if (session('success'))
            showToast(@js(session('success')), 'success');
        @endif

        @if (session('error'))
            showToast(@js(session('error')), 'error');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showToast(@js($error), 'error');
            @endforeach
        @endif
	});
</script>