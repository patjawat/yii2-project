

// window.onscroll = () => {
//     console.log(window.scrollY)
// }
// $(window).scroll(function (e) { 
//     console.log(e.target.scroll)
//   });



(function () {
    "use strict";
    window.addEventListener("load", () => {
      on_page_load();
    });
    function on_page_load() {
      AOS.init({
        anchorPlacement: "top-left",
        duration: 600,
        easing: "ease-in-out",
        once: true,
        mirror: false,
        disable: "mobile",
      });
    }
    const navbar = document.getElementById("header-nav");
    var body = document.getElementsByTagName("body")[0];
    const scrollTop = document.getElementById("scrolltop");
    window.onscroll = () => {
        console.log(window.scrollY)
      if (window.scrollY > 0) {
        navbar.classList.add("fixed-top", "shadow-sm");
        body.style.paddingTop = navbar.offsetHeight + "px";
        scrollTop.style.visibility = "visible";
        scrollTop.style.opacity = 1;
      } else {
        navbar.classList.remove("fixed-top", "shadow-sm");
        body.style.paddingTop = "0px";
        scrollTop.style.visibility = "hidden";
        scrollTop.style.opacity = 0;
      }
    };
    var elem = document.querySelector(".grid");
    if (elem) {
      imagesLoaded(elem, function () {
        new Masonry(elem, {
          itemSelector: ".grid-item",
          percentPosition: true,
          horizontalOrder: true,
        });
      });
    }
    document.querySelectorAll("[data-bigpicture]").forEach(function (e) {
      e.addEventListener("click", function (t) {
        t.preventDefault();
        const data = JSON.parse(e.dataset.bigpicture);
        BigPicture({ el: t.target, ...data });
      });
    });
    document.querySelectorAll(".bp-gallery a").forEach(function (e) {
      var caption = e.querySelector("figcaption");
      var img = e.querySelector("img");
      img.dataset.caption =
        '<a class="link-light" target="_blank" href="' +
        e.href +
        '">' +
        caption.innerHTML +
        "</a>";
      window.console.log(caption, img);
      e.addEventListener("click", function (t) {
        t.preventDefault();
        BigPicture({ el: t.target, gallery: ".bp-gallery" });
      });
    });
  })();

  

window.onbeforeunload = function () { 
    $('#main-modal').modal('hide');
    $('#awaitLogin').show();
    $('#content-container').hide();
 }
 
// focus เวลาเปิก select2
$(document).on("select2:open", () => {
    document.querySelector(".select2-container--open .select2-search__field").focus()
  })


$('.loading-page').hide();

$('.link-loading').click(function (e) {
    $('.loading-page').show();

});



function beforLoadModal() {
    $('#main-modal-label').html('กำลังโหลด');
    $(".modal-dialog").removeClass('modal-sm modal-md modal-lg');
    $(".modal-dialog").addClass('modal-sm');
    $('#main-modal').removeClass('fade');
    $('#main-modal').modal('show');
    $('.modal-body').html('<div class="d-flex justify-content-center"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"></div></div><h6 class="text-center mt-3">Loading...</h6>');
}

function closeModal() {
    $('#main-modal').modal('toggle');
    Swal.fire({
        icon: 'success',
        title: 'บันทึกสำเร็จ',
        showConfirmButton: false,
        timer: 1500
      })
}

$('.a-modal').click(function (e) { 
    e.preventDefault();
    var url = $(this).attr('href');
try {
    $.ajax({
        type: "get",
        url: url,
        dataType: "json",
        success: function (response) {
            $('#main-modal').modal('show');
            $('#main-modal-label').html(response.title);
            $('.modal-body').html(response.content);
            $('.modal-footer').html(response.footer);
            $(".modal-dialog").removeClass('modal-sm');
            $(".modal-dialog").addClass('modal-lg');
            $('.modal-content').addClass('card-outline card-primary');
        },
        error:function (xhr, ajaxOptions, thrownError){
            $('#main-modal').modal('show');
            $('#main-modal-label').html(xhr.status);
            $('.modal-body').html(thrownError);
            // $('.modal-footer').html(response.footer);
            $(".modal-dialog").removeClass('modal-sm');
            $(".modal-dialog").addClass('modal-lg');
            $('.modal-content').addClass('card-outline card-primary');
        }
    });
} catch (error) {
    $('#main-modal').modal('show');
   
    
}
});

