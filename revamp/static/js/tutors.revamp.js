$(document).ready(function() 
{
    const endPoint_EndContract = '../revamp/http/end_contract.php';
    const endPoint_HireTutor = '../revamp/http/hire_tutor.php';

    function showFailure(msg, title)
    {
        $("#alertMessageModalLabel").html(title || "Error");
        $("#alertMessageModalMessage").html(msg);
        $("#alertMessageModal").modal("show");
    }

    function handleViewTutorProfile(e)
    {
        let datastring = $(e.currentTarget).data("data");
        let data       = JSON.parse(decodeURIComponent(datastring));
        let hireStatus = $(e.currentTarget).attr("data-hire-status");

        if (!data)
        {
            showFailure("Something went wrong while viewing the tutor's profile.", "Hire Tutor");
            return;
        }
        $('#tutor_id').val(data.id);

        $("#viewMdName").html(`${data.firstname} ${data.lastname}`);
        $("#viewMdAgeGender").html(`${data.age} - ${data.gender}`);
        $("#viewMdAddress").html(`${data.address}`);
        $("#viewMdContactEmail").html(`${data.contact} - ${data.email}`);

        $("#viewMdProfilePhoto").attr("src", data.profile_photo);
        alert(hireStatus)
        if (hireStatus !== undefined && hireStatus === "hired")
        {
            $(".btn-wrapper-end-tutor-contract").removeClass("d-none");
            $(".btn-wrapper-hire-tutor").addClass("d-none");
        }
        else
        {
            $(".btn-wrapper-end-tutor-contract").addClass("d-none");
            $(".btn-wrapper-hire-tutor").removeClass("d-none");
        }
    }

    function handleHireTutor(e)
    {
        let tutorId    = $('#tutor_id').val();
        let learnerId  = $('#learner_id').val();
        let modalTitle = "Hire Tutor";

        if (!tutorId || !learnerId)
        {
            showFailure("Something went wrong while processing the request.", modalTitle);
            return;
        }

        $("#viewModal").modal('hide');
        $("#viewModal").on('hidden.bs.modal', () => {

            $("#viewModal").off('hidden.bs.modal');

            performPost({
                url: endPoint_HireTutor,
                postData: {
                    'learner_id' : learnerId,
                    'tutor_id'   : tutorId
                },
                onComplete: function(callbackType, callbackData)
                {
                    switch (callbackType)
                    {
                        case 'success':
                            if (callbackData && callbackData.status == 200)
                            {
                                $("#alertMessageModalLabel").html("Success");
                                $("#alertMessageModalMessage").html(callbackData.message);
                                $("#alertMessageModal").modal("show");

                                // Mark the tutor as hired
                                let tutorBtnViewProfile = $(`#btn-tutor-info-${tutorId}`);
                                
                                tutorBtnViewProfile.attr('data-hire-status', 'hired');
                                tutorBtnViewProfile.closest('.card-body').find('.hire-badge-container > .badge').show();
                            }
                            break;
    
                        case 'error':
                            let errMsg = callbackData || "Something went wrong while processing the request.";
                            showFailure(errMsg);
                            break;
                    }
                }
            })
        });
    }

    function handleTutorEndContract(e)
    {
        let tutorId    = $('#tutor_id').val();
        let learnerId  = $('#learner_id').val();
        let modalTitle = "End Tutor Contract";

        if (!tutorId || !learnerId)
        {
            showFailure("Something went wrong while processing the request.", modalTitle);
            return;
        }

        $("#viewModal").modal('hide');
        $("#viewModal").on('hidden.bs.modal', () => {

            $("#viewModal").off('hidden.bs.modal');

            performPost({
                url: endPoint_EndContract,
                postData: {
                    'learner_id' : learnerId,
                    'tutor_id'   : tutorId
                },
                onComplete: function(callbackType, callbackData)
                {
                    console.log(callbackType)
                    switch (callbackType)
                    {
                        case 'success':
                            if (callbackData && callbackData.status == 200)
                            {
                                $("#alertMessageModalLabel").html("Success");
                                $("#alertMessageModalMessage").html(callbackData.message);
                                $("#alertMessageModal").modal("show");

                                // Mark the tutor as open for hire
                                let tutorBtnViewProfile = $(`#btn-tutor-info-${tutorId}`);
                                
                                tutorBtnViewProfile.attr('data-hire-status', '');
                                tutorBtnViewProfile.closest('.card-body').find('.hire-badge-container > .badge').hide();
                            }
                            break;
    
                        case 'error':
                            let errMsg = callbackData || "Something went wrong while processing the request.";
                            showFailure(errMsg);
                            break;
                    }
                }
            })
        });
    }

    $(".viewMdBtn").on("click", (e) => handleViewTutorProfile(e));

    $('.btn-end-tutor-contract').on('click', (e) => handleTutorEndContract(e));    
    $('.btn-hire-tutor').on('click', (e) => handleHireTutor(e));
});
