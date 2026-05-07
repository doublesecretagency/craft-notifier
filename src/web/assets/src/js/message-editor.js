// Register Trix's underline text attribute. Trix has no built-in underline
// (since hypertext links are typically underlined), so we add one explicitly
// for the custom toolbar's underline button to toggle.
if (typeof Trix !== 'undefined' && !Trix.config.textAttributes.underline) {
    Trix.config.textAttributes.underline = {
        style: { textDecoration: 'underline' },
        inheritable: true,
        parser: function(element) {
            return /(^|\s)underline(\s|$)/.test(element.style.textDecoration);
        },
    };
}

// Toggle between Code (Monaco) and Rich Text (Trix) editors on the email message body
window.notifierMessageEditor = {

    // Initialize the toggle for a given field wrapper
    init: function(fieldId) {
        // Get the field wrapper
        const $field = document.getElementById(fieldId);
        if (!$field) {
            return;
        }
        // Idempotent: don't double-init if Craft re-renders the form
        if ($field.dataset.initialized === '1') {
            return;
        }
        $field.dataset.initialized = '1';

        // Cache references to the relevant DOM nodes
        const $codeWrap = document.getElementById('email-message-editor-code');
        const $richWrap = document.getElementById('email-message-editor-rich');
        const $modeInput = document.getElementById('messageConfig-emailMessageMode');
        const $textarea = document.getElementById('messageConfig-emailMessage');
        const $richInput = document.getElementById('email-message-rich-input');
        const $trixEditor = $richWrap ? $richWrap.querySelector('trix-editor') : null;
        const $toggleGroup = document.getElementById('email-message-mode-toggle');
        const $codeBtn = $toggleGroup ? $toggleGroup.querySelector('[data-mode="code"]') : null;
        const $richBtn = $toggleGroup ? $toggleGroup.querySelector('[data-mode="rich"]') : null;

        // Bail if any required node is missing
        if (!$codeWrap || !$richWrap || !$modeInput || !$textarea || !$richInput || !$trixEditor) {
            return;
        }

        // Mark the visually active toggle button
        const setActiveButton = (mode) => {
            if ($codeBtn) $codeBtn.classList.toggle('active', mode === 'code');
            if ($richBtn) $richBtn.classList.toggle('active', mode === 'rich');
        };

        // Wait for Monaco to be available on the canonical textarea, then run callback with the editor instance
        const monacoReady = (callback) => {
            // Poll for at most 5 seconds (100 ticks of 50ms)
            let ticks = 0;
            const maxTicks = 100;
            const interval = setInterval(() => {
                if (window.monacoEditorInstances && window.monacoEditorInstances['messageConfig-emailMessage']) {
                    clearInterval(interval);
                    callback(window.monacoEditorInstances['messageConfig-emailMessage']);
                    return;
                }
                if (++ticks >= maxTicks) {
                    clearInterval(interval);
                }
            }, 50);
        };

        // Wait for Trix to initialize, then run callback
        const trixReady = (callback) => {
            // If Trix has already attached its editor, fire immediately
            if ($trixEditor.editor) {
                callback();
                return;
            }
            $trixEditor.addEventListener('trix-initialize', () => callback(), { once: true });
        };

        // Toggle to a specific mode (no-op if already there)
        const switchMode = (targetMode) => {
            if (targetMode === $field.dataset.mode) {
                return;
            }
            const value = $textarea.value;
            if (targetMode === 'rich') {
                // Seed Trix with the latest canonical value
                if ($trixEditor.editor) {
                    $trixEditor.editor.loadHTML(value);
                }
                $codeWrap.classList.add('hidden');
                $richWrap.classList.remove('hidden');
            } else {
                // Trix has been mirroring into the canonical textarea via trix-change; seed Monaco from it
                if (window.monacoEditorInstances && window.monacoEditorInstances['messageConfig-emailMessage']) {
                    window.monacoEditorInstances['messageConfig-emailMessage'].setValue(value);
                }
                $codeWrap.classList.remove('hidden');
                $richWrap.classList.add('hidden');
            }
            $field.dataset.mode = targetMode;
            $modeInput.value = targetMode;
            setActiveButton(targetMode);
        };

        // Hook Trix to mirror its hidden input back into the canonical textarea on every change
        trixReady(() => {
            $trixEditor.addEventListener('trix-change', () => {
                $textarea.value = $richInput.value;
            });
        });

        // Make sure Monaco is alive (so toggling later actually has an editor to seed)
        monacoReady(() => {});

        // Wire the toggle buttons
        if ($codeBtn) {
            $codeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                switchMode('code');
            });
        }
        if ($richBtn) {
            $richBtn.addEventListener('click', (e) => {
                e.preventDefault();
                switchMode('rich');
            });
        }
    },

};
