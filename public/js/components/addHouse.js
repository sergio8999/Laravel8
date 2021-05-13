function main(){
    $("#image").on('change',function(){
        readURL(this);
    });

    $('#reset').on('click', function(){
        $('#img').attr('src','#').css('display','none');
        $('#divCarousel').empty();
    })

    $('#carousel').on('change', function(){
        $('#divCarousel').empty();
        readURL(this);
    })
}

function readURL(input) {

    for(let i=0;i<input.files.length;i++){
        if (input.files && input.files[i]) {
            var reader = new FileReader();
            
                reader.onload = function (e) {
                    if(input.id == 'image')
                        $('#img').attr('src', e.target.result).css('display','block').addClass('display');
                    else
                         $('#divCarousel').append($('<img>').attr({'src' : e.target.result, 'alt' : 'imagen'}).addClass(['image','mr-2']));
                }
    
            reader.readAsDataURL(input.files[i]);
        }
    }  
}


window.addEventListener('load',main);