/**
 * CKEditor 5 custom build integration for RamziNotes.
 * This file uses the local builder bundle in public/ckeditor5-builder-48.0.0.
 */

import {
    ClassicEditor,
    Autosave,
    Essentials,
    Paragraph,
    ImageUtils,
    ImageEditing,
    Bold,
    Italic,
    Underline,
    Strikethrough,
    Code,
    Subscript,
    Superscript,
    FontBackgroundColor,
    FontColor,
    FontFamily,
    FontSize,
    Highlight,
    Heading,
    Link,
    AutoLink,
    BlockQuote,
    HorizontalLine,
    CodeBlock,
    Indent,
    IndentBlock,
    Alignment,
    ImageInline,
    ImageToolbar,
    ImageBlock,
    ImageUpload,
    ImageInsertViaUrl,
    AutoImage,
    ImageStyle,
    LinkImage,
    ImageCaption,
    ImageTextAlternative,
    List,
    TodoList,
    Table,
    TableToolbar,
    PlainTableOutput,
    TableCaption,
    ShowBlocks,
    GeneralHtmlSupport,
    HtmlComment,
    MediaEmbed,
    Markdown,
    PasteFromMarkdownExperimental
} from 'ckeditor5';

const editorConfig = {
    placeholder: 'Type or paste your content here!',
    toolbar: {
        items: [
            'undo',
            'redo',
            '|',
            'showBlocks',
            '|',
            'heading',
            '|',
            'fontSize',
            'fontFamily',
            'fontColor',
            'fontBackgroundColor',
            '|',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'subscript',
            'superscript',
            'code',
            '|',
            'horizontalLine',
            'link',
            'insertImageViaUrl',
            'mediaEmbed',
            'insertTable',
            'highlight',
            'blockQuote',
            'codeBlock',
            '|',
            'alignment',
            '|',
            'bulletedList',
            'numberedList',
            'todoList',
            'outdent',
            'indent'
        ],
        shouldNotGroupWhenFull: false
    },
    plugins: [
        Alignment,
        AutoImage,
        AutoLink,
        Autosave,
        BlockQuote,
        Bold,
        Code,
        CodeBlock,
        Essentials,
        FontBackgroundColor,
        FontColor,
        FontFamily,
        FontSize,
        GeneralHtmlSupport,
        Heading,
        Highlight,
        HorizontalLine,
        HtmlComment,
        ImageBlock,
        ImageCaption,
        ImageEditing,
        ImageInline,
        ImageInsertViaUrl,
        ImageStyle,
        ImageTextAlternative,
        ImageToolbar,
        ImageUpload,
        ImageUtils,
        Indent,
        IndentBlock,
        Italic,
        Link,
        LinkImage,
        List,
        Markdown,
        MediaEmbed,
        Paragraph,
        PasteFromMarkdownExperimental,
        PlainTableOutput,
        ShowBlocks,
        Strikethrough,
        Subscript,
        Superscript,
        Table,
        TableCaption,
        TableToolbar,
        TodoList,
        Underline
    ],
    fontFamily: {
        supportAllValues: true
    },
    fontSize: {
        options: [10, 12, 14, 'default', 18, 20, 22],
        supportAllValues: true
    },
    heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
        ]
    },
    htmlSupport: {
        allow: [
            {
                name: /.*/,
                styles: true,
                attributes: true,
                classes: true
            }
        ]
    },
    image: {
        toolbar: ['toggleImageCaption', 'imageTextAlternative', '|', 'imageStyle:inline', 'imageStyle:wrapText', 'imageStyle:breakText']
    },
    link: {
        addTargetToExternalLinks: true,
        defaultProtocol: 'https://',
        decorators: {
            toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                    download: 'file'
                }
            }
        }
    },
    menuBar: {
        isVisible: true
    },
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
    }
};

ClassicEditor.create(document.querySelector('#note-editor'), editorConfig)
    .catch(error => {
        console.error('CKEditor 5 initialization failed:', error);
    });
