$(document).ready(function(){
	if(window.location.href.includes("create")){
		
		//Example 2
		$("#filer_input2").filer({
			limit: null,
			maxSize: null,
			extensions: null,
			changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
			showThumbs: true,
			theme: "dragdropbox",
			templates: {
				box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
				item: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li>{{fi-progressBar}}</li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
				itemAppend: '<li class="jFiler-item">\
								<div class="jFiler-item-container">\
									<div class="jFiler-item-inner">\
										<div class="jFiler-item-thumb">\
											<div class="jFiler-item-status"></div>\
											<div class="jFiler-item-thumb-overlay">\
												<div class="jFiler-item-info">\
													<div style="display:table-cell;vertical-align: middle;">\
														<span class="jFiler-item-title"><b title="{{fi-name}}">Ảnh Sản Phẩm</b></span>\
														<span class="jFiler-item-others">{{fi-size2}}</span>\
													</div>\
												</div>\
											</div>\
											{{fi-image}}\
										</div>\
										<div class="jFiler-item-assets jFiler-row">\
											<ul class="list-inline pull-left">\
												<li><span class="jFiler-item-others text-success"><i class=\"icon-jfi-check-circle\"></i>Success</span></li>\
											</ul>\
											<ul class="list-inline pull-right">\
												<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
											</ul>\
										</div>\
									</div>\
								</div>\
							</li>',
				progressBar: '<div class="bar"></div>',
				itemAppendToEnd: false,
				canvasImage: true,
				removeConfirmation: true,
				_selectors: {
					list: '.jFiler-items-list',
					item: '.jFiler-item',
					progressBar: '.bar',
					remove: '.jFiler-item-trash-action'
				}
			},
			dragDrop: {
				dragEnter: null,
				dragLeave: null,
				drop: null,
				dragContainer: null,
			},
			
			files: null,
			addMore: true,
			allowDuplicates: true,
			clipBoardPaste: true,
			excludeName: null,
			beforeRender: null,
			afterRender: null,
			beforeShow: null,
			beforeSelect: null,
			onSelect:function (files) {
				var allowedExtensions = ['jpg', 'jpeg', 'png'];
		
				for (var i = 0; i < files.length; i++) {
					var fileName = files[i].name;
					var extension = fileName.split('.').pop().toLowerCase();
		
					if (!allowedExtensions.includes(extension)) {
						alert('File ' + fileName + ' không hợp lệ. Chỉ chấp nhận các file có đuôi là jpg, jpeg hoặc png.');
						return false; // Chặn việc chọn file không hợp lệ
					}
				}
		
				// Tiếp tục xử lý khi các tệp tin đều hợp lệ
				console.log('Các tệp tin được chọn đều hợp lệ.');
			},
			afterShow: null,
			onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
				var filerKit = inputEl.prop("jFiler"),
					file_name = filerKit.files_list[id].name;
	
				$.get('/admin/quanlisanpham/create', {file: file_name});
			},
			onEmpty: null,
			options: null,
			dialogs: {
				alert: function(text) {
					return alert(text);
				},
				confirm: function (text, callback) {
					confirm(text) ? callback() : null;
				}
			},
			captions: {
				button: "Choose Files",
				feedback: "Choose files To Upload",
				feedback2: "files were chosen",
				drop: "Drop file here to Upload",
				removeConfirmation: "Are you sure you want to remove this file?",
				errors: {
					filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
					filesType: "Only Images are allowed to be uploaded.",
					filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
					filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
				}
			}
		});
	}else{

		var yourElement = document.getElementById('product-data');
		var jFilerData = null;
		// const là hằng k thể thay đổi=
		var csrfToken =	document.getElementsByName('_token')[0].value;
		// alert(csrfToken);
		var productData = JSON.parse(yourElement.dataset.product);
			
				// Chuyển đổi dữ liệu thành định dạng mà jFiler mong đợi
				jFilerData = productData.map(function (file) {
					return {
					name: file.file_name,
					size: 0, // Bạn có thể muốn cung cấp thông tin về kích thước tệp tin
					type: getFileType(file.file_name), // Thay thế bằng loại tệp tin thực tế của bạn
					file: '/front/public/image/' + file.file_name, // Đường dẫn đầy đủ đến tệp tin
					caption: file.caption,
					key: file.id, // Một khóa độc định cho mỗi tệp tin
					// Các thông tin khác nếu cần
					};
				});
		// Hàm để xác định loại tệp tin dựa trên phần mở rộng
		function getFileType(fileName) {
			var extension = fileName.split('.').pop().toLowerCase();
			if (extension === 'png' || extension === 'jpg' || extension === 'jpeg') {
			return 'image/' + extension;
			} else {
			// Nếu không phải PNG hoặc JPG, bạn có thể muốn xác định loại khác hoặc để mặc định
			return 'application/octet-stream';
			}
		}
		// function saveProduct() {
		// 	// Sử dụng jQuery để lấy dữ liệu form
		// 	var formData = new FormData($('#editProducts')[0]);
		// 	$.ajax({
		// 		url: "{{ route('updateProducts') }}",  // Thay thế đường dẫn API của Laravel
		// 		type: 'POST',
		// 		headers: {
		// 			'X-CSRF-TOKEN': csrfToken
		// 		},
		// 		contentType: 'application/json',
		// 		data: JSON.stringify({ jFilerData: jFilerData }),
		// 		success: function (response) {
		// 			console.log(response);
		// 			// Xử lý kết quả phản hồi từ Laravel (nếu cần)
		// 		},
		// 		error: function (error) {
		// 			console.log(error);
		// 			// Xử lý lỗi (nếu có)
		// 		}
		// 	});
		// };
		//Example 2
		$("#filer_input2").filer({

			limit: null,
			maxSize: null,
			extensions: null,
			changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
			showThumbs: true,
			theme: "dragdropbox",
			templates: {
				box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
				item: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li>{{fi-progressBar}}</li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
				itemAppend: '<li class="jFiler-item">\
								<div class="jFiler-item-container">\
									<div class="jFiler-item-inner">\
										<div class="jFiler-item-thumb">\
											<div class="jFiler-item-status"></div>\
											<div class="jFiler-item-thumb-overlay">\
												<div class="jFiler-item-info">\
													<div style="display:table-cell;vertical-align: middle;">\
														<span class="jFiler-item-title"><b title="{{fi-name}}">Ảnh Sản Phẩm</b></span>\
														<span class="jFiler-item-others">{{fi-size2}}</span>\
													</div>\
												</div>\
											</div>\
											{{fi-image}}\
										</div>\
										<div class="jFiler-item-assets jFiler-row">\
											<ul class="list-inline pull-left">\
												<li><span class="jFiler-item-others text-success"><i class=\"icon-jfi-check-circle\"></i>Success</span></li>\
											</ul>\
										</div>\
									</div>\
								</div>\
							</li>',
				progressBar: '<div class="bar"></div>',
				itemAppendToEnd: false,
				canvasImage: true,
				removeConfirmation: true,
				_selectors: {
					list: '.jFiler-items-list',
					item: '.jFiler-item',
					progressBar: '.bar',
					remove: '.jFiler-item-trash-action'
				}
			},
			dragDrop: {
				dragEnter: null,
				dragLeave: null,
				drop: null,
				dragContainer: null,
			},
			
			files: jFilerData,
			addMore: false,
			allowDuplicates: true,
			clipBoardPaste: true,
			excludeName: null,
			beforeRender: null,
			afterRender: null,
			beforeShow: null,
			beforeSelect: null,
			onSelect: function (files) {
				var allowedExtensions = ['jpg', 'jpeg', 'png'];
				var formData = new FormData();
		
				for (var i = 0; i < files.length; i++) {
					var fileName = files[i].name;
					var extension = fileName.split('.').pop().toLowerCase();
		
					if (allowedExtensions.includes(extension)) {
						alert('File ' + fileName + ' không hợp lệ. Chỉ chấp nhận các file có đuôi là jpg, jpeg hoặc png.');
						return false; // Chặn việc chọn file không hợp lệ
					}
		
					// Thêm từng ảnh vào FormData
					formData.append('images[]', files[i]);
				}
			},
			afterShow: null,
			onEmpty: null,
			options: null,
			dialogs: {
				alert: function(text) {
					return alert(text);
				},
				confirm: function (text, callback) {
					confirm(text) ? callback() : null;
				}
			},
			captions: {
				button: "Choose Files",
				feedback: "Choose files To Upload",
				feedback2: "files were chosen",
				drop: "Drop file here to Upload",
				removeConfirmation: "Are you sure you want to remove this file?",
				errors: {
					filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
					filesType: "Only Images are allowed to be uploaded.",
					filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
					filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
				}
			}
		});
	}
})
