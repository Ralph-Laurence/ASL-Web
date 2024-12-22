<script src="../revamp/static/lib/waitingfor/bootstrap-waitingfor.min.js"></script>
<script>
    // function showProgressLoader(message = "Hold on. This shouldn't take long...", title = "Loading") 
    // {
    //     waitingDialog.show(message,
    //     {
    //         headerText: title,
    //         headerSize: 4,
    //         dialogSize: 'sm',
    //         progressType: 'primary',
    //         onShow: () => {
                
    //             let modalBody = $('.progress.progress-striped.active').closest('.modal-body');
    //             let modalRoot = modalBody.closest('.modal');

    //             modalRoot.addClass('waitingFor-modal');
    //             modalBody.addClass('d-flex flex-column');
    //         }
    //     });
    // }

    // function hideProgressLoader(onHide = null)
    // {
    //     console.log('hideProgressLoader called');
    //     waitingDialog.hide();
    //     if (onHide !== null && typeof onHide === 'function')
    //     {
    //         console.log('Setting up hidden.bs.modal event');
    //         $('.waitingFor-modal').on('hidden.bs.modal', function()
    //         {
    //             console.log('hidden.bs.modal event triggered');
    //             $('.waitingFor-modal').off('hidden.bs.modal');
    //             onHide(); 
    //         });
    //     }
    // }

    function performPost(options)
    {
        let callbackType;
        let callbackData;

        waitingDialog.show(options.message || "Hold on, this shouldn't take long...",
        {
            headerText  : options.title || "Loading",
            headerSize  : 4,
            dialogSize  : 'sm',
            progressType: 'primary',
            onShow: function()
            {
                let modalBody = $('.progress.progress-striped.active').closest('.modal-body');
                let modalRoot = modalBody.closest('.modal');

                modalRoot.addClass('waitingFor-modal');
                modalBody.addClass('d-flex flex-column');

                $.ajax({
                    url     : options.url,
                    data    : options.postData,
                    type    : 'POST',
                    success : function(res)
                    {
                        callbackType = 'success';
                        callbackData = res;
                    },
                    error: function(xhr) 
                    {
                        callbackType = 'error';
                        callbackData = xhr;
                    },
                    error: function(xhr) {
                        
                        // Parse the response text to get the error message
                        let response = JSON.parse(xhr.responseText);
                        let errorMessage = response.message;

                        callbackType = 'error';
                        callbackData = errorMessage;
                    },
                    complete: function (jqXHR, textStatus)
                    {
                        setTimeout(() => waitingDialog.hide(), 1000);

                        setTimeout(() => {
                            if (options.onComplete && typeof options.onComplete === 'function')
                                options.onComplete(callbackType, callbackData);
                        }, options.closeDialogDelay || 1300);
                    }
                });
            }
        });
    }
</script>