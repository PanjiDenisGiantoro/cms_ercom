import tinymce from 'tinymce/tinymce';
import 'tinymce/models/dom/model';
import 'tinymce/themes/silver';
import 'tinymce/icons/default';
import 'tinymce/skins/ui/oxide/skin.css';

import 'tinymce/plugins/advlist';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/code';
import 'tinymce/plugins/codesample';
import 'tinymce/plugins/directionality';
import 'tinymce/plugins/emoticons';
import 'tinymce/plugins/emoticons/js/emojis';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/help';
import 'tinymce/plugins/image';
import 'tinymce/plugins/insertdatetime';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/media';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/table';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/visualchars';
import 'tinymce/plugins/wordcount';

import contentCss from 'tinymce/skins/content/default/content.css?url';
import contentUiCss from 'tinymce/skins/ui/oxide/content.css?url';

const FULL_PLUGINS = [
    'advlist', 'anchor', 'autolink', 'charmap', 'code', 'codesample',
    'directionality', 'emoticons', 'fullscreen', 'help', 'image',
    'insertdatetime', 'link', 'lists', 'media', 'preview', 'searchreplace',
    'table', 'visualblocks', 'visualchars', 'wordcount',
];

const FULL_TOOLBAR = 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor | '
    + 'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | '
    + 'link image media table charmap emoticons | removeformat code codesample | fullscreen preview | help';

const MINIMAL_PLUGINS = ['autolink', 'link', 'lists'];
const MINIMAL_TOOLBAR = 'bold italic underline | bullist numlist | link | removeformat | undo redo';

function initTinyEditors() {
    document.querySelectorAll('textarea.ckeditor, textarea.ckeditor-minimal').forEach(function (el) {
        if (el.dataset.tinymceInitialized) {
            return;
        }
        el.dataset.tinymceInitialized = 'true';

        const isMinimal = el.classList.contains('ckeditor-minimal');

        tinymce.init({
            target: el,
            license_key: 'gpl',
            skin: false,
            content_css: [contentUiCss, contentCss],
            menubar: isMinimal ? false : 'edit insert view format table tools',
            plugins: isMinimal ? MINIMAL_PLUGINS : FULL_PLUGINS,
            toolbar: isMinimal ? MINIMAL_TOOLBAR : FULL_TOOLBAR,
            height: isMinimal ? 200 : 420,
            branding: false,
            promotion: false,
        });
    });
}

window.initTinyEditors = initTinyEditors;

document.addEventListener('DOMContentLoaded', initTinyEditors);
