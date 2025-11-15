(function () {
    const DEFAULT_COMMANDS = [
        { command: 'bold', icon: '<b>B</b>', title: 'Bold' },
        { command: 'italic', icon: '<i>I</i>', title: 'Italic' },
        { command: 'underline', icon: '<u>U</u>', title: 'Underline' },
        { command: 'strikeThrough', icon: '<s>S</s>', title: 'Strike' },
        { command: 'insertOrderedList', icon: '&#35;', title: 'Ordered list' },
        { command: 'insertUnorderedList', icon: '&#8226;', title: 'Bullet list' },
        { command: 'formatBlock', value: 'blockquote', icon: '&#8220;&#8221;', title: 'Quote' },
        { command: 'createLink', icon: '&#128279;', title: 'Link' },
        { command: 'removeFormat', icon: '&#8999;', title: 'Clear formatting' }
    ];

    function createButton(config, editor) {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'rte-button';
        button.innerHTML = config.icon;
        button.title = config.title || '';
        button.addEventListener('click', function () {
            editor.editable.focus();
            if (config.command === 'createLink') {
                const url = prompt('Enter URL', 'https://');
                if (url) {
                    document.execCommand('createLink', false, url);
                }
            } else if (config.command === 'formatBlock' && config.value) {
                document.execCommand(config.command, false, config.value);
            } else {
                document.execCommand(config.command, false, config.value || null);
            }
            editor.syncToTextarea();
        });
        return button;
    }

    class RichTextEditor {
        constructor(target, options = {}) {
            this.options = options;
            this.textarea = typeof target === 'string' ? document.querySelector(target) : target;
            if (!this.textarea) {
                throw new Error('RichTextEditor target not found.');
            }
            if (this.textarea.dataset && this.textarea.dataset.richtexteditorInitialized) {
                this.container = this.textarea.nextElementSibling;
                this.editable = this.container ? this.container.querySelector('.rte-editable') : null;
                this.toolbar = this.container ? this.container.querySelector('.rte-toolbar') : null;
            } else {
                this._init();
            }
        }

        _init() {
            this.textarea.classList.add('rte-hidden-textarea');

            this.container = document.createElement('div');
            this.container.className = 'rte-container';

            this.toolbar = document.createElement('div');
            this.toolbar.className = 'rte-toolbar';

            const commands = this.options.commands || DEFAULT_COMMANDS;
            commands.forEach(cmd => {
                const button = createButton(cmd, this);
                this.toolbar.appendChild(button);
            });

            this.editable = document.createElement('div');
            this.editable.className = 'rte-editable';
            this.editable.contentEditable = true;
            this.editable.innerHTML = this.textarea.value || '';
            if (this.options.placeholder) {
                this.editable.dataset.placeholder = this.options.placeholder;
            }
            if (this.textarea.style.height) {
                this.editable.style.minHeight = this.textarea.style.height;
            }

            this.editable.addEventListener('input', () => this.syncToTextarea());
            this.editable.addEventListener('blur', () => this.syncToTextarea());

            this.container.appendChild(this.toolbar);
            this.container.appendChild(this.editable);

            this.textarea.style.display = 'none';
            this.textarea.parentNode.insertBefore(this.container, this.textarea.nextSibling);

            const form = this.textarea.form;
            if (form) {
                form.addEventListener('submit', () => this.syncToTextarea());
            }

            if (this.textarea.dataset) {
                this.textarea.dataset.richtexteditorInitialized = 'true';
            }
        }

        syncToTextarea() {
            this.textarea.value = this.getHTMLCode();
        }

        getHTMLCode() {
            return this.editable.innerHTML;
        }

        setHTMLCode(html) {
            this.editable.innerHTML = html || '';
            this.syncToTextarea();
        }
    }

    window.RichTextEditor = RichTextEditor;
})();
