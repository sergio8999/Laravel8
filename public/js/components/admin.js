function main(){
    if(sessionStorage.getItem('collapse'))
        setCollapse(sessionStorage.getItem('collapse'));

    $('#collapseAside').on('click',function(e){
        setCollapse(e.currentTarget.attributes.collapse.value);
        
    })

    $(window).resize(function(){
        var width = $(window).width();
        if(width < 992){
            sessionStorage.removeItem('collapse');
            $('#sideNav').css('width','100%'); 
            $('#extension-aside').removeClass('d-none')
            $('#icon-aside').addClass('d-none');
            $('#title-dashboard').removeClass('d-none')
            
        } else{
            $('#sideNav').css('width','14rem');
            $('#content').removeClass('hidden-sideNav').addClass('visible-sideNav');
            $('#collapseAside')[0].attributes.collapse.value = "false";
        } 
    })

    $('#extension-aside li').on('click',function(e){
        let target = e.currentTarget;
        let left = e.currentTarget.children[1];
        let down = e.currentTarget.children[2];
         if(e.currentTarget.attributes.dropdown !=undefined)
            if(e.currentTarget.attributes.dropdown.value =="false"){
                $('#dropdown-houses').removeClass('d-none');
                $(target).addClass('bg-dropdown');
                $(target)[0].attributes.dropdown.value = "true";
                $(left).addClass('d-none'); 
                $(down).removeClass('d-none');
            }else{
                $('#dropdown-houses').addClass('d-none');
                $(target)[0].attributes.dropdown.value = "false";
                $(left).removeClass('d-none'); 
                $(down).addClass('d-none');
                $(target).removeClass('bg-dropdown');
            } 
    })
    
}

function setCollapse(collapse){
    if(collapse == "false"){
        $('#content').removeClass('visible-sideNav').addClass('hidden-sideNav');
        $('#sideNav').css({'width':'3.2rem','transition' : 'all 1s'});
        $('#icon-aside').removeClass('d-none');
        $('#title-dashboard').addClass('d-none')
        $('#extension-aside').addClass('d-none')
        $('#collapseAside')[0].attributes.collapse.value = "true";
        sessionStorage.setItem('collapse',false);
        
    }else{
        $('#content').removeClass('hidden-sideNav').addClass('visible-sideNav');
        $('#sideNav').css({'width':'14rem','transition' : 'all 1s'});
        $('#icon-aside').addClass('d-none');
        $('#title-dashboard').removeClass('d-none')
        $('#extension-aside').removeClass('d-none')
        $('#collapseAside')[0].attributes.collapse.value = "false";
        sessionStorage.setItem('collapse',true);
    } 
}


window.addEventListener('load',main);