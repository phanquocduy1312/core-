/**
 * Visual & Accessibility Test Suite (FE Visual Validator)
 * Detects overlapping elements and text contrast ratio issues (WCAG AA).
 * Can be loaded on any SLY admin page or run automatically during headless tests.
 */
(function (global) {
    function parseColor(colorStr) {
        if (!colorStr) return null;
        let m = colorStr.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*([\d.]+))?\)$/);
        if (m) {
            return {
                r: parseInt(m[1]),
                g: parseInt(m[2]),
                b: parseInt(m[3]),
                a: m[4] !== undefined ? parseFloat(m[4]) : 1
            };
        }
        if (colorStr.startsWith('#')) {
            let c = colorStr.slice(1);
            if (c.length === 3) {
                return { r: parseInt(c[0]+c[0], 16), g: parseInt(c[1]+c[1], 16), b: parseInt(c[2]+c[2], 16), a: 1 };
            }
            if (c.length === 6) {
                return { r: parseInt(c.slice(0, 2), 16), g: parseInt(c.slice(2, 4), 16), b: parseInt(c.slice(4, 6), 16), a: 1 };
            }
        }
        return null;
    }

    function getLuminance(rgb) {
        let r = rgb.r / 255;
        let g = rgb.g / 255;
        let b = rgb.b / 255;
        r = r <= 0.03928 ? r / 12.92 : Math.pow((r + 0.055) / 1.055, 2.4);
        g = g <= 0.03928 ? g / 12.92 : Math.pow((g + 0.055) / 1.055, 2.4);
        b = b <= 0.03928 ? b / 12.92 : Math.pow((b + 0.055) / 1.055, 2.4);
        return 0.2126 * r + 0.7152 * g + 0.0722 * b;
    }

    function getContrastRatio(l1, l2) {
        return (Math.max(l1, l2) + 0.05) / (Math.min(l1, l2) + 0.05);
    }

    function getEffectiveBackgroundColor(el) {
        let curr = el;
        while (curr) {
            let style = window.getComputedStyle(curr);
            let bg = style.backgroundColor;
            let parsed = parseColor(bg);
            if (parsed && parsed.a > 0.05 && bg !== 'transparent' && bg !== 'rgba(0, 0, 0, 0)') {
                return parsed;
            }
            curr = curr.parentElement;
        }
        return { r: 255, g: 255, b: 255, a: 1 };
    }

    class VisualValidator {
        constructor() {
            this.errors = [];
            this.overlays = [];
        }

        clear() {
            this.errors = [];
            this.overlays.forEach(overlay => overlay.remove());
            this.overlays = [];
        }

        run() {
            this.clear();
            this.detectOverlaps();
            this.detectLowContrast();
            return this.errors;
        }

        detectOverlaps() {
            const elements = Array.from(document.querySelectorAll('body *:not(script):not(style):not(svg):not(path):not(link)'))
                .filter(el => {
                    const style = window.getComputedStyle(el);
                    if (style.display === 'none' || style.visibility === 'hidden' || style.opacity === '0') return false;
                    const rect = el.getBoundingClientRect();
                    return rect.width > 2 && rect.height > 2;
                });

            for (let i = 0; i < elements.length; i++) {
                const el1 = elements[i];
                const rect1 = el1.getBoundingClientRect();

                // Only check text container tags, buttons, select, and input elements for overlapping
                const isCheckable = ['SPAN', 'P', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'LABEL', 'A', 'BUTTON', 'INPUT', 'SELECT', 'TEXTAREA'].includes(el1.tagName) || el1.className.includes('gjs-');
                if (!isCheckable) continue;

                for (let j = i + 1; j < elements.length; j++) {
                    const el2 = elements[j];
                    if (el1.contains(el2) || el2.contains(el1)) continue; // Skip ancestor/descendant relationships

                    const rect2 = el2.getBoundingClientRect();

                    const isOverlapping = !(rect1.right <= rect2.left || 
                                            rect1.left >= rect2.right || 
                                            rect1.bottom <= rect2.top || 
                                            rect1.top >= rect2.bottom);

                    if (isOverlapping) {
                        const s1 = window.getComputedStyle(el1);
                        const s2 = window.getComputedStyle(el2);
                        if (s1.position !== 'static' || s2.position !== 'static') {
                            this.errors.push({
                                type: 'overlap',
                                severity: 'warning',
                                message: `Phần tử <${el1.tagName.toLowerCase()}> và <${el2.tagName.toLowerCase()}> bị đè lên nhau.`,
                                selector1: el1.className || el1.tagName,
                                selector2: el2.className || el2.tagName
                            });
                        }
                    }
                }
            }
        }

        detectLowContrast() {
            const textElements = Array.from(document.querySelectorAll('body *:not(script):not(style):not(svg):not(path)'))
                .filter(el => {
                    let hasText = false;
                    for (let node of el.childNodes) {
                        if (node.nodeType === Node.TEXT_NODE && node.nodeValue.trim().length > 0) {
                            hasText = true;
                            break;
                        }
                    }
                    if (!hasText) return false;

                    const style = window.getComputedStyle(el);
                    if (style.display === 'none' || style.visibility === 'hidden' || style.opacity === '0') return false;
                    const rect = el.getBoundingClientRect();
                    return rect.width > 0 && rect.height > 0;
                });

            textElements.forEach(el => {
                const style = window.getComputedStyle(el);
                const fgColor = parseColor(style.color);
                if (!fgColor) return;

                const bgColor = getEffectiveBackgroundColor(el);
                const fgLuminance = getLuminance(fgColor);
                const bgLuminance = getLuminance(bgColor);
                const ratio = getContrastRatio(fgLuminance, bgLuminance);

                const fontSize = parseFloat(style.fontSize);
                const fontWeight = style.fontWeight;
                const isLarge = fontSize >= 24 || (fontSize >= 18.6 && (fontWeight === 'bold' || parseInt(fontWeight) >= 700));
                const threshold = isLarge ? 3.0 : 4.5;

                if (ratio < threshold) {
                    this.errors.push({
                        type: 'contrast',
                        severity: ratio < 3.0 ? 'critical' : 'warning',
                        message: `Độ tương phản thấp (${ratio.toFixed(2)}:1, yêu cầu >= ${threshold}:1) cho văn bản "${el.textContent.trim().slice(0, 30)}..."`,
                        selector: el.className || el.tagName,
                        ratio: ratio
                    });
                }
            });
        }

        highlight(error) {
            // Can be resolved by DOM selectors returned in headless reports
        }
    }

    // UI Helper Dashboard inside local environment
    function initUI() {
        let validator = new VisualValidator();
        global.__visualValidatorInstance = validator;

        const container = document.createElement('div');
        container.id = 'visual-validator-hud';
        container.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999999;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            width: 320px;
            max-height: 400px;
            display: flex;
            flex-direction: column;
            font-family: system-ui, -apple-system, sans-serif;
            overflow: hidden;
            font-size: 13px;
        `;

        const header = document.createElement('div');
        header.style.cssText = `
            background: #1e293b;
            color: #ffffff;
            padding: 10px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 700;
        `;
        header.innerHTML = `
            <span>Visual Check Tool</span>
            <button id="visual-hud-close" style="background:none;border:none;color:#94a3b8;cursor:pointer;font-weight:bold;font-size:16px;">&times;</button>
        `;

        const content = document.createElement('div');
        content.id = 'visual-validator-results';
        content.style.cssText = `
            padding: 12px;
            overflow-y: auto;
            flex-grow: 1;
        `;
        content.innerHTML = `<p style="color:#64748b;margin:0;text-align:center;">Bấm nút quét bên dưới để kiểm thử giao diện.</p>`;

        const footer = document.createElement('div');
        footer.style.cssText = `
            padding: 8px 12px;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
            display: flex;
            gap: 8px;
        `;

        const scanBtn = document.createElement('button');
        scanBtn.textContent = 'Quét giao diện';
        scanBtn.style.cssText = `
            flex-grow: 1;
            background: #3b82f6;
            color: #ffffff;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        `;

        const clearBtn = document.createElement('button');
        clearBtn.textContent = 'Clear';
        clearBtn.style.cssText = `
            background: #e2e8f0;
            color: #475569;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
        `;

        footer.append(scanBtn, clearBtn);
        container.append(header, content, footer);
        document.body.appendChild(container);

        scanBtn.addEventListener('click', () => {
            const errors = validator.run();
            content.innerHTML = '';
            if (errors.length === 0) {
                content.innerHTML = `<p style="color:#10b981;margin:0;font-weight:600;text-align:center;">✨ Giao diện hoàn hảo! Không có lỗi đè khối hay chìm chữ.</p>`;
            } else {
                errors.forEach((err, idx) => {
                    const row = document.createElement('div');
                    row.style.cssText = `
                        padding: 8px;
                        border-bottom: 1px solid #f1f5f9;
                        cursor: pointer;
                        border-radius: 4px;
                        margin-bottom: 4px;
                        background: ${err.severity === 'critical' ? '#fef2f2' : '#fffbeb'};
                    `;
                    row.innerHTML = `
                        <div style="font-weight:700;color:${err.severity === 'critical' ? '#b91c1c' : '#b45309'}">
                            ${err.type === 'overlap' ? '⚠️ Đè khối' : '🔍 Độ tương phản'}
                        </div>
                        <div style="font-size:11px;color:#334155;margin-top:2px;">${err.message}</div>
                    `;
                    content.appendChild(row);
                });
            }
        });

        clearBtn.addEventListener('click', () => {
            validator.clear();
            content.innerHTML = `<p style="color:#64748b;margin:0;text-align:center;">Đã xóa highlight.</p>`;
        });

        header.querySelector('#visual-hud-close').addEventListener('click', () => {
            container.remove();
        });
    }

    window.addEventListener('keydown', (e) => {
        if (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === 'v') {
            const hud = document.getElementById('visual-validator-hud');
            if (hud) {
                hud.remove();
            } else {
                initUI();
            }
        }
    });

    global.VisualValidator = VisualValidator;
})(window);
