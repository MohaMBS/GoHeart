/*
    Created by José Antonio Mazón San Bartolomé.
        Find me in:
			Linkedin (https://www.linkedin.com/in/joseantmazonsb)
            Github (https://github.com/TheYuju12)

    Designed for a fixed or sticky top navbar. 
    If your navbar is fixed bottom you can adjust the behaviour by assigning navOffset a negative value.

*/


$(document).ready(function () {
    var scrollPos = $(window).scrollTop(); //Current scroll's position of the window (at the beginning would be 0)
    var navPos = $("nav").offset().top; //Current nav's position (at the beginnig would be wherever you set the nav)
    var navShowing = true; //Indicates whether the nav is currently shown or hidden.
    var navOffset = 150; //Amount of pixels from its current position the nav will be moved to (adjust to size of navbar)
    var navMoveSpeed = 400; //Duration (in ms) of the nav's movement

    $(window).scroll(function () {
        let clicked = false;
        console.log($(window).height())
        if($(window).height() < 992){
            x = 55
        }else{
            x = 75
        }
        var newScroll = $(this).scrollTop();
        if (newScroll > scrollPos) {
            //Scroll down
            if (navShowing) { 
                console.log("1")
                console.log($("#collapse-button").hasClass("clicked-user"))
                if($("#collapse-button").hasClass("clicked-user")){
                    $("#collapse-button").trigger("click");
                    $("#collapse-button").removeClass("clicked-user")
                    break;
                }else{
                    var newNavPos = navPos -= navOffset;
                    $("nav").animate({ top: -150 }, navMoveSpeed);
                    $("#barr").animate({ top: -150 }, navMoveSpeed);
                    navShowing = false;
                }
            }
        }
        else {
            console.log("2")
            //Scroll up
            if (!navShowing) {
                var newNavPos = navPos += navOffset;
                $("nav").animate({ top: 0 }, navMoveSpeed);
                $("#barr").animate({ top:x}, navMoveSpeed);
                navShowing = true;
            }
        }
        scrollPos = newScroll;
    });
    $("#collapse-button").click(()=>{
        if(!$("#collapse-button").hasClass("clicked-user")){ 
            $("#collapse-button").addClass("clicked-user")
            $("nav").animate({ top: 0 }, 400);
        }else{
            $("#collapse-button").removeClass("clicked-user")
        }
    })
});
