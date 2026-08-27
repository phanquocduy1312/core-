<div id="page-builder-onboarding" class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 border border-blue-200 flex justify-between items-start gap-3" role="alert">
    <div>
        <strong class="font-bold">Cách dùng nhanh:</strong>
        <ol class="list-decimal list-inside mt-1 space-y-0.5 text-xs text-blue-700">
            <li>Kéo một khối từ bảng bên phải thả vào canvas.</li>
            <li>Bấm đúp vào chữ để sửa nội dung tại chỗ.</li>
            <li>Bấm vào ảnh rồi chọn "Chọn ảnh cho block" để đổi ảnh.</li>
            <li>Bấm "Lưu trang" khi hoàn tất.</li>
        </ol>
    </div>
    <button type="button" class="text-blue-500 hover:text-blue-700" id="page-builder-onboarding-dismiss" aria-label="Đóng">
        <iconify-icon icon="solar:close-circle-linear" class="text-lg"></iconify-icon>
    </button>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const banner = document.getElementById('page-builder-onboarding');
    if (!banner) return;
    const storageKey = 'pageBuilderOnboardingDismissed';
    if (window.localStorage.getItem(storageKey) === '1') {
        banner.remove();
        return;
    }
    document.getElementById('page-builder-onboarding-dismiss').addEventListener('click', function () {
        window.localStorage.setItem(storageKey, '1');
        banner.remove();
    });
});
</script>
