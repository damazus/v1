var myEditor = new MTE(document.getElementById('markdown-editor'), {
    tabSize: '    ',
    shortcut: true,

    buttons: {
        rule: false,
        undo: false,
        redo: false
    }
});

myEditor.separator({position: 4});