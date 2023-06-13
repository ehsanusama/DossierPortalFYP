
function doSomething(e) {
    let type = document.getElementById("type");
    if (type.value == "notification") {
        document.getElementById("contactDropDown").style.display = "none";
    }
    else {
        document.getElementById("contactDropDown").style.display = "";
    }
}
$(document).ready(function () {
    /* Show Contact on page refresh */
    var action = "getAllContact";
    $.ajax({
        type: "POST",
        url: "inc/smsModule.php",
        data: {
            action: action
        },
        dataType: "text",
        success: function (response) {
            $("#contactData").html(response);
        }
    });
    /* Add New Contact */
    $("#addContact_form").submit(function (e) {
        e.preventDefault();
        const form = $(this);
        $.ajax({
            type: "POST",
            url: "inc/smsModule.php",
            data: form.serialize(),
            dataType: "text",
            success: function (response) {
                var result = $.parseJSON(response);
                if (result[0] === "success") {
                    if ($("#actionCxt").val() === "addContact") {
                        swal(
                            'Contact Added',
                            'A new contact has been added',
                            'success'
                        )
                    } else {
                        swal(
                            'Contact Updated',
                            'Your contact has been updated',
                            'success'
                        )
                    }
                    $("#contactData").html(result[1]);
                    $("#actionCxt").val("addContact");
                    $("#addContact_form")[0].reset();
                } else {
                    console.log(result[2]);
                    alert(result[0]);
                    $("#contactData").html(result[1]);
                }
            }
        });
    });
    /* Delete Contact Message */
    $(document).on('click', '#delCxt', function () {
        var contactID = $(this).val();
        var action = "delContact";
        // inputOptions can be an object or Promise
        var inputOptions = new Promise(function (resolve) {
            setTimeout(function () {
                resolve({
                    'yes': 'yes',
                    'no': 'no',
                })
            }, 1000)
        })
        swal({
            title: 'Do you really want to delete this Contact ?',
            input: 'radio',
            inputOptions: inputOptions,
            inputValidator: function (msg) {
                console.log(msg);
                if (msg === "yes") {
                    $.ajax({
                        type: "POST",
                        url: "inc/smsModule.php",
                        data: {
                            contactID: contactID,
                            action: action
                        },
                        dataType: "text",
                        success: function (response) {
                            var result = $.parseJSON(response);
                            if (result[0] == "success") {

                                $("#contactData").html(result[1]);
                            } else if (result[0] == "error") {
                                alert(result[0]);
                            }
                        }
                    });
                }
            }
        });
    });

    /* Change Contact Sts */
    $(document).on('click', '#changeSts', function () {
        var contactID = $(this).val();
        var sts = $(this).text();
        var action = "changeSts";
        // inputOptions can be an object or Promise
        var inputOptions = new Promise(function (resolve) {
            setTimeout(function () {
                resolve({
                    'yes': "Yes",
                    'no': 'No',
                })
            }, 1000)
        })
        swal({
            title: 'Do you really want to change contact Status?',
            input: 'radio',
            inputOptions: inputOptions,
            inputValidator: function (msg) {
                console.log(msg);
                if (msg === "yes") {
                    $.ajax({
                        type: "POST",
                        url: "inc/smsModule.php",
                        data: {
                            contactID: contactID,
                            sts: sts,
                            action: action
                        },
                        dataType: "text",
                        success: function (response) {
                            var result = $.parseJSON(response);
                            if (result[0] == "success") {
                                $("#contactData").html(result[1]);
                            } else if (result[0] == "error") {
                                alert(result[0]);
                            }
                        }
                    });
                }
            }
        });
    });
    /* Change Contact Sts */
    $(document).on('click', '#editCxt', function () {
        var contactID = $(this).val();
        var action = "editCxt";
        var inputOptions = new Promise(function (resolve) {
            setTimeout(function () {
                resolve({
                    'yes': "Yes",
                    'no': "No",
                })
            }, 1000)
        })
        swal({
            title: 'Do you really want to change contact Status?',
            input: 'radio',
            inputOptions: inputOptions,
            inputValidator: function (msg) {
                console.log(msg);
                if (msg === "yes") {
                    $.ajax({
                        type: "POST",
                        url: "inc/smsModule.php",
                        data: {
                            contactID: contactID,
                            action: action
                        },
                        dataType: "text",
                        success: function (response) {
                            var result = $.parseJSON(response);
                            if (result[0] === "success") {
                                console.log(result[1].FirstName);
                                $("#first_name").val(result[1].FirstName);
                                $("#last_name").val(result[1].LastName);
                                $("#email").val(result[1].email);
                                $("#phone").val(result[1].phone);
                                $("#actionCxt").val("updateCxt");
                                $("#cxtID").val(result[1].id);
                                $(window).scrollTop(100);
                            }
                        }
                    });
                }
            }
        });
    });




    var action = "getAllGroups";
    $.ajax({
        type: "POST",
        url: "inc/smsModule.php",
        data: {
            action: action
        },
        dataType: "text",
        success: function (response) {
            $("#groupData").html(response);
        }
    });


    /* Add New Group */
    $("#addGroup_form").submit(function (e) {
        e.preventDefault();
        const form = $(this);
        $.ajax({
            type: "POST",
            url: "inc/smsModule.php",
            data: form.serialize(),
            dataType: "text",
            success: function (response) {
                // console.log(response);
                var result = $.parseJSON(response);
                if (result[1] === "success") {
                    if ($("#actionGrp").val() === "addGroup") {
                        swal(
                            'Group Added',
                            result[0],
                            'success'
                        )
                    } else {
                        swal(
                            'Contact Updated',
                            result[0],
                            'success'
                        )
                    }
                    $("#groupData").html(result[2]);
                    $("#group_name").val("");
                    $("#actionGrp").val("addGroup");
                    $("#addGroup").text("Add Group");
                } else {
                    alert(result[0]);
                    $("#groupData").html(result[2]);
                }
            }
        });
    });


    /* Delete Group  */
    $(document).on('click', '#delGrp', function () {
        var id = $(this).val();
        var action = "delGroup";
        // inputOptions can be an object or Promise
        var inputOptions = new Promise(function (resolve) {
            setTimeout(function () {
                resolve({
                    'yes': 'yes',
                    'no': 'no',
                })
            }, 1000)
        })
        swal({
            title: 'Do you really want to delete this Group ?',
            input: 'radio',
            inputOptions: inputOptions,
            inputValidator: function (msg) {
                console.log(msg);
                if (msg === "yes") {
                    $.ajax({
                        type: "POST",
                        url: "inc/smsModule.php",
                        data: {
                            id: id,
                            action: action
                        },
                        dataType: "text",
                        success: function (response) {
                            var result = $.parseJSON(response);
                            if (result[1] == "success") {
                                // alert(result[0]);
                                console.log(response);
                                $("#groupData").html(result[2]);
                            } else if (result[1] == "error") {
                                // alert(result[0]);

                            }
                        }
                    });
                }
            }
        });
    });


    /* Change Contact Sts */
    $(document).on('click', '#changeGrpSts', function () {
        var id = $(this).val();
        var sts = $(this).text();
        var action = "changeGrpSts";
        // inputOptions can be an object or Promise
        var inputOptions = new Promise(function (resolve) {
            setTimeout(function () {
                resolve({
                    'yes': "Yes",
                    'no': 'No',
                })
            }, 1000)
        })
        swal({
            title: 'Do you really want to change Groups Status ?',
            input: 'radio',
            inputOptions: inputOptions,
            inputValidator: function (msg) {
                console.log(msg);
                if (msg === "yes") {
                    $.ajax({
                        type: "POST",
                        url: "inc/smsModule.php",
                        data: {
                            id: id,
                            sts: sts,
                            action: action
                        },
                        dataType: "text",
                        success: function (response) {
                            var result = $.parseJSON(response);
                            if (result[1] == "success") {

                                swal(
                                    'Status Updated',
                                    result[0],
                                    'success'
                                )
                                $("#groupData").html(result[2]);
                            } else if (result[1] == "error") {
                                swal(
                                    'Opps',
                                    result[0],
                                    'error'
                                )
                            }
                        }
                    });
                }
            }
        });
    });
    /* Change Contact Sts */
    $(document).on('click', '#editGrp', function () {
        var id = $(this).val();
        var action = "editGrp";
        var inputOptions = new Promise(function (resolve) {
            setTimeout(function () {
                resolve({
                    'yes': "Yes",
                    'no': "No",
                })
            }, 1000)
        })
        swal({
            title: 'Do you really want to Update Group Name ?',
            input: 'radio',
            inputOptions: inputOptions,
            inputValidator: function (msg) {
                console.log(msg);
                if (msg === "yes") {
                    $.ajax({
                        type: "POST",
                        url: "inc/smsModule.php",
                        data: {
                            id: id,
                            action: action
                        },
                        dataType: "text",
                        success: function (response) {
                            var result = $.parseJSON(response);
                            if (result[1] === "success") {
                                console.log(result[2]);
                                $("#group_name").val(result[2].groupName);
                                $("#actionGrp").val("updateGrp");
                                $("#groupID").val(result[2].id);
                                $("#addGroup").text("Update Group");
                                $(window).scrollTop(100);
                            } else {
                                swal(
                                    'Unabel to update group',
                                    console.log(result[0]),
                                    'success'
                                )
                            }
                        }
                    });
                }
            }
        });
    });


    /* Assign Groups Module */
    $("#assignGroup").click(() => {
        var groupId = $("#groupName").val();
        let contactList = []
        let checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
        var action = "assignContact";
        for (var i = 0; i < checkboxes.length; i++) {
            contactList.push(checkboxes[i].value)
        }
        console.log(groupId);
        console.table(contactList);
        if (contactList.length < 2) {
            swal(
                'Error',
                'Please choose at least two contacts',
                'error'
            )
            // alert("Please choose at least to contacts");
        } else if (groupId === "") {
            swal(
                'Error',
                'Please choose a group',
                'error'
            )
        } else {
            $.ajax({
                type: "POST",
                url: "inc/smsModule.php",
                data: {
                    contactList: contactList,
                    groupId: groupId,
                    action: action
                },
                dataType: "text",
                success: function (response) {
                    var result = $.parseJSON(response);
                    swal(
                        result[1],
                        result[0],
                        result[1]
                    );
                }
            });
        }
    });








    /*================================
            SMS Sending Module 
     =================================*/

    $(document).on('click', '#smsGroup', function (e) {
        id = $(this).val();
        action = "groupContacts";
        if ($(this).prop("checked") == true) {
            $.ajax({
                type: "POST",
                url: "inc/smsModule.php",
                data: {
                    id: id,
                    action: action
                },
                dataType: "text",
                success: function (response) {
                    $("." + id + "groupDiv").html(response);
                }
            });
        } else {
            $("." + id + "groupDiv").html("");
        }
    });

    $("#sendSMS").click(() => {

        let contactList = []
        let smsTitle = $(".smsTitle").val();
        let smsMessage = $(".smsMessage").val();
        var type = $("#type").val();
        if (type == "both") {
            type = "sms, notification";
        }
        console.log(smsMessage + smsTitle);
        let checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
        var action = "sendMessage";
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].getAttribute("data-type") === "contact") {
                contactList.push(checkboxes[i].value);
            }
        }
        if (smsTitle == "" || smsMessage == "" || type == "") {
            swal(
                "Filed Required",
                "Both SMS Title & Message Required",
                'error'
            )
        }
        else if (contactList.length === 0 && type != "notification") {
            swal(
                "Filed Required",
                "Please Choose at least one contact",
                'error'
            )
        } else {
            $.ajax({
                type: "POST",
                url: "inc/smsModule.php",
                data: {
                    contactList: contactList,
                    smsTitle: smsTitle,
                    smsMessage: smsMessage,
                    type: type,
                    action: action
                },
                dataType: "text",
                success: function (response) {
                    console.log(response);
                    var result = $.parseJSON(response);
                    if (result[1] == "success") {
                        swal(
                            "Sent",
                            result[0],
                            result[1]
                        )
                    }
                }
            });
        }
    });
});