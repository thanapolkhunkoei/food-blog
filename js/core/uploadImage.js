var images = []
var selecter = ''
class UploadImg {
    constructor(index){
        this.filesId = $('#files')
        this.imgBoxId = $('#img_box')
        this.indexDel = index
    }
    // uploadZone(){
    //     var str_html = `<button id="uploadImg" class="btn btn-warning">Select file</button>
    //                     <div id="upload-container"  class="upload-container">
    //                         <h3 class="text" >Drop your Image here</h3>
    //                         <h3 class="font"></h3>
    //                         <input  class="d-none" type="file" id="files" name="files[]" multiple onchange="${this.img_select()}" />
    //                         <div id="img_box" class="card-body d-flex flex-wrap justify-content-start">
    //                         </div>
    //                     </div>`
    //     return $('#uploadZone').html(str_html)
    // }
    
    img_select(){
        var image = $(this.filesId)[0].files;
	    for(let i = 0; i < image.length; i++) {
            images.push({
                "src" : URL.createObjectURL(image[i])
            })
	    }
	    $(this.imgBoxId).html(this.img_preview())
    }

    img_preview(){
        var image = "";
        images.map((i) =>{
            image += `<div class="img-container d-flex justify-content-center position-relative">
                            <img onclick="remove_img(${images.indexOf(i)})" src="${i.src}" alt="">
                           <span class="position-absolute">
                               x
                           </span>
                      </div>`;
        })
        console.log(images)
        console.log(image)
        return image
    }

    remove_img(){
        // console.log(this.images)
        // console.log(this.indexDel)
        images.splice(this.indexDel,1)
        $(this.imgBoxId).html(this.img_preview())
    }
    DragAndDrop(){
        selecter = $('.upload-container')[0].addEventListener
        selecter('dragover' , e => {
            e.preventDefault()
        }) 
        
        selecter('dragleave' , e => {
            e.preventDefault()
        }) 
        
        selecter('drop', e => {
            e.preventDefault()
            var image = e.dataTransfer.files;
            for(let i = 0; i < image.length; i++) {
                images.push({
                    "src" : URL.createObjectURL(image[i])
                })
            }
            console.log(images)
            upload_file = image
            $(this.imgBoxId).html(this.img_preview())
        })
    }
  
} 



