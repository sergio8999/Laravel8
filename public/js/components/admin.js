function main(){
    $('#collapseAside').on('click',function(e){
        console.log("entra")
        console.log(e.currentTarget.attributes.collapse.value == "false");
        
        /* console.log($('#collapseAside')[0].attributes.collapse.value) */
        if(e.currentTarget.attributes.collapse.value == "false"){
            $('#content').removeClass('visible-sideNav').addClass('hidden-sideNav');
            $('#sideNav').css('width','3rem');
            $('#title-dashboard').addClass('d-none');
            $('#extension-aside').addClass('d-none')
            $('#icon-aside').removeClass('d-none');
            $('#collapseAside')[0].attributes.collapse.value = "true";
            
        }else{
            $('#content').removeClass('hidden-sideNav').addClass('visible-sideNav');
            $('#sideNav').css('width','11rem');
            $('#title-dashboard').removeClass('d-none');
            $('#extension-aside').removeClass('d-none')
            $('#icon-aside').addClass('d-none');
            $('#collapseAside')[0].attributes.collapse.value = "false";
        } 
        
    })
}

window.addEventListener('load',main);