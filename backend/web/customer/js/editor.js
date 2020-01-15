let content = $('#content');
let describe = $('#describe');
let content_image = $('#content-image');
if (content.length !== 0) {
    initSample();
}

if (describe.length !== 0) {
    initDescribe();
}
if (content_image.length !== 0) {
    initContentImage();
}