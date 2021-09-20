CKEDITOR.addCss('.cke_editable { font-size: 15px; padding: 2em; }');

CKEDITOR.replace('profile', {
    toolbar: [{
            name: 'document',
            items: ['Print']
        },
        {
            name: 'clipboard',
            items: ['Undo', 'Redo']
        },
        {
            name: 'styles',
            items: ['Format', 'Font', 'FontSize']
        },
        {
            name: 'colors',
            items: ['TextColor', 'BGColor']
        },
        {
            name: 'align',
            items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
            '/',
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting']
        },
        {
            name: 'links',
            items: ['Link', 'Unlink']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'insert',
            items: ['Image', 'Table']
        },
        {
            name: 'tools',
            items: ['Maximize']
        },
        {
            name: 'editing',
            items: ['Scayt']
        }
    ],

    extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left,margin-top}',

    // Adding drag and drop image upload.
    extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
    uploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
    filebrowserBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html',
    filebrowserImageBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html?type=Images',
    filebrowserUploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Images',

    height: 400,

    removeDialogTabs: 'image:advanced;link:advanced',
    removeButtons: 'PasteFromWord'
});

CKEDITOR.replace('delivery', {
    toolbar: [{
            name: 'document',
            items: ['Print']
        },
        {
            name: 'clipboard',
            items: ['Undo', 'Redo']
        },
        {
            name: 'styles',
            items: ['Format', 'Font', 'FontSize']
        },
        {
            name: 'colors',
            items: ['TextColor', 'BGColor']
        },
        {
            name: 'align',
            items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
            '/',
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting']
        },
        {
            name: 'links',
            items: ['Link', 'Unlink']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'insert',
            items: ['Image', 'Table']
        },
        {
            name: 'tools',
            items: ['Maximize']
        },
        {
            name: 'editing',
            items: ['Scayt']
        }
    ],

    extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left,margin-top}',

    // Adding drag and drop image upload.
    extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
    uploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
    filebrowserBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html',
    filebrowserImageBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html?type=Images',
    filebrowserUploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Images',

    height: 400,

    removeDialogTabs: 'image:advanced;link:advanced',
    removeButtons: 'PasteFromWord'
});

CKEDITOR.replace('faq', {
    toolbar: [{
            name: 'document',
            items: ['Print']
        },
        {
            name: 'clipboard',
            items: ['Undo', 'Redo']
        },
        {
            name: 'styles',
            items: ['Format', 'Font', 'FontSize']
        },
        {
            name: 'colors',
            items: ['TextColor', 'BGColor']
        },
        {
            name: 'align',
            items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
            '/',
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting']
        },
        {
            name: 'links',
            items: ['Link', 'Unlink']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'insert',
            items: ['Image', 'Table']
        },
        {
            name: 'tools',
            items: ['Maximize']
        },
        {
            name: 'editing',
            items: ['Scayt']
        }
    ],

    extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left,margin-top}',

    // Adding drag and drop image upload.
    extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
    uploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
    filebrowserBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html',
    filebrowserImageBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html?type=Images',
    filebrowserUploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Images',

    height: 400,

    removeDialogTabs: 'image:advanced;link:advanced',
    removeButtons: 'PasteFromWord'
});


// Create article Ajax request.
$('#SubmitForm').click(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        url: "http://127.0.0.1:8000/company/store",
        method: 'post',
        data: { 
            id: $('#id').val(),
            name: $('#name').val(),
            email: $('#email').val(), 
            phone: $('#phone').val(), 
            tax: $('#tax').val(), 
            tax_vat: $('#tax_vat').val(), 
            tax_country: $('#tax_country').val(), 
            zip: $('#zip').val(), 
            city: $('#city').val(), 
            street: $('#street').val(), 
            house_number: $('#house_number').val(),
        },
        success: function(data) { 
            if ((data.errors)) {
                toastr.error(data.errors, 'Hiba', {timeOut: 3000});
                $.each(data.errors, function (i, error) {
                    var el = $(document).find('[name="'+i+'"]');
                    el.after($('<span id="errorSpan" style="color: red;">'+error[0]+'</span>'));
                    setTimeout( function() {
                        $('#errorSpan').hide();
                    }, 2000);
                });
            } else {
                toastr.success( data.success, 'Siker', {timeOut: 3000});
            }
        }
    });
});