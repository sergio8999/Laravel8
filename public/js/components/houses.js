function main(){
    $('a').on('click',function(e){
        $('#formDelete').append($('<input type="hidden" name="idHouse">').attr('value',e.currentTarget.id));
    })
    $('svg').on('click',function(e){
        console.log(e.target.value);
        $('#formDelete').append($('<input type="hidden" name="idHouse">').attr('value',e.target.value));
    })
};

window.addEventListener('load',main);