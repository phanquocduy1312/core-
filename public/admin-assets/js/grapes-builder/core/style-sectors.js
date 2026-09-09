/**
 * GrapesJS Style Manager sectors.
 *
 * The previous sector list exposed ~15 properties and forced font-size /
 * spacing through fixed <select> lists, so anything the presets did not cover
 * simply could not be styled. These sectors expose the full CSS surface a
 * designer needs and keep every numeric field free-form (type any value, any
 * unit), which is what "chỉnh sửa tự do" requires.
 */
(function (global) {
    'use strict';

    // Fonts actually shipped by the LuxLight theme, plus safe web fallbacks.
    var FONT_OPTIONS = [
        { value: '', name: 'Kế thừa (Inherit)' },
        { value: "'DIN', 'Din', sans-serif", name: 'DIN (thân trang)' },
        { value: "'ACaslonPro', Georgia, serif", name: 'ACaslon Pro (tiêu đề)' },
        { value: "'Montserrat', sans-serif", name: 'Montserrat' },
        { value: "'Roboto', sans-serif", name: 'Roboto' },
        { value: "'Quicksand', sans-serif", name: 'Quicksand' },
        { value: 'Arial, Helvetica, sans-serif', name: 'Arial' },
        { value: 'Georgia, serif', name: 'Georgia' },
        { value: "'Times New Roman', serif", name: 'Times New Roman' },
        { value: "'Courier New', monospace", name: 'Courier New' }
    ];

    var UNITS_LEN = ['px', '%', 'em', 'rem', 'vw', 'vh'];

    function len(property, label, opts) {
        return Object.assign({
            property: property,
            label: label,
            type: 'number',
            units: UNITS_LEN,
            fixedValues: ['initial', 'inherit', 'auto', 'none']
        }, opts || {});
    }

    function select(property, label, options, opts) {
        return Object.assign({
            property: property,
            label: label,
            type: 'select',
            options: options.map(function (o) {
                return typeof o === 'string' ? { id: o, label: o } : o;
            })
        }, opts || {});
    }

    /**
     * Force every generated declaration to carry `!important`.
     *
     * This theme is a WordPress export whose `wp-custom-css` block holds 369
     * `!important` declarations across 46 properties (background-image, color,
     * font-size, display, margin, …). An `!important` rule beats any normal one
     * regardless of specificity, so a builder rule like
     *
     *     #il89z { background-image: url(new) }
     *
     * silently lost to
     *
     *     .index-hero .separador { background-image: url(old) !important }
     *
     * and the editor appeared to accept a change that never rendered. Marking
     * the properties important puts both declarations in the same tier, where
     * the id selector (1,0,0) wins over the theme's class selectors.
     *
     * GrapesJS appends the keyword in Property#getFullValue() when this flag is
     * set, so it applies to the live canvas and the published CSS alike.
     */
    /**
     * Force generated declarations to carry `!important` so they win against
     * legacy WordPress/Elementor theme styles with !important.
     *
     * IMPORTANT FIX: For composite properties (padding, margin, border-radius, border):
     * - If detached: true, the parent composite DOES NOT emit CSS; each sub-property
     *   emits its own independent declaration with `!important` (e.g. `padding-top: 8px !important;`).
     * - If detached: false, only the parent composite emits `!important`; sub-properties
     *   must NOT have `!important` or else GrapesJS concatenates `8px !important 9px !important`
     *   which produces broken/invalid CSS that browsers discard!
     */
    function markImportant(properties) {
        (properties || []).forEach(function (prop) {
            if (!prop || typeof prop !== 'object') return;
            if (prop.type === 'composite' && !prop.detached) {
                prop.important = true;
                if (prop.properties) {
                    prop.properties.forEach(function (sub) {
                        sub.important = false;
                    });
                }
            } else if (prop.type === 'composite' && prop.detached) {
                prop.important = false;
                if (prop.properties) markImportant(prop.properties);
            } else {
                prop.important = true;
                if (prop.properties) markImportant(prop.properties);
            }
        });
        return properties;
    }

    function build() {
        return buildSectors().map(function (sector) {
            sector.properties = markImportant(sector.properties);
            return sector;
        });
    }

    function buildSectors() {
        return [
            {
                id: 'layout',
                name: 'Bố cục (Layout)',
                open: true,
                properties: [
                    select('display', 'Kiểu hiển thị (Display)', [
                        { id: '', label: 'Mặc định' },
                        { id: 'block', label: 'Khối (block)' },
                        { id: 'inline-block', label: 'Khối nội tuyến (inline-block)' },
                        { id: 'inline', label: 'Nội tuyến (inline)' },
                        { id: 'flex', label: 'Linh hoạt (flex)' },
                        { id: 'inline-flex', label: 'Linh hoạt nội tuyến (inline-flex)' },
                        { id: 'grid', label: 'Lưới (grid)' },
                        { id: 'none', label: 'Ẩn (none)' }
                    ]),
                    select('position', 'Vị trí (Position)', [
                        { id: '', label: 'Mặc định (static)' },
                        { id: 'static', label: 'Tĩnh (static)' },
                        { id: 'relative', label: 'Tương đối (relative)' },
                        { id: 'absolute', label: 'Tuyệt đối (absolute)' },
                        { id: 'fixed', label: 'Cố định (fixed)' },
                        { id: 'sticky', label: 'Dính khi cuộn (sticky)' }
                    ]),
                    len('top', 'Trên (Top)'),
                    len('right', 'Phải (Right)'),
                    len('bottom', 'Dưới (Bottom)'),
                    len('left', 'Trái (Left)'),
                    { property: 'z-index', label: 'Lớp chồng (Z-Index)', type: 'number', units: [] },
                    select('overflow', 'Tràn nội dung (Overflow)', [
                        { id: '', label: 'Mặc định' },
                        { id: 'visible', label: 'Hiển thị tràn (visible)' },
                        { id: 'hidden', label: 'Cắt tràn (hidden)' },
                        { id: 'scroll', label: 'Thanh cuộn (scroll)' },
                        { id: 'auto', label: 'Tự động (auto)' }
                    ]),
                    select('float', 'Nổi (Float)', [
                        { id: '', label: 'Mặc định' },
                        { id: 'none', label: 'Không nổi (none)' },
                        { id: 'left', label: 'Nổi bên trái (left)' },
                        { id: 'right', label: 'Nổi bên phải (right)' }
                    ])
                ]
            },
            {
                id: 'dimension',
                name: 'Kích thước & Khoảng cách',
                open: true,
                properties: [
                    len('width', 'Chiều rộng (Width)'),
                    len('height', 'Chiều cao (Height)'),
                    len('max-width', 'Rộng tối đa (Max Width)'),
                    len('min-width', 'Rộng tối thiểu (Min Width)'),
                    len('max-height', 'Cao tối đa (Max Height)'),
                    len('min-height', 'Cao tối thiểu (Min Height)'),
                    {
                        property: 'padding',
                        label: 'Đệm trong (Padding)',
                        type: 'composite',
                        detached: true,
                        properties: [
                            len('padding-top', 'Trên'),
                            len('padding-right', 'Phải'),
                            len('padding-bottom', 'Dưới'),
                            len('padding-left', 'Trái')
                        ]
                    },
                    {
                        property: 'margin',
                        label: 'Lề ngoài (Margin)',
                        type: 'composite',
                        detached: true,
                        properties: [
                            len('margin-top', 'Trên'),
                            len('margin-right', 'Phải'),
                            len('margin-bottom', 'Dưới'),
                            len('margin-left', 'Trái')
                        ]
                    }
                ]
            },
            {
                id: 'flex-grid',
                name: 'Flex & Lưới (Grid)',
                open: false,
                properties: [
                    select('flex-direction', 'Hướng (Direction)', [
                        'row', 'row-reverse', 'column', 'column-reverse'
                    ]),
                    select('flex-wrap', 'Xuống dòng (Wrap)', ['nowrap', 'wrap', 'wrap-reverse']),
                    select('justify-content', 'Căn theo trục chính', [
                        'flex-start', 'center', 'flex-end', 'space-between', 'space-around', 'space-evenly'
                    ]),
                    select('align-items', 'Căn theo trục phụ', [
                        'stretch', 'flex-start', 'center', 'flex-end', 'baseline'
                    ]),
                    select('align-content', 'Căn nhiều hàng', [
                        'stretch', 'flex-start', 'center', 'flex-end', 'space-between', 'space-around'
                    ]),
                    len('gap', 'Khoảng cách (Gap)'),
                    { property: 'grid-template-columns', label: 'Cột lưới (Grid Columns)', type: 'text' },
                    { property: 'grid-template-rows', label: 'Hàng lưới (Grid Rows)', type: 'text' },
                    { property: 'flex-grow', label: 'Giãn nở (Grow)', type: 'number', units: [] },
                    { property: 'flex-shrink', label: 'Co lại (Shrink)', type: 'number', units: [] },
                    len('flex-basis', 'Cơ sở (Basis)'),
                    select('align-self', 'Tự căn (Align Self)', [
                        'auto', 'flex-start', 'center', 'flex-end', 'stretch', 'baseline'
                    ]),
                    { property: 'order', label: 'Thứ tự (Order)', type: 'number', units: [] }
                ]
            },
            {
                id: 'typography',
                name: 'Kiểu chữ (Typography)',
                open: true,
                properties: [
                    {
                        property: 'font-family',
                        label: 'Phông chữ (Font)',
                        type: 'select',
                        options: FONT_OPTIONS.map(function (f) {
                            return { id: f.value, label: f.name };
                        })
                    },
                    len('font-size', 'Cỡ chữ (Font Size)', { default: '16px' }),
                    select('font-weight', 'Độ đậm (Weight)', [
                        { id: '100', label: '100 — Mảnh nhất' },
                        { id: '200', label: '200' },
                        { id: '300', label: '300 — Light' },
                        { id: '400', label: '400 — Regular' },
                        { id: '500', label: '500 — Medium' },
                        { id: '600', label: '600 — SemiBold' },
                        { id: '700', label: '700 — Bold' },
                        { id: '800', label: '800 — ExtraBold' },
                        { id: '900', label: '900 — Black' }
                    ]),
                    { property: 'line-height', label: 'Giãn dòng (Line Height)', type: 'number', units: ['', 'px', 'em', '%'] },
                    len('letter-spacing', 'Giãn chữ (Letter Spacing)'),
                    { property: 'color', label: 'Màu chữ (Color)', type: 'color' },
                    {
                        property: 'text-align',
                        label: 'Căn lề (Align)',
                        type: 'radio',
                        options: [
                            { id: 'left', label: 'Trái' },
                            { id: 'center', label: 'Giữa' },
                            { id: 'right', label: 'Phải' },
                            { id: 'justify', label: 'Đều' }
                        ]
                    },
                    select('text-transform', 'Biến đổi chữ (Transform)', [
                        { id: 'none', label: 'Giữ nguyên' },
                        { id: 'uppercase', label: 'IN HOA' },
                        { id: 'lowercase', label: 'chữ thường' },
                        { id: 'capitalize', label: 'Viết Hoa Đầu Từ' }
                    ]),
                    select('text-decoration', 'Gạch chân (Decoration)', [
                        { id: '', label: 'Mặc định' },
                        { id: 'none', label: 'Không gạch (none)' },
                        { id: 'underline', label: 'Gạch chân (underline)' },
                        { id: 'line-through', label: 'Gạch ngang chữ (line-through)' },
                        { id: 'overline', label: 'Gạch trên đầu (overline)' }
                    ]),
                    { property: 'text-shadow', label: 'Đổ bóng chữ', type: 'stack' },
                    select('white-space', 'Ngắt dòng (White Space)', [
                        { id: '', label: 'Mặc định' },
                        { id: 'normal', label: 'Bình thường (normal)' },
                        { id: 'nowrap', label: 'Không ngắt dòng (nowrap)' },
                        { id: 'pre', label: 'Giữ nguyên khoảng trắng (pre)' },
                        { id: 'pre-wrap', label: 'Tự bẻ dòng khi hết chỗ (pre-wrap)' },
                        { id: 'pre-line', label: 'Gộp khoảng trắng (pre-line)' }
                    ])
                ]
            },
            {
                id: 'decorations',
                name: 'Nền & Viền (Decorations)',
                open: false,
                properties: [
                    { property: 'opacity', label: 'Độ mờ (Opacity)', type: 'slider', min: 0, max: 1, step: 0.01 },
                    { property: 'background-color', label: 'Màu nền', type: 'color' },
                    {
                        property: 'background-image',
                        label: 'Ảnh nền',
                        type: 'file',
                        functionName: 'url',
                    },
                    select('background-repeat', 'Lặp ảnh nền', [
                        { id: '', label: 'Mặc định (Kế thừa)' },
                        { id: 'no-repeat', label: 'Không lặp (no-repeat)' },
                        { id: 'repeat', label: 'Lặp lại cả hai (repeat)' },
                        { id: 'repeat-x', label: 'Lặp theo chiều ngang (repeat-x)' },
                        { id: 'repeat-y', label: 'Lặp theo chiều dọc (repeat-y)' }
                    ]),
                    select('background-size', 'Kích thước ảnh nền', [
                        { id: '', label: 'Mặc định' },
                        { id: 'cover', label: 'Bao phủ toàn bộ (cover)' },
                        { id: 'contain', label: 'Vừa vặn trong khung (contain)' },
                        { id: 'auto', label: 'Kích thước gốc (auto)' },
                        { id: '100% 100%', label: 'Kéo dãn đầy khung (100% 100%)' }
                    ]),
                    select('background-position', 'Vị trí ảnh nền', [
                        { id: '', label: 'Mặc định' },
                        { id: 'center center', label: 'Chính giữa (center)' },
                        { id: 'top center', label: 'Trên giữa (top center)' },
                        { id: 'bottom center', label: 'Dưới giữa (bottom center)' },
                        { id: 'left center', label: 'Trái giữa (left center)' },
                        { id: 'right center', label: 'Phải giữa (right center)' },
                        { id: 'top left', label: 'Góc trên bên trái (top left)' },
                        { id: 'top right', label: 'Góc trên bên phải (top right)' },
                        { id: 'bottom left', label: 'Góc dưới bên trái (bottom left)' },
                        { id: 'bottom right', label: 'Góc dưới bên phải (bottom right)' }
                    ]),
                    select('background-attachment', 'Cuộn ảnh nền', [
                        { id: '', label: 'Mặc định' },
                        { id: 'scroll', label: 'Cuộn theo trang (scroll)' },
                        { id: 'fixed', label: 'Cố định nền / Parallax (fixed)' },
                        { id: 'local', label: 'Cuộn cùng nội dung (local)' }
                    ]),
                    {
                        property: 'border-radius',
                        label: 'Bo góc (Radius)',
                        type: 'composite',
                        detached: true,
                        properties: [
                            len('border-top-left-radius', 'Trên trái'),
                            len('border-top-right-radius', 'Trên phải'),
                            len('border-bottom-right-radius', 'Dưới phải'),
                            len('border-bottom-left-radius', 'Dưới trái')
                        ]
                    },
                    {
                        property: 'border',
                        label: 'Đường viền (Border)',
                        type: 'composite',
                        detached: true,
                        properties: [
                            len('border-width', 'Độ dày'),
                            select('border-style', 'Kiểu', [
                                { id: '', label: 'Mặc định' },
                                { id: 'none', label: 'Không viền (none)' },
                                { id: 'solid', label: 'Nét liền (solid)' },
                                { id: 'dashed', label: 'Nét đứt (dashed)' },
                                { id: 'dotted', label: 'Chấm chấm (dotted)' },
                                { id: 'double', label: 'Nét đôi (double)' }
                            ]),
                            { property: 'border-color', label: 'Màu', type: 'color' }
                        ]
                    },
                    { property: 'box-shadow', label: 'Đổ bóng khối', type: 'stack' }
                ]
            },
            {
                id: 'effects',
                name: 'Hiệu ứng (Effects)',
                open: false,
                properties: [
                    { property: 'transition', label: 'Chuyển động (Transition)', type: 'stack' },
                    {
                        property: 'transform',
                        label: 'Biến hình (Transform)',
                        type: 'text',
                        placeholder: 'rotate(5deg), scale(1.05), translateY(-4px)...'
                    },
                    { property: 'filter', label: 'Bộ lọc (Filter)', type: 'text', placeholder: 'blur(2px), grayscale(50%)...' },
                    select('cursor', 'Con trỏ chuột (Cursor)', [
                        { id: '', label: 'Mặc định (default)' },
                        { id: 'pointer', label: 'Bàn tay click (pointer)' },
                        { id: 'default', label: 'Mũi tên (default)' },
                        { id: 'text', label: 'Con trỏ văn bản (text)' },
                        { id: 'move', label: 'Di chuyển (move)' },
                        { id: 'not-allowed', label: 'Cấm thao tác (not-allowed)' },
                        { id: 'grab', label: 'Nắm kéo (grab)' }
                    ]),
                    select('object-fit', 'Cách lấp khung (Object Fit)', [
                        { id: '', label: 'Mặc định' },
                        { id: 'cover', label: 'Phủ kín cắt viền (cover)' },
                        { id: 'contain', label: 'Vừa trọn khung (contain)' },
                        { id: 'fill', label: 'Lấp đầy kéo giãn (fill)' },
                        { id: 'none', label: 'Kích thước gốc (none)' },
                        { id: 'scale-down', label: 'Thu nhỏ vừa khung (scale-down)' }
                    ]),
                    { property: 'object-position', label: 'Trọng tâm (Object Position)', type: 'text', placeholder: 'center, top left...' }
                ]
            }
        ];
    }

    global.GrapesStyleSectors = { build: build, fonts: FONT_OPTIONS };
})(window);
