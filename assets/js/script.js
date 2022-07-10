function clickBeliTiket(nama, harga,id) {
  $('#titleModalLabel').text(nama);
  // console.log($(this).data('Harga'));
  let formating = (($('#tiket').val() * harga) / 1000).toFixed(3);
  $('#total-pembelian').text("Rp. " + formating)
  $('#total-pembelian').attr('data-harga', harga)
  $('#IdWisata').val(id)
  // console.log(parseInt(formating)*1000)

}

$(document).ready(function () {
  // check input tiket
  jQuery(function ($) {
      $('#tiket').on('input', function () {
          // formating to idr
          let formating = ($(this).val() * $('#total-pembelian').data('harga') / 1000).toFixed(3)
          // set total pembelian
          $("#total-pembelian").text("Rp. " + formating);
      });
      // handle search real time
      $('#search').on('input', function () {
          let search = $('#search').val().toLowerCase();
          let allNameWisata = $("#container-wisata > div .card-title")
          let allCardWisata = $("#container-wisata > div")
                  
          allNameWisata.map((i,e) => {                        
            let title = e.innerText.split("\n")[0].toLowerCase();            
              if(title.includes(search)){
                allCardWisata[i].classList.remove("d-none");
              }else{
                allCardWisata[i].classList.add("d-none");
              }
          })     
      });


  });
  
})
function dismissBeliTiket(){
    // wait biar tidak kelihatan ngeganti
    setTimeout(() => {
        $('#tiket').val(1);
    }, 200);
}

$('#show-password').click(function() {
    let $pwd = $('#password');
    if ($pwd.attr('type') === 'password') {
        $(this).toggleClass('d-none')
        $("#hide-password").toggleClass('d-none');
        $pwd.attr('type', 'text');
    }    
});
$('#hide-password').click(function() {
    let $pwd = $('#password');
    if ($pwd.attr('type') === 'text') {
        $(this).toggleClass('d-none')
        $("#show-password").toggleClass('d-none');
        $pwd.attr('type', 'password');
    }    
});