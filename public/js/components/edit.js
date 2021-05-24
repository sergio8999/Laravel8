var carousel=[];

function main(){
    $('span').on('click',function(e){
        $('#deletedImages').remove();
        /* carousel += e.target.id; */
        carousel.push(e.target.id);
        var div = e.target.parentElement;
        $(div).empty();
        $('form').append($('<input type="hidden" id="deletedImages">').attr({'name':'deletedImages','value':carousel}));        
    })


    $('#image').on('change',function(){
        readURL(this);
    })

    $('#carousel').on('change', function(){
        $('#imagesSelected').empty();
        readURL(this);
    })
}

function readURL(input) {
    for(let i=0;i<input.files.length;i++){
        if (input.files && input.files[i]) {
            var reader = new FileReader();
                reader.onload = function (e) {
                    if(input.id == 'image')
                        $('#img').attr('src', e.target.result);
                    else
                        $('#imagesSelected').append($('<img>').attr({'src' : e.target.result, 'alt' : 'imagen'}).addClass(['image','mr-2']));
                }
    
            reader.readAsDataURL(input.files[i]);
        }
    }  
}


window.addEventListener('load',main);