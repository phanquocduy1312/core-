/**
 * GrapesJS Core Commands
 */
(function (global) {
    'use strict';

    function initCommands(editor, config) {
        var Commands = editor.Commands;

        // Save Draft Command
        Commands.add('core:save-draft', {
            async run(ed) {
                var btn = document.getElementById('btn-save-draft');
                var btnText = btn ? btn.querySelector('.btn-text') : null;
                if (btnText) btnText.textContent = 'Đang lưu...';
                if (btn) btn.disabled = true;

                try {
                    await ed.store();
                    if (window.Swal) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Đã lưu bản nháp (GrapesJS Project Data)!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                } catch (err) {
                    if (window.Swal) {
                        Swal.fire('Lỗi', err.message || 'Không thể lưu bản nháp.', 'error');
                    } else {
                        alert(err.message || 'Lỗi khi lưu.');
                    }
                } finally {
                    if (btnText) btnText.textContent = 'Lưu nháp';
                    if (btn) btn.disabled = false;
                }
            }
        });

        // Publish Command
        Commands.add('core:publish', {
            async run(ed) {
                if (window.Swal) {
                    var confirm = await Swal.fire({
                        title: 'Xác nhận xuất bản?',
                        text: 'Trang sẽ được xuất bản công khai lên website khách hàng.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Xuất bản ngay',
                        cancelButtonText: 'Hủy',
                        confirmButtonColor: '#e32326'
                    });
                    if (!confirm.isConfirmed) return;
                }

                var btn = document.getElementById('btn-publish');
                var btnText = btn ? btn.querySelector('.btn-text') : null;
                if (btnText) btnText.textContent = 'Đang xuất bản...';
                if (btn) btn.disabled = true;

                try {
                    await global.GrapesLaravelStorage.publish(ed, config);
                    if (window.Swal) {
                        Swal.fire('Thành công', 'Trang đã được xuất bản trực tiếp lên website!', 'success');
                    }
                } catch (err) {
                    if (window.Swal) {
                        Swal.fire('Lỗi', err.message || 'Không thể xuất bản trang.', 'error');
                    } else {
                        alert(err.message || 'Lỗi khi xuất bản.');
                    }
                } finally {
                    if (btnText) btnText.textContent = 'Xuất bản';
                    if (btn) btn.disabled = false;
                }
            }
        });

        // Device Switch Commands
        Commands.add('set-device-desktop', {
            run(ed) { ed.setDevice('Desktop'); }
        });
        Commands.add('set-device-tablet', {
            run(ed) { ed.setDevice('Tablet'); }
        });
        Commands.add('set-device-mobile', {
            run(ed) { ed.setDevice('Mobile'); }
        });
    }

    global.GrapesCommands = {
        init: initCommands
    };
})(window);
