import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize,
    FilePondPluginImageExifOrientation
);

window.FilePond = FilePond;
window.filePondInstances = {};

function csrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : '';
}

function initFilePondInputs() {
    document.querySelectorAll('input[type="file"][data-filepond]').forEach((input) => {
        if (input.dataset.filepondReady) return;
        input.dataset.filepondReady = '1';

        const isVideo = (input.getAttribute('accept') || '').includes('video');
        const fieldName = input.getAttribute('name');

        const pond = FilePond.create(input, {
            allowMultiple: input.hasAttribute('multiple'),
            maxFiles: input.hasAttribute('multiple') ? null : 1,
            allowImagePreview: !isVideo,
            labelIdle: 'Seret &amp; lepas file di sini atau <span class="filepond--label-action">Pilih File</span>',
            labelMaxFileSizeExceeded: 'File terlalu besar',
            labelFileTypeNotAllowed: 'Tipe file tidak didukung',
            credits: false,
            server: {
                process: {
                    url: '/admin/filepond/process',
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken() },
                },
                revert: {
                    url: '/admin/filepond/revert',
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken() },
                },
                load: (source, load, error, progress, abort) => {
                    // Only fetch genuine absolute URLs (existing files preloaded
                    // via data-current-file). A bare server id returned by our
                    // own /process endpoint (e.g. "tmp-uploads/xxx.png") is not
                    // fetchable as a URL and must never reach this path.
                    const isFetchableUrl = typeof source === 'string' && /^(https?:)?\//.test(source);

                    if (!isFetchableUrl) {
                        error('not a loadable url');
                        return;
                    }

                    fetch(source)
                        .then((res) => res.blob())
                        .then(load)
                        .catch(error);
                    return { abort: () => abort() };
                },
            },
        });

        if (fieldName) {
            window.filePondInstances[fieldName] = pond;
        }

        const currentFile = input.dataset.currentFile;
        if (currentFile) {
            let urls = [currentFile];
            if (currentFile.trim().startsWith('[')) {
                try { urls = JSON.parse(currentFile); } catch (e) { urls = [currentFile]; }
            }
            urls.forEach((url) => pond.addFile(url, { type: 'local' }).catch(() => {}));
        }
    });
}

document.addEventListener('DOMContentLoaded', initFilePondInputs);
