(function () {

	let url = window.location.hostname;
	let path = '/wp-content/plugins/custom-shortcode/assets/img/';
	let full = '//' + url + path;

    tinymce.create('tinymce.plugins.CustomShort', {
        init : function(editor, url) {
            editor.addButton('plus', {
                image: full + 'head_plus_icon.png',
                title: 'Цитата с плюсом',
                onclick: function () {
                    editor.insertContent('[plus_h]' + editor.selection.getContent() + '[/plus_h]');
                }
            });
            editor.addButton('minus', {
                image: full + 'head_minus_icon.png',
                title: 'Цитата с минусом',
                onclick: function () {
                    editor.insertContent('[minus_h]' + editor.selection.getContent() + '[/minus_h]');
                }
            });
            editor.addButton('gray', {
                image: full + 'gray_icon.png',
                title: 'Текст на сером фоне',
                onclick: function () {
                    editor.insertContent('[gray]' + editor.selection.getContent() + '[/gray]');
                }
            });
            editor.addButton('purple_border', {
                image: full + 'border_text.png',
                title: 'Текст с фиолетовой обводкой',
                onclick: function () {
                    editor.insertContent('[purple_bd]' + editor.selection.getContent() + '[/purple_bd]');
                }
            });
            editor.addButton('purple_background', {
                image: full + 'bg_text.png',
                title: 'Текст на фиолетовом фоне',
                onclick: function () {
                    editor.insertContent('[purple_bg]' + editor.selection.getContent() + '[/purple_bg]');
                }
            });
            editor.addButton('gradient_border', {
                image: full + 'bd_gradient.png',
                title: 'Текст с градиентоной обводкой',
                onclick: function () {
                    editor.insertContent('[gradient_bd]' + editor.selection.getContent() + '[/gradient_bd]');
                }
            });
            editor.addButton('gradient_background', {
                image: full +  'bg_gradient_u.png',
                title: 'Текст на градиентоном фоне',
                onclick: function () {
                    editor.insertContent('[gradient_bg]' + editor.selection.getContent() + '[/gradient_bg]');
                }
            });
            editor.addButton('light_gradient', {
                image: full + 'bg_color.png',
                title: 'Текст на градиентоном фоне',
                onclick: function () {
                    editor.insertContent('[gradient_color]' + editor.selection.getContent() + '[/gradient_color]');
                }
            });
            editor.addButton('custom_table', {
                image: full + 'table_icon.png',
                title: 'Таблица плюсов и минусов',
                onclick: function () {
                    editor.windowManager.open({
                        title: 'Задайте параметры таблицы',
                        body: [
                            {
                                type: 'textbox', // тип textbox = текстовое поле
                                name: 'head_plus', // ID, будет использоваться ниже
                                label: 'Заголовок плюсов', // лейбл
                                value: '', // значение по умолчанию
                                autofocus: true,
                            },
                            {
                                type: 'textbox', // тип textbox = текстовое поле
                                name: 'text_plus',
                                label: 'Текст плюсов',
                                value: '<ul>\n<li>List item</li>\n<li>List item</li>\n<li>List item</li>\n</ul>',
                                multiline: true, // большое текстовое поле - textarea
                                minWidth: 300, // минимальная ширина в пикселях
                                minHeight: 150, // минимальная высота в пикселях

                            },
                            {
                                type: 'textbox', // тип textbox = текстовое поле
                                name: 'head_minus', // ID, будет использоваться ниже
                                label: 'Заголовок минусов', // лейбл
                                value: '' // значение по умолчанию

                            },
                            {
                                type: 'textbox', // тип textbox = текстовое поле
                                name: 'text_minus',
                                label: 'Текст минусов',
                                value: '<ul>\n<li>List item</li>\n<li>List item</li>\n<li>List item</li>\n</ul>',
                                multiline: true, // большое текстовое поле - textarea
                                minWidth: 300, // минимальная ширина в пикселях
                                minHeight: 150, // минимальная высота в пикселях

                            },
                            {
                                type: 'textbox', // тип textbox = текстовое поле
                                name: 'gray',
                                label: 'Блок с серым фоном',
                                value: '',
                                multiline: true, // большое текстовое поле - textarea
                                minWidth: 300, // минимальная ширина в пикселях
                                minHeight: 100, // минимальная высота в пикселях

                            },

                        ],
                        onsubmit: function (e) { // это будет происходить после заполнения полей и нажатии кнопки отправки
                            editor.insertContent(
                                '<table cellpadding="0" cellspacing="0" width="100%" class="asl_custom_t">\n' +
                                '<tbody>\n' +
                                '<tr>\n' +

                                '<td class="plus">\n' +
                                '<div class="h3">✅ ' + e.data.head_plus + '</div>\n' +
                                e.data.text_plus +
                                '</td>\n' +
                                '<td class="minus">\n' +
                                '<div class="h3">⛔' + e.data.head_minus + '</div>\n' +
                                e.data.text_minus +
                                '</td>\n' +
                                '</tr>\n' +
                                '<tr class="gray_table">\n' +
                                '<td colspan=2>\n' +
                                e.data.gray +
                                '</td>\n' +
                                '</tr>\n' +
                                '</tbody>\n' +
                                '</table>\n');
                        }
                    });
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    /* Start the buttons */
    tinymce.PluginManager.add( 'custom_shortcodes', tinymce.plugins.CustomShort );
})();