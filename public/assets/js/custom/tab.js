// $(document).ready(function(){
// 	// $(".Tab2").hide();
// 	// $(".Tab3").hide();		
// 	$(".tab-body-content").removeClass("active");
//   $(".tab-body-content").eq(0).addClass("active");
// 	$(".tab-nav-link").click(function(){
// 		$(this).addClass("active").siblings().removeClass("active");
	
// 	// $(".Tab1").hide();
// 	// $(".Tab2").hide();
// 	// $(".Tab3").hide();
//   $(".tab-body-content").removeClass("active");
// 	var aval=	$(this)[0].innerText;	
// 	$("."+aval).addClass("active");
// 	$(this).addClass("active");	
// });

// });


const buttonElement = document.querySelectorAll('.tab-nav-link');
const tabContent = document.querySelectorAll(".tab-body-content");

tabContent[0].style.display = "block";

buttonElement.forEach(function (i) {
    i.addEventListener('click', function (event) {

        for (let x = 0; x < buttonElement.length; x++) {
            if (event.target.id == buttonElement[x].id) {
                buttonElement[x].className = buttonElement[x].className.replace(" active", "");
                tabContent[x].style.display = "block";
                event.currentTarget.className += " active";
            } else {
                tabContent[x].style.display = "none";
                buttonElement[x].className = buttonElement[x].className.replace(" active", "");
            }
        }
        
    });
});