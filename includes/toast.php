<!-- Toast Notification System (React-Toastify style) -->
<div id="toast-container"></div>
<style>
  /* ===== Toast Container ===== */
  #toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 999999;
    display: flex;
    flex-direction: column;
    gap: 12px;
    pointer-events: none;
  }

  /* ===== Individual Toast ===== */
  .sa-toast {
    pointer-events: auto;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    min-width: 320px;
    max-width: 420px;
    padding: 14px 18px;
    border-radius: 10px;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    font-size: 14px;
    font-weight: 500;
    color: #fff;
    box-shadow: 0 8px 30px rgba(0,0,0,0.18), 0 2px 8px rgba(0,0,0,0.12);
    position: relative;
    overflow: hidden;
    animation: toast-slide-in 0.4s cubic-bezier(0.21, 1.02, 0.73, 1) forwards;
    cursor: pointer;
    line-height: 1.45;
  }

  .sa-toast.removing {
    animation: toast-slide-out 0.35s cubic-bezier(0.06, 0.71, 0.55, 1) forwards;
  }

  /* ===== Type Colors ===== */
  .sa-toast.toast-success { background: linear-gradient(135deg, #07bc0c 0%, #059709 100%); }
  .sa-toast.toast-error   { background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); }
  .sa-toast.toast-warning { background: linear-gradient(135deg, #f1c40f 0%, #e67e22 100%); color: #1a1a1a; }
  .sa-toast.toast-info    { background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); }

  /* ===== Icon ===== */
  .sa-toast-icon {
    flex-shrink: 0;
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-top: 1px;
  }

  /* ===== Close Button ===== */
  .sa-toast-close {
    flex-shrink: 0;
    background: none;
    border: none;
    color: inherit;
    opacity: 0.7;
    cursor: pointer;
    font-size: 18px;
    padding: 0;
    margin-left: auto;
    line-height: 1;
    transition: opacity 0.2s;
  }
  .sa-toast-close:hover { opacity: 1; }

  /* ===== Progress Bar ===== */
  .sa-toast-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    background: rgba(255,255,255,0.45);
    border-radius: 0 0 10px 10px;
    animation: toast-progress linear forwards;
  }
  .sa-toast.toast-warning .sa-toast-progress {
    background: rgba(0,0,0,0.2);
  }

  /* ===== Animations ===== */
  @keyframes toast-slide-in {
    0%   { transform: translateX(120%); opacity: 0; }
    100% { transform: translateX(0);    opacity: 1; }
  }
  @keyframes toast-slide-out {
    0%   { transform: translateX(0);    opacity: 1; max-height: 200px; margin-bottom: 0; }
    100% { transform: translateX(120%); opacity: 0; max-height: 0;     margin-bottom: -12px; padding: 0 18px; }
  }
  @keyframes toast-progress {
    0%   { width: 100%; }
    100% { width: 0%;   }
  }

  /* ===== Responsive ===== */
  @media (max-width: 480px) {
    #toast-container {
      top: auto;
      bottom: 16px;
      right: 16px;
      left: 16px;
    }
    .sa-toast { min-width: unset; max-width: 100%; }
  }
</style>

<script>
/**
 * Show a toast notification.
 * @param {string}  message           - The message to display
 * @param {string}  [type='success']  - 'success' | 'error' | 'warning' | 'info'
 * @param {number}  [duration=3500]   - Auto-close duration in ms
 * @param {function} [onClose]        - Callback after toast closes
 */
function showToast(message, type, duration, onClose) {
  type = type || 'success';
  duration = duration || 3500;

  var icons = {
    success: '✅',
    error:   '❌',
    warning: '⚠️',
    info:    'ℹ️'
  };

  var container = document.getElementById('toast-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toast-container';
    document.body.appendChild(container);
  }

  var toast = document.createElement('div');
  toast.className = 'sa-toast toast-' + type;

  toast.innerHTML =
    '<span class="sa-toast-icon">' + (icons[type] || icons.info) + '</span>' +
    '<span class="sa-toast-msg">' + message + '</span>' +
    '<button class="sa-toast-close" aria-label="Close">&times;</button>' +
    '<div class="sa-toast-progress" style="animation-duration:' + duration + 'ms"></div>';

  container.appendChild(toast);

  // Close handler
  function dismiss() {
    if (toast.classList.contains('removing')) return;
    toast.classList.add('removing');
    setTimeout(function () {
      if (toast.parentNode) toast.parentNode.removeChild(toast);
      if (typeof onClose === 'function') onClose();
    }, 350);
  }

  toast.querySelector('.sa-toast-close').addEventListener('click', dismiss);
  toast.addEventListener('click', dismiss);

  // Auto close
  setTimeout(dismiss, duration);

  return toast;
}

/**
 * Show toast then redirect after it closes.
 * @param {string} message
 * @param {string} type
 * @param {string} url - URL to navigate to after toast
 * @param {number} [duration=2000]
 */
function showToastThenRedirect(message, type, url, duration) {
  duration = duration || 2000;
  showToast(message, type, duration, function () {
    window.location.href = url;
  });
}
</script>
