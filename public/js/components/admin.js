function main(){
    if(sessionStorage.getItem('collapse'))
        setCollapse(sessionStorage.getItem('collapse'));
    $('#collapseAside').on('click',function(e){
        setCollapse(e.currentTarget.attributes.collapse.value);
        
    })

    $(window).resize(function(){
        var width = $(window).width();
        sessionStorage.removeItem('collapse'); 
    })
    
}

function setCollapse(collapse){
    if(collapse == "false"){
        console.log('entra')
        $('#content').removeClass('visible-sideNav').addClass('hidden-sideNav');
        $('#sideNav').css({'width':'3rem','transition' : 'all 1s'});
        $('#icon-aside').removeClass('d-none');
       /*  $('#title-dashboard').addClass('d-none').css('transition','all 1s'); */
        $('#extension-aside').addClass('d-none')
        $('#collapseAside')[0].attributes.collapse.value = "true";
        sessionStorage.setItem('collapse',false);
        
    }else{
        $('#content').removeClass('hidden-sideNav').addClass('visible-sideNav');
        $('#sideNav').css({'width':'11rem','transition' : 'all 1s'});
        $('#icon-aside').addClass('d-none');
        /* $('#title-dashboard').removeClass('d-none').css('transition','all 1s'); */
        $('#extension-aside').removeClass('d-none')
        $('#collapseAside')[0].attributes.collapse.value = "false";
        sessionStorage.setItem('collapse',true);
    } 
}


window.addEventListener('load',main);