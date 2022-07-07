function adminDashbroad() {
    window.location.href = BASE_URL +"admin_dashbroad/add_menu";
}

function backToHome() {
    window.location.href = BASE_URL +"home";
}

function getImagePreview(event){
    // var image = URL.createObjectURL(event.target.files[0])
    // var imagediv = document.getElementById('preview');
    // var newimg = document.createElement('img')
    // // imagediv.innerHTML='';
    // newimg.src=image;
    // newimg.width="400";
    // imagediv.appendChild(newimg);
}


//upload mul img
//  	if (window.File && window.FileList && window.FileReader) {
//     $("#files").on("change", function(e) {
//       var files = e.target.files,
//         filesLength = files.length;
//       for (var i = 0; i < filesLength; i++) {
//         var f = files[i]
//         var fileReader = new FileReader();
//         fileReader.onload = (function(e) {
//           var file = e.target;
//           $("<span class=\"pip\">" +
//             "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
//             "<br/><span class=\"remove\">Remove image</span>" +
//             "</span>").insertAfter("#files");
//           $(".remove").click(function(){
//             $(this).parent(".pip").remove();
//           });
          
//         });
//         fileReader.readAsDataURL(f);
//       }
//     });
//   } else {
//     alert("Your browser doesn't support to File API")
//   }
//   globalFunctions.ddInput('input[type="file"]');

	


//upload mul img
// var globalFunctions = {};
// globalFunctions.ddInput = function(elem) {
//   if ($(elem).length == 0 || typeof FileReader === "undefined") return;
//   var $fileupload = $('input[type="file"]');
// //   var noitems = '<li class="no-items"><span class="blue-text underline">Browse</span> or drop here</li>';
//   var hasitems = '<div class="browse hasitems">Other files to upload? <span class="blue-text underline">Browse</span> or drop here</div>';
// //   var file_list = '<ul class="file-list"></ul>';
// //   var rmv = '<div class="remove"><i class="icon-close icons">x</i></div>'

//   $fileupload.each(function() {
//     var self = this;
//     var $dropfield = $('<div class="drop-field"><div class="drop-area"></div></div>');
//     $(self).after($dropfield).appendTo($dropfield.find('.drop-area'));
//     // var $file_list = $(file_list).appendTo($dropfield);
//     $dropfield.append(hasitems);
//     // $dropfield.append(rmv);
//     // $(noitems).appendTo($dropfield);
//     var isDropped = false;
//     $(self).on("change", function(evt) {
//       if ($(self).val() == "") {
//         // $file_list.find('li').remove();
//         // $file_list.append(noitems);
//       } else {
//         if (!isDropped) {
//           $dropfield.removeClass('hover');
//           $dropfield.addClass('loaded');
//           var files = $(self).prop("files");
//           traverseFiles(files);
//         }
//       }
//     });

//     $dropfield.on("dragleave", function(evt) {
//       $dropfield.removeClass('hover');
//       evt.stopPropagation();
//     });

//     $dropfield.on('click', function(evt) {
//       $(self).val('');
//       $file_list.find('li').remove();
//       $file_list.append(noitems);
//       $dropfield.removeClass('hover').removeClass('loaded');
//     });

//     $dropfield.on("dragenter", function(evt) {
//       $dropfield.addClass('hover');
//       evt.stopPropagation();
//     });

//     $dropfield.on("drop", function(evt) {
//       isDropped = true;
//       $dropfield.removeClass('hover');
//       $dropfield.addClass('loaded');
//       var files = evt.originalEvent.dataTransfer.files;
//       traverseFiles(files);
//       isDropped = false;
//     });


//     // function appendFile(file) {
//     //   console.log(file);
//     //   $file_list.append('<li>' + file.name + '</li>');
//     // }

//     function traverseFiles(files) {
//       if ($dropfield.hasClass('loaded')) {
//         $file_list.find('li').remove();
//       }
//       if (typeof files !== "undefined") {
//         for (var i = 0, l = files.length; i < l; i++) {
//           appendFile(files[i]);
//         }
//       } else {
//         alert("No support for the File API in this web browser");
//       }
//     }

//   });
// };




// ownnn
// var images= []
// function img_select(){
// 	var image = $('#files')[0].files;
// 	for(i = 0; i < image.length; i++) {
// 		images.push({
// 			 "src" : URL.createObjectURL(image[i])
// 		})
// 	}
// 	$('#img_box').html(img_preview())
// }

// function img_preview(){
// 	 var image = "";
// 	 images.map((i) =>{
// 		 image += `<div class="img-container d-flex justify-content-center position-relative">
// 		 				<img onclick="remove_img(${images.indexOf(i)})" src="${i.src}" alt="">
// 						<span class="position-absolute">
// 							x
// 						</span>
// 				   </div>`;
// 	 })
// 	 return image
// }

// function remove_img(index){
// 	images.splice(index,1)
// 	$('#img_box').html(img_preview())
// }

// selecter = $('.upload-container')[0].addEventListener

// selecter('dragover' , e => {
// 	e.preventDefault()
// }) 

// selecter('dragleave' , e => {
// 	e.preventDefault()
// }) 

// selecter('drop', e => {
// 	e.preventDefault()
// 	var image = e.dataTransfer.files;
// 	for(i = 0; i < image.length; i++) {
// 		images.push({
// 			 "src" : URL.createObjectURL(image[i])
// 		})
// 	}
// 	upload_file = image
// 	$('#img_box').html(img_preview())
// })


// `<button onclick=(editData(${row['menu_id']})) class="btn">Del</button>`+