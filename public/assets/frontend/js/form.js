// Contact Pages
// console.log(document.URL);
// const ROOT_PATH = "http://localhost/codingcad/imperial-collage-web"
// const ROOT_PATH = "http://localhost/imperial-collage-web"
const ROOT_PATH = "https://icbsgroup.lk/"
// Email validator
function isValidEmailAddress(email) {

    let pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

    // Contact, Apply now
    return pattern.test(email);

}

// Email validator NewsLetter
function isValidNewsLetterEmailAddress(email) {

    let pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

    // NewsLetter
    return pattern.test(email);

}

// Contact validator
function validatePhone(phone) {

    let filter = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

    return filter.test(phone);

}

$('#application_form01').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#campus").val();
    let name = $("#stuName").val().trim();
    let email = $("#stuEmail").val().trim();
    let phone = $("#stuContact").val().trim();
    let course = $("#programs").val();
    let city = $("#stuCity").val().trim();

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        course: course,
        stu_city: city
    };

    if (campus !== "" && name !== "" && email !== "" && phone !== "" && course !== "" && city !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/form01',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {

                $("#waitingModal").modal('hide');
                $('#application_form01').removeClass('was-validated')

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }

                $("#formType").val();
                $("#campus").val("");
                $("#stuName").val("");
                $("#stuEmail").val("");
                $("#stuContact").val("");
                $("#programs").val("");
                $("#stuCity").val("");

            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#application_form02').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#campus").val();
    let name = $("#stuName").val().trim();
    let email = $("#stuEmail").val().trim();
    let phone = $("#stuContact").val().trim();
    let course = $("#programs").val();
    let city = $("#stuCity").val();

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        course: course,
        stu_city: city
    };

    if (campus !== "" && name !== "" && email !== "" && phone !== "" && course !== "" && city !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/form02',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {
                $("#waitingModal").modal('hide');
                $('#application_form02').removeClass('was-validated')
                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }
                $("#formType").val();
                $("#campus").val("");
                $("#stuName").val("");
                $("#stuEmail").val("");
                $("#stuContact").val("");
                $("#programs").val("");
                $("#stuCity").val("");

            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#application_form03').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#campus").val();
    let name = $("#stuName").val().trim();
    let email = $("#stuEmail").val().trim();
    let phone = $("#stuContact").val().trim();
    let course = $("#programs").val();
    let city = $("#stuCity").val();

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        course: course,
        stu_city: city
    };

    if (campus !== "" && name !== "" && email !== "" && phone !== "" && course !== "" && city !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/form03',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {
                $("#waitingModal").modal('hide');
                $('#application_form03').removeClass('was-validated')
                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }
                $("#formType").val();
                $("#campus").val("");
                $("#stuName").val("");
                $("#stuEmail").val("");
                $("#stuContact").val("");
                $("#programs").val("");
                $("#stuCity").val("");
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#application_form04').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#campus").val();
    let name = $("#stuName").val().trim();
    let email = $("#stuEmail").val().trim();
    let phone = $("#stuContact").val().trim();
    let course = $("#programs").val();
    let city = $("#stuCity").val();

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        course: course,
        stu_city: city
    };

    if (campus !== "" && name !== "" && email !== "" && phone !== "" && course !== "" && city !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/form04',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {
                $("#waitingModal").modal('hide');
                $('#application_form04').removeClass('was-validated')

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }
                $("#formType").val();
                $("#campus").val("");
                $("#stuName").val("");
                $("#stuEmail").val("");
                $("#stuContact").val("");
                $("#programs").val("");
                $("#stuCity").val("");

            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#application_form05').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#campus").val();
    let name = $("#stuName").val().trim();
    let email = $("#stuEmail").val().trim();
    let phone = $("#stuContact").val().trim();
    let course = $("#programs").val();
    let city = $("#stuCity").val();

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        course: course,
        stu_city: city
    };

    if (campus !== "" && name !== "" && email !== "" && phone !== "" && course !== "" && city !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/form05',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {

                $("#waitingModal").modal('hide');
                $('#application_form05').removeClass('was-validated')

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }
                $("#formType").val();
                $("#campus").val("");
                $("#stuName").val("");
                $("#stuEmail").val("");
                $("#stuContact").val("");
                $("#programs").val("");
                $("#stuCity").val("");

            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#application_form06').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#campus").val();
    let name = $("#stuName").val().trim();
    let email = $("#stuEmail").val().trim();
    let phone = $("#stuContact").val().trim();
    let course = $("#programs").val();
    let city = $("#stuCity").val().replace(/^(\[url=)?(https?:\/\/)?(www\.|\S+?\.)(\S+?\.)?\S+$\s*/mg, '');

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        course: course,
        stu_city: city
    };

    if (campus !== "" && name !== "" && email !== "" && phone !== "" && course !== "" && city !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/form06',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {
                $("#waitingModal").modal('hide');
                $('#application_form06').removeClass('was-validated');

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }
                $("#formType").val();
                $("#campus").val("");
                $("#stuName").val("");
                $("#stuEmail").val("");
                $("#stuContact").val("");
                $("#programs").val("");
                $("#stuCity").val("");

            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#application_form07').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#campus").val();
    let name = $("#stuName").val().trim();
    let email = $("#stuEmail").val().trim();
    let phone = $("#stuContact").val().trim();
    let course = $("#programme").val();
    let education = $("#education").val();
    let country = $("#country").val();
    let studyYear = $("#studyYear").val();
    let intake = $("#intake").val();
    let modeConsult = $("#modeConsult").val();

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        course: course,
        stu_education: education,
        country: country,
        studyYear: studyYear,
        intake: intake,
        modeConsult: modeConsult,
    };

    if (campus !== "" && name !== "" && email !== "" && phone !== "" && course !== "" && education !== "" && country !== "" && studyYear !== "" && intake !== "" && modeConsult !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/form07',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {
                $("#waitingModal").modal('hide');
                $('#application_form07').removeClass('was-validated');

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }
                $("#formType").val();
                $("#campus").val("");
                $("#stuName").val("");
                $("#stuEmail").val("");
                $("#stuContact").val("");
                $("#programs").val("");
                $("#stuCity").val("");

            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#application_form08').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#campus").val();
    let name = $("#stuName").val().trim();
    let email = $("#stuEmail").val().trim();
    let phone = $("#stuContact").val().trim();
    let course = $("#programs").val();
    let city = $("#stuCity").val().replace(/^(\[url=)?(https?:\/\/)?(www\.|\S+?\.)(\S+?\.)?\S+$\s*/mg, '');

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        course: course,
        stu_city: city
    };

    if (campus !== "" && name !== "" && email !== "" && phone !== "" && course !== "" && city !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/form08',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {
                $("#waitingModal").modal('hide');
                $('#application_form08').removeClass('was-validated')

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }

                $("#campus").val("");
                $("#stuName").val("");
                $("#stuEmail").val("");
                $("#stuContact").val("");
                $("#programs").val("");
                $("#stuCity").val("");
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#newsletter').on("submit", function (e) {
    e.preventDefault()
    $("#campusModal").modal('show');
})
$('#campusName').on("submit", function (e) {
    e.preventDefault()
    let email = $("#emailNews").val().trim();
    let campusLatter = $("#campusLatter").val().trim();
    let programme = $("#programme").val().trim();
    let contact = $("#contact").val().trim();

    let objContact = {
        stu_campus: campusLatter,
        stu_email: email,
        stu_programme: programme,
        stu_contact: contact
    };

    if (email !== "" && isValidNewsLetterEmailAddress(email) && campusLatter !== "" && programme !== "" && contact !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/newsLetter',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $('#campusModal').modal('hide');
                // $('#waitingModal').modal('show');
            },
            success: function (data) {
                $("#waitingModal").modal('hide');
                $('#campusName').removeClass('was-validated')

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Email has been sent successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }

                $("#emailNews").val("");
                $("#campusLatter").val("");
                $("#programme").val("");
                $("#contact").val("");
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("Fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#brochure').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#stuBrochureCampusName").val();
    let name = $("#stuBrochureName").val().trim();
    let email = $("#stuBrochureEmail").val().trim();
    let phone = $("#stuBrochureContact").val().trim();
    let city = $("#stuBrochureCity").val().trim();
    let brochures_type = $("#brochures_type").val();

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        stu_city: city
    };
    if (campus !== "" && name !== "" && email !== "" && phone !== "" && city !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/brochure',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                const link = document.createElement('a')
                // others
                if (brochures_type == 1) {
                    link.setAttribute('href', 'http://bit.ly/3IGnHKk')
                    link.setAttribute('target', '_blank')
                }
                // goble
                if (brochures_type == 2) {
                    link.setAttribute('href', 'https://bit.ly/44YzoEN')
                    link.setAttribute('target', '_blank')
                }
                // Business and Finance
                if (brochures_type == 3) {
                    link.setAttribute('download', 'Degree-ICBS-Brochure.pdf')
                    link.setAttribute('href', ROOT_PATH + '/assets/brochure/Degree-ICBS-Brochure.pdf')
                }
                // CIMA
                if (brochures_type == 4) {
                    link.setAttribute('href', 'https://bit.ly/43VLqhA')
                    link.setAttribute('target', '_blank')
                }
                // b found
                if (brochures_type == 5) {
                    link.setAttribute('href', 'https://bit.ly/42CcAca')
                    link.setAttribute('target', '_blank')
                }
                // hnd
                if (brochures_type == 6) {
                    link.setAttribute('href', 'https://bit.ly/462cFbR')
                    link.setAttribute('target', '_blank')
                }
                // MBA UWS
                if (brochures_type == 7) {
                    link.setAttribute('href', 'https://bit.ly/3MjZb3k')
                    link.setAttribute('target', '_blank')
                }
                
                if (brochures_type == 8) {
                    link.setAttribute('href', 'https://bit.ly/3QSvbOS')
                    link.setAttribute('target', '_blank')
                }

                link.click()
                $("#downloadBrochureModal").modal('hide');
                $("#waitingModal").modal('show');

            },
            success: function (data) {
                $('#brochure').removeClass('was-validated')
                $("#waitingModal").modal('hide');

                if (JSON.stringify(data) == 1) {
                    $("#waitingModal").modal('hide');
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#waitingModal").modal('hide');
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }
              
                $("#stuBrochureCampusName").val();
                $("#stuBrochureName").val().trim();
                $("#stuBrochureEmail").val().trim();
                $("#stuBrochureContact").val().trim();
                $("#stuBrochureCity").val().trim();
                $("#brochures_type").val();

            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#contact_form').on("submit", function (e) {
    e.preventDefault();

    let campus = $("#con_campus").val();
    let name = $("#con_name").val().trim();
    let email = $("#con_email").val().trim();
    let phone = $("#con_phone").val().trim();
    let course = $("#con_course").val();
    let city = $("#con_message").val().replace(/^(\[url=)?(https?:\/\/)?(www\.|\S+?\.)(\S+?\.)?\S+$\s*/mg, '');

    let objContact = {
        stu_campus: campus,
        stu_name: name,
        stu_email: email,
        stu_phone: phone,
        course: course,
        stu_city: city
    };

    if (campus !== "" && name !== "" && email !== "" && phone !== "" && course !== "" && city !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/contactForm',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {
                $("#waitingModal").modal('hide');
                $('#contact_form').removeClass('was-validated')

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }

                $("#con_campus").val("");
                $("#con_name").val("");
                $("#con_email").val("");
                $("#con_phone").val("");
                $("#con_course").val("");
                $("#con_message").val("");
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})
$('#comment_form').on("submit", function (e) {
    e.preventDefault();

    let name = $("#com_name").val().trim();
    let email = $("#com_email").val().trim();
    let postId = $("#postId").val().trim();
    let postName = $("#postName").val().trim();
    let comment = $("#comment").val().replace(/^(\[url=)?(https?:\/\/)?(www\.|\S+?\.)(\S+?\.)?\S+$\s*/mg, '');

    let objContact = {
        stu_name: name,
        stu_email: email,
        stu_comment: comment,
        postId: postId,
        postName: postName
    };

    if (name !== "" && email !== "" && comment !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/BlogController/addComment',
            data: {data: JSON.stringify(objContact)},
            dataType: 'json',
            success: function (data) {
                $("#successMsg").html("Your Comment Added Successfully. <br> Thank You! ");
                $("#successModal").modal('show');
                $("#comment").val("");
                $("#com_name").val("");
                $("#com_email").val("");
                $('#comment_form').removeClass('was-validated')
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})

$('#alumni_form').on("submit", function (e) {
    e.preventDefault();

    let branch = $("#branch").val();
    let fname = $("#firstName").val().trim();
    let surname = $("#surname").val().trim();
    let email = $("#stuAlumniEmail").val().trim();
    let id = $("#stuId").val().trim();
    let prevCourse = $("#stuPrevCourse").val().trim();
    let mobile = $("#mobile").val().trim();
    let comment = $("#stuComment").val().replace(/^(\[url=)?(https?:\/\/)?(www\.|\S+?\.)(\S+?\.)?\S+$\s*/mg, '');

    let objAlumni = {
        stu_branch: branch,
        stu_fname: fname,
        stu_surname: surname,
        stu_email: email,
        stu_id: id,
        stu_prev_course: prevCourse,
        stu_mobile: mobile,
        stu_comment: comment
    };

    if (branch !== "" && fname !== "" && surname !== "" && email !== "" && mobile !== "" && id !== "" && prevCourse !== "" && comment !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/alumniForm',
            data: { data: JSON.stringify(objAlumni) },
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {
                $("#alumni").modal('hide')
                $("#waitingModal").modal('hide');
                $('#alumni_form').removeClass('was-validated')

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }

                $("#branch").val("");
                $("#firstName").val("");
                $("#surname").val("");
                $("#stuAlumniEmail").val("");
                $("#stuId").val("");
                $("#stuPrevCourse").val("");
                $("#mobile").val("");
                $("#stuComment").val("");
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})

$('#stu_request_form').on("submit", function (e) {
    e.preventDefault();

    let branch = $("#branch").val();
    let request = $("#stuReq").val().replace(/^(\[url=)?(https?:\/\/)?(www\.|\S+?\.)(\S+?\.)?\S+$\s*/mg, '');
    let fname = $("#firstName").val().trim();
    let surname = $("#surname").val().trim();
    let email = $("#stu_request_email").val().trim();
    let id = $("#stu_request_id").val().trim();
    let mobile = $("#mobile").val().trim();
    let comment = $("#stuComment").val().replace(/^(\[url=)?(https?:\/\/)?(www\.|\S+?\.)(\S+?\.)?\S+$\s*/mg, '');

    let objStuReq = {
        stu_branch: branch,
        stu_req: request,
        stu_fname: fname,
        stu_surname: surname,
        stu_email: email,
        stu_id: id,
        stu_mobile: mobile,
        stu_comment: comment
    };

    if (branch !== "" && request !== "" && fname !== "" && surname !== "" && email !== "" && mobile !== "" && id !== "" && comment !== "") {
        $.ajax({
            type: 'post',
            url: ROOT_PATH + '/controllers/ApplicationForms/stuRequestForm',
            data: { data: JSON.stringify(objStuReq) },
            dataType: 'json',
            beforeSend: function () {
                $("#waitingModal").modal('show');
            },
            success: function (data) {
                $("#stuRequest").modal('hide')
                $("#waitingModal").modal('hide');
                $('#contact_form').removeClass('was-validated')

                if (JSON.stringify(data) == 1) {
                    $("#successMsg").html("Your Information saved successfully. <br> Thank You! ");
                    $("#successModal").modal('show');
                } else {
                    $("#errorMsg").html("Email has not been sent successfully!");
                    $("#errorModal").modal('show');
                }

                $("#stu_branch").val("");
                $("#stu_req").val("");
                $("#stu_fname").val("");
                $("#stu_surname").val("");
                $("#stu_email").val("");
                $("#stu_id").val("");
                $("#stu_mobile").val("");
                $("#stu_comment").val("");
            },
            error: function (error) {
                console.log(JSON.stringify(error));
            },
        });
    } else {
        $("#warningMsg").html("All fields Required!");
        $("#warningModal").modal('show');
    }
})


const brochureType = (x) => {
    $('#brochures_type').val(x);
}

function addLike(postId) {
    let url = ROOT_PATH + "/controllers/BlogController/like"
    $.post(url, {postId: postId}, function (data) {
        if (data[0] == 1) {
            $("#like").addClass("btn-disabled").attr("disabled", true);
            $("#dislike").removeClass("btn-disabled").attr("disabled", false);
        }
        if (data[0] == 2) {
            $("#like").addClass("btn-disabled").attr("disabled", true);
        }
        if (data[0] == 3) {
            $("#like").removeClass("btn-disabled").attr("disabled", false);
        }
        $("#likeCount").html(data[1]).show();
        $("#dislikeCount").html(data[2]).show();
    }, "json");
}

function addDislike(postId) {
    let url = ROOT_PATH + "/controllers/BlogController/dislike"
    $.post(url, {postId: postId}, function (data) {
        if (data[0] == 1) {
            $("#like").removeClass("btn-disabled").attr("disabled", false);
            $("#dislike").addClass("btn-disabled").attr("disabled", true);
        }
        if (data[0] == 2) {
            $("#dislike").addClass("btn-disabled").attr("disabled", true);
        }
        if (data[0] == 3) {
            $("#dislike").removeClass("btn-disabled").attr("disabled", false);
        }
        $("#likeCount").html(data[1]).show();
        $("#dislikeCount").html(data[2]).show();
    }, "json");
}

$("#toggle").click(function () {
    $(this).toggleClass("active");
    $("#overlay").toggleClass("open");
});


