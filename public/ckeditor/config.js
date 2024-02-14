/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
var fullUrl = window.location.href;
var baseUrl = fullUrl.split("/").slice(0, 3).join("/");
CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.height = 500;
    config.filebrowserBrowseUrl = baseUrl + "/ckfinder/ckfinder.html";
    config.filebrowserImageBrowseUrl =
        baseUrl + "/ckfinder/ckfinder.html?type=Images";
    config.filebrowserUploadUrl =
        baseUrl +
        "/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files";
    config.filebrowserImageUploadUrl =
        baseUrl +
        "/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";
};
