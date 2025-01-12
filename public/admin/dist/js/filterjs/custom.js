$(document).ready(function(){
	if(window.location.href.includes("update")){
		var yourElement = document.getElementById('product-data');
		var jFilerData = null;
		// const là hằng k thể thay đổi=
		var productData = JSON.parse(yourElement.dataset.product);
		var productid = JSON.parse(yourElement.dataset.productid);
		var csrfToken = JSON.parse(yourElement.dataset.csrf);
		// console.log(productData,id);
		// Chuyển đổi dữ liệu thành định dạng mà jFiler mong đợi
		var jFilerData = productData.map(function(file, index) {
			return {
				name: "Ảnh Sản Phẩm", 
				size: 0, 
				type: getFileType(file),
				file: file, // Đường dẫn tệp
				caption: 'Image ' + (index + 1), 
				key: index, 
			};
		});
		// console.log(jFilerData);
		function getFileType(fileName) {
			var extension = fileName.split('.').pop().toLowerCase();
			if (extension === 'png' || extension === 'jpg' || extension === 'jpeg') {
				return 'image/' + extension;
			} else {
				// Nếu không phải PNG hoặc JPG, bạn có thể muốn xác định loại khác hoặc để mặc định
				return 'application/octet-stream';
			}
		}
	}
	$("#filer_input").filer({
		limit: 5,
		maxSize: 10,
		extensions: ['jpg', 'png', 'jpeg'],
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
										<li><span class="jFiler-item-others text-success"><i class=\"icon-jfi-check-circle\"></i>Success</span></li>\
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
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
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
				progressBar: '.bar ',
				remove: '.jFiler-item-trash-action'
			}
		},
		dragDrop: {
			dragEnter: null,
			dragLeave: null,
			drop: null,
			dragContainer: null,
		},
		uploadFile:null,
		files: jFilerData ? jFilerData : null,
		addMore: true,
		allowDuplicates: true,
		clipBoardPaste: true,
		excludeName: null,
		beforeRender: null,
		afterRender: null,
		beforeShow: null,
		beforeSelect: null,
		onSelect: null,
		afterShow: null,
		onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
			var filerKit = inputEl.prop("jFiler");
		        file_name = filerKit.files_list[id].file.file;
			if(window.location.href.includes("update")){
				// Kiểm tra xem file_name có thuộc mảng jFilerData hay không
				var isInJFilerData = jFilerData.some(function(item) {
					return item.file === file_name; // So sánh đường dẫn file
				});
			
				if (isInJFilerData) {
					// Xử lý logic xóa trong database tại đây
					$.ajax({
						url: '/remove-file', // URL của route Laravel
						type: 'POST',
						data: {
							file_name: file_name,
							id: productid,
							_token: csrfToken, // CSRF Token nếu cần
						},
						success: function(response) {
							// console.log('Success:', response);
						},
						error: function(xhr) {
							// console.error('Error:', xhr.responseText);
						}
					});
				} else {
					console.log(file_name + " không thuộc jFilerData (ảnh mới tải lên)");
					// Xử lý logic khác (nếu cần)
				}
			}
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
				filesLimit: "Chỉ cho upload tối đa {{fi-limit}} ảnh.",
				filesType: "Chỉ cho phép upload ảnh.",
				filesSize: "{{fi-name}} quá lớn! Size max: {{fi-maxSize}} MB.",
				filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
			}
		}
	});

	
})