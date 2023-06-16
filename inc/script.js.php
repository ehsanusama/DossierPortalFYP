<script>
	$(function() {
		$(window).on("unload", function() {
			var scrollPosition = $(window).scrollTop();
			localStorage.setItem("scrollPosition", scrollPosition);
		});
		if (localStorage.scrollPosition) {
			$(window).scrollTop(localStorage.getItem("scrollPosition"));
		}
	});
	var imageTypes = ['jpeg', 'jpg', 'png', 'svg', 'gif', 'txt']; //Validate the images to show

	function showImage(src, target)

	{

		var fr = new FileReader();

		fr.onload = function(e)

		{

			target.src = this.result;

		};

		fr.readAsDataURL(src.files[0]);

	}

	var uploadImage = function(obj)

	{

		var val = obj.value;

		var lastInd = val.lastIndexOf('.');

		var ext = val.slice(lastInd + 1, val.length);

		if (imageTypes.indexOf(ext) !== -1)

		{

			var id = $(obj).data('target');

			var src = obj;

			var target = $(id)[0];

			showImage(src, target);

		} else

		{

			obj.value = '';

			obj.style.background = 'yellow';

			alert("only allowed  ('jpeg', 'jpg', 'png','svg','gif') files");



		}

	}

	function getDate(element) {
		var date;
		try {
			date = $.datepicker.parseDate(dateFormat, element.value);
		} catch (error) {
			date = null;
		}

		return date;
	}
	/******** Plugins ********/
	$(function() {
		$('.myTable').DataTable()
		$('[data-toggle="tooltip"]').tooltip()

		/*Date Picker*/
		var dateFormat = "mm/dd/yy",
			from = $("#from,.from")
			.datepicker({
				defaultDate: "1w",
				changeMonth: true,
				numberOfMonths: 1
			})
			.on("change", function() {
				to.datepicker("option", "minDate", getDate(this));
			}),
			to = $("#to,.to").datepicker({
				defaultDate: "1w",
				changeMonth: true,
				numberOfMonths: 1
			})
			.on("change", function() {
				from.datepicker("option", "maxDate", getDate(this));
			});


		//simple dates
		$(".dateField").datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '1945:' + (new Date).getFullYear(),
			dateFormat: 'dd-M-yy',
			showWeek: true,
			firstDay: 1

		});

		$(".monthDateField").datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '1945:' + (new Date).getFullYear(),
			dateFormat: 'yy-mm'
		});
	})

	$(function() {
		var response_module = ["login", "forgot_password_module", "register_module", "executive_summary", 'register_staff_module', 'research_data', 'academic_data', 'other_contributions', 'professional_experience', 'taught_course_details', 'traning_conducted', 'academic_qualification', 'certifications'];
		$(document).on('submit', '.ajax-form', function() {
			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: "text",
				beforeSend: function() {
					$(".response").html('<div class="alert alert-info">Please Wait...</div>');
				},
				success: function(response, text) {
					var json = JSON.parse($.trim(response));
					if (response_module.includes(json.action)) {
						$(".response").html('<div class="alert alert-' + json.sts +
							'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
							json.msg + '</div>');
						if (json.action == "login" && json.sts == "success") {
							setTimeout(function() {
								window.location = 'index.php'
							}, 1500)
						}
						if ((json.action == "register_staff_module" || json.action == "executive_summary" || json.action == "research_data" || json.action == "academic_data" || json.action == "other_contributions") && json.sts == "success") {
							setTimeout(function() {
								$(".modal").modal('hide');
								window.location = window.location.href
								window.location =
									"index.php?nav=<?= @$_REQUEST['nav'] ?>"
							}, 2500)
						}
					} else {
						if (json.sts == "success") {
							$(".modal").modal('hide');
							setTimeout(function() {
								window.location = 'index.php?nav=<?= @$_REQUEST['nav'] ?>'
							}, 1000)
						}
						$(".sticky-response").html('<div class="alert alert-' + json.sts +
							'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
							json.msg + '</div>');
					}
					console.log(json)
					//hideAlert(2000);
					if (json.action == "employee_roaster") {
						hideAlert(2000);
					}
				},
				error: function(request, status, error) {
					$(".response").html(
						'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
						request.responseText + '</div>');
				}
			});
			return false;
		})
		/*for staff register only or user*/
		$(document).on('submit', '.ajax-form-with-file', function() {
			var form = $(this);
			var fd = new FormData(this);
			var files = $('#img')[0].files[0];
			console.log(fd);
			console.log(files);
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: fd,
				dataType: "text",
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(".response").html('<div class="alert alert-info">Please Wait...</div>');
				},
				success: function(response, text) {
					var json = JSON.parse($.trim(response));
					if (response_module.includes(json.action)) {
						$(".response").html('<div class="alert alert-' + json.sts +
							'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
							json.msg + '</div>');
						if (json.action == "login" && json.sts == "success") {
							setTimeout(function() {
								window.location = 'index.php'
							}, 1500)
						}
						if ((json.action == "register_staff_module" || json.action == "professional_experience" || json.action == "taught_course_details" || json.action == "traning_conducted" || json.action == "academic_qualification" || json.action == "certifications" || json.action == "other_contributions") && json.sts == "success") {
							setTimeout(function() {
								$(".modal").modal('hide');
								window.location = window.location.href;
								window.location =
									"index.php?nav=<?= @$_REQUEST['nav'] ?>"
							}, 1500)
						}
					} else {
						if (json.sts == "success") {
							$(".modal").modal('hide');
							setTimeout(function() {
								window.location = 'index.php'
							}, 1000)
						}
						$(".sticky-response").html('<div class="alert alert-' + json.sts +
							'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
							json.msg + '</div>');
					}
					console.log(json)
					//hideAlert(2000);
					if (json.action == "employee_roaster") {
						hideAlert(2000);
					}
				},
				error: function(request, status, error) {
					$(".response").html(
						'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
						request.responseText + '</div>');
				}
			});
			return false;
		})
	})

	/*schedule action*/
	$(document).on('submit', '.ajax-form-employee-schedule', function() {
		var form = $(this);
		$.ajax({
			url: "inc/load_html.php",
			type: "post",
			dataType: "text",
			data: form.serialize(),
			beforeSend: function() {
				$("#schedule_data").html(
					'<div class="progress"> <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div> </div>'
				)
			},
			success: function(response, text) {
				$("#schedule_data").html(response);
			},
			error: function(request, status, error) {
				$("#schedule_data").html('<div class="alert alert-danger">' + request.responseText +
					'</div>');
			}

		});
		return false;
	})
	/*Leave Management Search Action*/
	$(document).on('submit', '#showSearchLeave,#showLeaveRequest', function() {
		var form = $(this);
		$.ajax({
			url: "inc/load_html.php",
			type: "post",
			dataType: "text",
			data: form.serialize(),
			beforeSend: function() {
				$("#search_data").html(
					'<div class="progress"> <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div> </div>'
				)
			},
			success: function(response, text) {
				$("#search_data").html(response);
			},
			error: function(request, status, error) {
				$("#search_data").html('<div class="alert alert-danger">' + request.responseText +
					'</div>');
			}

		});
		return false;
	})

	/*Load Sceen Shots*/
	$(document).on('click', ".showScreenShots", function() {
		var obj = $(this).attr('title').split('|');
		var action = obj[0];
		var table = obj[1];
		var emp_id = obj[2];
		var business_id = obj[3];
		var dated = obj[4];
		$.ajax({
			url: "inc/load_html.php",
			type: "post",
			dataType: "text",
			data: {
				action: action,
				table: table,
				emp_id: emp_id,
				business_id: business_id,
				dated: dated
			},
			beforeSend: function() {
				$("#modal-body").html('<div class="alert alert-info">Please Wait...</div>')
			},
			success: function(response, text) {
				$("#modal-body").html(response);
			},
			error: function(request, status, error) {
				$("#modal-body").html('<div class="alert alert-danger">' + request.responseText +
					'</div>');
			}
		});
	})


	/*Load Employee Schedule*/
	$(document).on('click', ".modal-action", function() {
		var obj = $(this).attr('title').split('|');
		var action = obj[0];
		var field = obj[1];
		var val = obj[2];
		$.ajax({
			url: "inc/load_html.php",
			type: "post",
			dataType: "text",
			data: {
				action: action,
				field: val
			},
			beforeSend: function() {
				$("#modal-body").html('<div class="alert alert-info">Please Wait...</div>')
			},
			success: function(response, text) {
				$("#modal-body").html(response);
			},
			error: function(request, status, error) {
				$("#modal-body").html('<div class="alert alert-danger">' + request.responseText +
					'</div>');
			}
		});
	})

	/*Verify Link*/
	$(document).on('click', "#verify-link", function() {
		var email = $(this).attr('title');
		$.ajax({
			url: "api/index.php",
			type: "post",
			dataType: 'text',
			data: {
				action: "verify_link",
				email: email
			},
			beforeSend: function() {
				$(".sticky-response").html(
					'<div class="alert alert-info">Sending Link ... Please Wait</div>');
			},
			success: function(response, text) {
				var json = JSON.parse($.trim(response));

				$(".sticky-response").html('<div class="alert alert-' + json.sts + '">' + json.msg +
					'</div>');

				console.log(json)
				hideAlert(2000);
			},
			error: function(request, status, error) {
				$(".response").html('<div class="alert alert-danger">' + request.responseText +
					'</div>');
			}
		});
		return false;
	})

	$(document).on('change', "#user_role_radio", function() {
		getUserRoleRights($(this).val());
	});

	function getUserRoleRights(user_role) {
		$.get("inc/ajax_user_role_rights.php", {
			user_role: user_role
		}, function(response) {
			$("#user_role_response").html(response);
			$(".user_role_right_btn").removeClass('hidden');
		});
	}
	$(".user_role_right_form").unbind().bind('submit', function() {
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			dataType: 'text',
			data: form.serialize(),
			beforeSend: function() {
				$(".sticky-response").html('<div class="alert alert-info">Please Wait</div>');
			},
			success: function(response, text) {
				var json = JSON.parse($.trim(response));

				$(".sticky-response").html('<div class="alert alert-' + json.sts + '">' + json.msg +
					'</div>');

				console.log(json)
				hideAlert(2000);
			},
			error: function(request, status, error) {
				$(".sticky-response").html('<div class="alert alert-danger">' + request.responseText +
					'</div>');
			}
		});
		return false;
	});
	/*Switch Btn*/
	$(document).on('change', '.switch-btn', function() {
		var status = cls = ''
		var checkbox = $(this);
		var title = $(this).attr('title').split('|');
		var table = title[0];
		var id = title[1];
		if (table == "business_tracking" || table == "is_multiple" || table == "is_tracking_staff" || table == "business_weekly_promotion") {
			if ($(this).prop('checked')) {
				status = "yes";
				cls = 'success';
			} else {
				status = "no";
				cls = 'danger';
			}
		} else {
			if ($(this).prop('checked')) {
				status = "enable";
				cls = 'success';
			} else {
				status = "disabled";
				cls = 'danger';
			}
		}

		$.ajax({
			url: "api/index.php",
			type: "post",
			dataType: 'text',
			data: {
				action: "change_account_status",
				status: status,
				id: id,
				table: table
			},
			beforeSend: function() {
				$(".sticky-response").html('<div class="alert alert-info">Please Wait</div>');
			},
			success: function(response, text) {
				var json = JSON.parse($.trim(response));

				$(".sticky-response").html('<div class="alert alert-' + json.sts + '">' + json.msg +
					'</div>');
				checkbox.closest('span').find('.user_status').html(status)
				console.log(json)
				hideAlert(2000);
			},
			error: function(request, status, error) {
				$(".sticky-response").html('<div class="alert alert-danger">' + request.responseText +
					'</div>');
			}

		})
		return false;
	})

	$(document).on('click', '.qr-modal-btn', function() {
		var title = $(this).attr('title');
		console.log(title)
		$("#qr-modal-body").html('<iframe src="scan.php?shift=' + title +
			'" width="100%" style="min-height: 400px" frameborder="0"></iframe>')
		return false;
	})
	$(function() {
		$('#qr-modal').on('hidden.bs.modal', function() {
			$("#qr-modal-body").html('')
		});
	})

	/****** Custom Functions ******/
	function deleteData(table, fld, id, url, e) {
		var x = confirm('Do you want to ID# : ' + id);
		var el = e;
		if (x == true) {
			$.ajax({
				url: "api/index.php",
				type: "post",
				data: {
					table: table,
					fld: fld,
					id: id,
					url: url,
					action: "delete_data"
				},
				dataType: "text",
				beforeSend: function() {
					$(".sticky-response").html('<div class="alert alert-info">Please Wait</div>');
				},
				success: function(response, text) {
					var json = JSON.parse($.trim(response));

					$(".sticky-response").html('<div class="alert alert-' + json.sts + '">' + json.msg +
						'</div>');
					if (e.title == "emp_attendance") {
						window.location =
							"index.php?nav=<?= @$_REQUEST['nav'] ?>&business=<?= @$_REQUEST['business'] ?>&dated=<?= @$_REQUEST['dated'] ?>"
					}
					if (json.msg == 'Data has been deleted' && e.title != "emp_attendance") {
						e.closest('tr').remove()
					}
					console.log(json)
					hideAlert(2000);

				},
				error: function(request, status, error) {
					$(".sticky-response").html('<div class="alert alert-danger">' + request.responseText +
						'</div>');
				}
			});
		}
	}

	function distance(lat1 = 31.4304978, lon1 = 73.0669109, lat2, lon2, unit) {
		var radlat1 = Math.PI * lat1 / 180
		var radlat2 = Math.PI * lat2 / 180
		var theta = lon1 - lon2
		var radtheta = Math.PI * theta / 180
		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		if (dist > 1) {
			dist = 1;
		}
		dist = Math.acos(dist)
		dist = dist * 180 / Math.PI
		dist = dist * 60 * 1.1515
		if (unit == "K") {
			dist = dist * 1.609344
		}
		if (unit == "N") {
			dist = dist * 0.8684
		}
		return dist
	}

	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition, showError);
		} else {
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}

	function showPosition(position) {
		var latlon = position.coords.latitude + "," + position.coords.longitude;
		locationData = latlon;
		document.getElementById('latlong').value = latlon;


	}
	//To use this code on your website, get a free API key from Google.

	function showError(error) {
		switch (error.code) {
			case error.PERMISSION_DENIED:
				x.innerHTML = "User denied the request for Geolocation."
				break;
			case error.POSITION_UNAVAILABLE:
				x.innerHTML = "Location information is unavailable."
				break;
			case error.TIMEOUT:
				x.innerHTML = "The request to get user location timed out."
				break;
			case error.UNKNOWN_ERROR:
				x.innerHTML = "An unknown error occurred."
				break;
		}
	}

	function hideAlert(time = 800) {
		setTimeout(function() {
			$(".alert").slideUp(800)
		}, time);
	}
	var timer = null;

	$(document).on('keyup', ".autoSave", function() {
		clearTimeout(timer);
		var t = $(this)
		timer = setTimeout(function() {
			doStuff(t)
		}, 1000)
	})

	function doStuff(e) {
		var tr = e.closest('tr');
		tr[0].children[0][0].click()
	}


	// Define the function
	// to screenshot the div
	function takeScreenshot() {
		let div =
			document.getElementById('photo');

		// Use the html2canvas
		// function to take a screenshot
		// and append it
		// to the output div
		html2canvas(div).then(
			function(canvas) {
				document
					.getElementById('output')
				// .appendChild(canvas);

				var imageData = canvas.toDataURL("image/png");
				// Now browser starts downloading it instead of just showing it
				var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");
				$("#download_link").attr("download_link", "attendance_report.png").attr("href", newData);
				document.getElementById('download_link').click();
			})
	}
	/*mark_manual_attendance*/
	var timer;
	var timeout = 1500;
	$(document).on('change', ".mark_manual_attendance", function() {
		var input = $(this);
		title = $(this).attr('title').split('|');
		var operation = title[0];
		var att_id = title[1];
		var business_id = title[2];
		var emp_id = title[3];
		var dated = title[4];
		var shift = title[5];
		var admin_id = title[6];
		var att_time = $(this).val();
		clearTimeout(timer);

		timer = setTimeout(function() {
			//do stuff here e.g ajax call etc....

			$.ajax({
				url: "api/index.php",
				type: "post",
				dataType: 'text',
				data: {
					action: "mark_manual_attendance",
					operation: operation,
					att_id: att_id,
					business_id: business_id,
					emp_id: emp_id,
					dated: dated,
					shift: shift,
					admin_id: admin_id,
					att_time: att_time
				},
				beforeSend: function() {
					$(".sticky-response").html(
						'<div class="alert alert-info">Please Wait</div>');
				},
				success: function(response, text) {
					var json = JSON.parse($.trim(response));
					if (json.sts == "success") {
						input.attr('title', 'update|' + json.lastId + '|' + business_id + '|' +
							emp_id + '|' + dated + '|' + shift + '|' + admin_id);
					}
					$(".sticky-response").html('<div class="alert alert-' + json.sts + '">' +
						json.msg + '</div>');

					console.log(json)
					hideAlert(2000);
				},
				error: function(request, status, error) {

					$(".sticky-response").html('<div class="alert alert-danger">' + request
						.responseText + '</div>');
				}

			})
		}, timeout);


		return false;
	})

	/* tiny mce init */
	tinymce.init({
		selector: '#business_rules',
		plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
		toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
		toolbar_mode: 'floating',
		tinycomments_mode: 'embedded',
		tinycomments_author: 'Author name',
	});
	var i = 1;
	$("#add_ingr_tr").click(() => {
		i++;
		$(".dynamic_fields_tr").append(`<tr class="w-100 py-1" id='row${i}'>
                        <td class="d-flex">
                            <div class='addMore_ingr d-flex w-100'>
                                <input type='text' class="d-flex form-control mr-2" placeholder='Property Name' name='propName[]'
                                    required>
                                <input type='text' class="form-control d-flex" placeholder='Property Value'
                                    name='propValue[]' required>
                                <div class="ml-2"><button type="button" id='${i}'
                                        class="btn_remove_ingr py-2 px-3 btn btn-danger text-white btn-sm">-</button></div>
                            </div>
                        </td>
                    </tr>`);
	});

	$(document).on("click", ".btn_remove_ingr", function() {
		var button_id = $(this).attr('id');
		$("#row" + button_id + "").remove();
	});
	$(document).on("change", ".salary_mode", function() {
		var salary_mode = $(this);
		if (salary_mode.val() == "fixed") {
			$(".fixed_row").removeClass('hidden')
			$(".per_hour_row").addClass('hidden')
			$(".per_hour_fld").val('')

		} else if (salary_mode.val() == "per_hour") {
			$(".per_hour_row").removeClass('hidden')
			$(".fixed_row").addClass('hidden')
			$(".fixed_fld").val('')


		}
	});
	$(document).on("click", ".attendance_delete_btn", function() {
		var att_id = $(this).attr('title');
		if (confirm("Do you want to delete attendance record ?")) {
			$.ajax({
				url: "api/index.php",
				type: "post",
				dataType: 'text',
				data: {
					action: "delete_attendance",
					att_id: att_id
				},
				beforeSend: function() {
					$(".sticky-response").html('<div class="alert alert-info">Please Wait</div>');
				},
				success: function(response, text) {
					var json = JSON.parse($.trim(response));

					$(".sticky-response").html('<div class="alert alert-' + json.sts + '">' + json.msg +
						'</div>');

					console.log(json)
					hideAlert(2000);
					setTimeout(function() {
						window.location.reload()
					}, 2000);
				},
				error: function(request, status, error) {
					$(".sticky-response").html('<div class="alert alert-danger">' + request.responseText +
						'</div>');
				}
			});
		} else {
			return false;
		}
	});

	$(document).on('click', ".pdf_btn", function() {
		var today = new Date();

		var date = today.getFullYear() + '_' + (today.getMonth() + 1) + '_' + today.getDate();

		var time = today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();

		var dateTime = date + '_' + time;

		let body = document.body
		let html = document.documentElement
		let height = Math.max(body.scrollHeight, body.offsetHeight,
			html.clientHeight, html.scrollHeight, html.offsetHeight)
		let element = document.querySelector('#pdfBody')
		let heightCM = height / 35.35
		html2pdf(element, {
			margin: 1,
			filename: 'Attendance_Report_' + dateTime + '.pdf',
			html2canvas: {
				dpi: 600,
				letterRendering: true
			},
			image: {
				type: 'jpeg',
				quality: 0.98
			},
			jsPDF: {
				orientation: 'landscape',
				unit: 'cm',
				format: [heightCM, 60]
			}
		})
		// New Promise-based usage:
		html2pdf().set(opt).from(element).save();

	})

	$(document).on('click', ".pdf_portrait_btn", function() {

		var element = document.getElementById('pdfBodyPortrait');
		var today = new Date();

		var date = today.getFullYear() + '_' + (today.getMonth() + 1) + '_' + today.getDate();

		var time = today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
		var dateTime = date + '_' + time;
		var opt = {
			margin: 1,
			filename: 'Dossier_Report_' + dateTime + '.pdf',
			image: {
				type: 'jpeg',
				quality: 0.98
			},
			html2canvas: {
				scale: 2
			},
			jsPDF: {
				orientation: 'l',
				unit: 'px',
				format: 'a4',
				putOnlyUsedFonts: true,
				floatPrecision: 16
			}
		};
		html2pdf().set(opt).from(element).save();

	})


	/*addProductRowBtnLab*/
	$(document).on('click', '.addProductRowBtnLab', function() {
		var btn = $(this);
		var options = "";
		$.get('api/index.php', {
			action: "all_product"
		}, function(response) {
			var json = JSON.parse($.trim(response));
			options = $.trim(json.products);
			btn.closest('tr').after('<tr class="product-row"><td  colspan="2"> <input rows="3" class="form-control" name="research_domain_text[]"></input> </td>  <td colspan="2"><input type="text" class="form-control total"   name="research_domain_details[]"></td><td colspan="1"><input type="file" name="f[]" class="form-control" id="img" style="width: 150px;"></td><td><button type="button" class="btn btn-success btn-sm addProductRowBtnLab"><span class="fa fa-plus"></span></button><button type="button" class="btn btn-danger removeBtn btn-sm"><span class="fa fa-remove"></span></button></td> </tr>'); // $(this).closest('tr').find('.show_unshow').prop('checked', true);
			selectRefresh();
		})
	})
	$(document).on('click', '.removeBtn', function() {
		$(this).closest("tr").remove();
		calulation();
	})
	/*addQualificationRowBtn*/
	$(document).on('click', '.addQualificationRowBtn', function() {
		var btn = $(this);
		var options = "";
		$.get('api/index.php', {
			action: "all_product"
		}, function(response) {
			var json = JSON.parse($.trim(response));
			options = $.trim(json.products);
			btn.closest('tr').after('<tr class="product-row"><td colspan="2"><input type="text" class="form-control" name="degree[]"></input></td><td colspan="2"><input type="text" class="form-control " name="research[]"></td><td colspan="2"><input type="text" class="form-control " name="university[]"></td><td colspan="2"><input type="text" class="form-control " name="major_field[]"></td><td colspan="1"><input type="file" name="f[]" class="form-control" id="img" style="width: 150px;"></td><td><button type="button" class="btn btn-success btn-sm addQualificationRowBtn"><span class="fa fa-plus"></span></button></button><button type="button" class="btn btn-danger QualificationremoveBtn btn-sm"><span class="fa fa-remove"></span></button></td</tr>'); // $(this).closest('tr').find('.show_unshow').prop('checked', true);
			selectRefresh();
		})
	})
	$(document).on('click', '.QualificationremoveBtn', function() {
		$(this).closest("tr").remove();
		calulation();
	})
</script>